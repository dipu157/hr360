<?php

namespace App\Http\Controllers\Roster;

use App\Models\Attendance\DailyAttendance;
use App\Models\Employee\EmpProfessional;
use App\Models\Roster\Roster;
use App\Models\Roster\Shift;
use Carbon\Carbon;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RosterWiseEmployeeReportController extends Controller
{

    public $company_id;
    public $user_id;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $this->company_id = Auth::user()->company_id;
            $this->user_id = Auth::id();

            return $next($request);
        });
    }

    public function index(Request $request)
    {

        if(check_privilege(26,1) == false) //2=show Division  1=view
        {
            return redirect()->back()->with('error', trans('message.permission'));
            die();
        }

//        $shifts = Shift::query()->where('company_id',$this->company_id)
//            ->where('status',true)->pluck('name','id');

        $year = null;
        $month = null;


        if(!empty($request['action']))
        {

            $year = Carbon::createFromFormat('d-m-Y',$request['report_date'])->format('Y');
            $month = Carbon::createFromFormat('d-m-Y',$request['report_date'])->format('m');
            $day = Carbon::createFromFormat('d-m-Y',$request['report_date'])->format('d');
            $date = $request['report_date'];
            $field = 'day_'.$day;
            $session_id = $request['session_id'];


            switch($request['session_id'])
            {
                case 'R':

                    $first = EmpProfessional::query()->where('company_id',$this->company_id)
                        ->whereIn('working_status_id',[1,2,8])
                        ->whereHas('roster',function ($query) use($year,$month,$day){
                            $query->where('r_year',$year)->where('month_id',$month)
                                ->where('day_'.$day,null);
                        });


                    $employees = EmpProfessional::query()->where('company_id',$this->company_id)
                        ->whereIn('working_status_id',[1,2,8])
                        ->whereDoesntHave('roster', function (Builder $query) use ($year,$month) {
                            $query->where('r_year',$year)->where('month_id',$month);
                        })->union($first)
                        ->get();


                    break;

//                case 'O':
//
//                    $employees = EmpProfessional::query()->where('company_id',$this->company_id)
//                        ->whereIn('working_status_id',[1,2,8])
//                        ->whereHas('roster',function ($query) use($year,$month,$day){
//                            $query->where('r_year',$year)->where('month_id',$month)
//                                ->where('day_'.$day,1);
//                        })->get();
//
//                    dd($employees->count());
//
//                    break;

                default:

                    $ids = Shift::query()->where('company_id',$this->company_id)
                        ->where('session_id',$request['session_id'])->pluck('id');

                    $employees = EmpProfessional::query()->where('company_id',$this->company_id)
                        ->whereIn('working_status_id',[1,2,8])
                        ->whereHas('roster', function ($query) use($year,$month,$day,$ids){
                            $query->where('r_year',$year)->where('month_id',$month)
                                ->whereIn('day_'.$day,$ids);
                        })
                        ->with(['roster'=> function ($query) use($year,$month,$day,$ids){
                            $query->where('r_year',$year)->where('month_id',$month)
                                ->whereIn('day_'.$day,$ids);
                        }])->get();


                    break;

//                default:
//
//                    $ids = Shift::query()->where('company_id',$this->company_id)
//                        ->where('session_id',$request['session_id'])->pluck('id');
//
//                    $employees = EmpProfessional::query()->where('company_id',$this->company_id)
//                        ->whereIn('working_status_id',[1,2,8])
//                        ->whereHas('roster',function ($query) use($year,$month,$day,$ids){
//                            $query->where('r_year',$year)->where('month_id',$month)
//                                ->whereIn('day_'.$day,$ids);
//                        })->get();
//                    break;

            }

//            $shifts = Shift::query()->where('company_id',$this->company_id)
//                ->where('session_id',$request['session_id'])->first();




//            $data  = DailyAttendance::query()->where('company_id',$this->company_id)
//                ->where('')


//            $rosters = Roster::query()->where('company_id',$this->company_id)
//                ->select('employee_id','department_id','day_'.$day)
//                ->where('r_year',$year)->where('month_id',$month)
//                ->where('day_'.$day,$request['shift_id'])
//                ->with('professional')
//                ->get();

            $departments = $employees->unique('department_id');

            $view = \View::make('roster.report.pdf.roster-wise-employee-print',compact('employees','departments','ids','date','field','session_id'));
            $html = $view->render();

            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);

//                    $fontname = TCPDF_FONTS::addTTFfont('font/blogger-sans.bold.ttf', 'TrueTypeUnicode', '', 32);
//                    $pdf::SetFont($fontname, '', 14, '', false);


//                    $pdf::setCellPaddings(0,0,0,0);
            $pdf::SetMargins(20, 5, 5,0);

//                    $pdf::SetAutoPageBreak(TRUE, 0);


            $pdf::AddPage();

            // for direct print

            $pdf::writeHTML($html, true, false, true, false, '');


            $pdf::Output('roster.pdf');
        }

        return view('roster.report.roster-wise-employee-index');

    }
}
