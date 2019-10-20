<?php

namespace App\Http\Controllers\Roster;

use App\Models\Common\Department;
use App\Models\Common\Location;
use App\Models\Employee\EmpProfessional;
use App\Models\Roster\DutyLocation;
use App\Models\Roster\Roster;
use App\Models\Roster\Shift;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class PrintRosterController extends Controller
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

        $departments = Department::query()->where('company_id',$this->company_id)
            ->where('status',true)->pluck('name','id');

        $locations = DutyLocation::query()->where('company_id',$this->company_id)
            ->where('status',true)->pluck('location','id');

        $year = null;
        $month = null;
        $department_id = Session::get('session_user_dept_id');


        if(!empty($request['action']))
        {

            switch ($request['action'])
            {
                case 'preview':

                    $year = $request['search_year'];
                    $month = $request['search_month'];
                    $department_id = $request['department_id'];

                break;

                case 'print':

                    $year = $request['search_year'];
                    $month = $request['search_month'];
                    $department_id = $request['department_id'];

                    $month_days=cal_days_in_month(CAL_GREGORIAN,$month,$year);


                    $dept_data = Department::query()->where('company_id',$this->company_id)
                        ->where('id',$department_id)->first();

                    if($request->filled('location_id'))
                    {
                        $loc_id = $request['location_id'];

                        $roster = EmpProfessional::query()->where('company_id',$this->company_id)
                            ->where('department_id',$department_id)
                            ->whereIn('working_status_id',[1,2]) // regular
                            ->with(['roster' =>function ($query) use($year, $month, $loc_id) {
                                $query->where('r_year', $year)->where('month_id',$month)->where('loc_05',$loc_id);
                            }])
                            ->with('personal')
                            ->get();


//                        $changed = $roster->map(function ($value, $key) {
//
//                            return is_null($row->roster->);
//                        });








//                        $roster = DB::Select('select * from rosters
//                                join emp_professionals ON emp_professionals.employee_id = rosters.employee_id
//                                join emp_personals ON emp_personals.id = emp_professionals.emp_personals_id
//                                where rosters.loc_05 = 41 and rosters.month_id = 4 and rosters.r_year = 2019');


//                        dd($roster);

                    }else{

                        $roster = EmpProfessional::query()->where('company_id',$this->company_id)
                            ->where('department_id',$department_id)
                            ->whereIn('working_status_id',[1,2]) // regular
                            ->with(['roster' =>function ($query) use($year, $month) {
                                $query->where('r_year', $year)->where('month_id',$month);
                            }])
                            ->with('personal')
                            ->get();
                    }


                    $view = \View::make('roster.report.pdf.print-roster-pdf',compact('roster','year','month','department_id','dept_data','locations','month_days'));
                    $html = $view->render();

                    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LEGAL', true, 'UTF-8', false);

//                    $fontname = TCPDF_FONTS::addTTFfont('font/blogger-sans.bold.ttf', 'TrueTypeUnicode', '', 32);
//                    $pdf::SetFont($fontname, '', 14, '', false);


//                    $pdf::setCellPaddings(0,0,0,0);
                    $pdf::SetMargins(5, 5, 5,0);

//                    $pdf::SetAutoPageBreak(TRUE, 0);


                    $pdf::AddPage('L');

                    // for direct print

                    $pdf::writeHTML($html, true, false, true, false, '');


                    $pdf::Output('roster.pdf');

                    break;
            }
        }

        return view('roster.report.print-roster-index',compact('departments','year','month','department_id','locations'));

    }

    public function getRosterData($year,$month,$dept_id)
    {
//        $roster = Roster::query()->where('company_id',$this->company_id)
//            ->where('r_year',$year)->where('month_id',$month)->get();


//        $roster = EmpProfessional::query()->where('company_id',$this->company_id)
//            ->with(['roster' => function ($query) use($year, $month) {
//                $query->where('r_year', $year)->where('month_id',$month);
//            }])
//            ->get();


        $roster = EmpProfessional::query()->where('company_id',$this->company_id)
            ->where('department_id',$dept_id)
            ->whereIn('working_status_id',[1,2]) // regular
            ->with(['roster' =>function ($query) use($year, $month) {
                $query->where('r_year', $year)->where('month_id',$month);
            }])
            ->with('personal')
            ->get();


        return DataTables::of($roster)

            ->addColumn('employee', function ($roster) {

                return $roster->personal->full_name. '<br/>'. $roster->employee_id ;

            })
            ->addColumn('day_01', function ($roster) {

                return get_shift_data($roster->roster->day_01) ?? '';

            })

            ->addColumn('day_02', function ($roster) {

                return get_shift_data($roster->roster->day_02) ?? '';

            })

            ->addColumn('day_03', function ($roster) {

                return get_shift_data($roster->roster->day_03) ?? '';

            })

            ->addColumn('day_04', function ($roster) {

                return get_shift_data($roster->roster->day_04) ?? '';

            })

            ->addColumn('day_05', function ($roster) {

                return get_shift_data($roster->roster->day_05) ?? '';

            })

            ->addColumn('day_06', function ($roster) {

                return get_shift_data($roster->roster->day_06) ?? '';

            })

            ->addColumn('day_07', function ($roster) {

                return get_shift_data($roster->roster->day_07) ?? '';

            })

            ->addColumn('day_08', function ($roster) {

                return get_shift_data($roster->roster->day_08) ?? '';

            })
            ->addColumn('day_09', function ($roster) {

                return get_shift_data($roster->roster->day_09) ?? '';

            })
            ->addColumn('day_10', function ($roster) {

                return get_shift_data($roster->roster->day_10) ?? '';

            })
            ->addColumn('day_11', function ($roster) {

                return get_shift_data($roster->roster->day_11) ?? '';

            })
            ->addColumn('day_12', function ($roster) {

                return get_shift_data($roster->roster->day_12) ?? '';

            })
            ->addColumn('day_13', function ($roster) {

                return get_shift_data($roster->roster->day_13) ?? '';

            })
            ->addColumn('day_14', function ($roster) {

                return get_shift_data($roster->roster->day_14) ?? '';

            })
            ->addColumn('day_15', function ($roster) {

                return get_shift_data($roster->roster->day_15) ?? '';

            })
            ->addColumn('day_16', function ($roster) {

                return get_shift_data($roster->roster->day_16) ?? '';

            })
            ->addColumn('day_17', function ($roster) {

                return get_shift_data($roster->roster->day_17) ?? '';

            })
            ->addColumn('day_18', function ($roster) {

                return get_shift_data($roster->roster->day_18) ?? '';

            })
            ->addColumn('day_19', function ($roster) {

                return get_shift_data($roster->roster->day_19) ?? '';

            })

            ->addColumn('day_20', function ($roster) {

                return get_shift_data($roster->roster->day_20) ?? '';

            })
            ->addColumn('day_21', function ($roster) {

                return get_shift_data($roster->roster->day_21) ?? '';

            })
            ->addColumn('day_22', function ($roster) {

                return get_shift_data($roster->roster->day_22) ?? '';

            })
            ->addColumn('day_23', function ($roster) {

                return get_shift_data($roster->roster->day_23) ?? '';

            })
            ->addColumn('day_24', function ($roster) {

                return get_shift_data($roster->roster->day_24) ?? '';

            })
            ->addColumn('day_25', function ($roster) {

                return get_shift_data($roster->roster->day_25) ?? '';

            })
            ->addColumn('day_26', function ($roster) {

                return get_shift_data($roster->roster->day_26) ?? '';

            })
            ->addColumn('day_27', function ($roster) {

                return get_shift_data($roster->roster->day_27) ?? '';

            })
            ->addColumn('day_28', function ($roster) {

                return get_shift_data($roster->roster->day_28) ?? '';

            })
            ->addColumn('day_29', function ($roster) {

                return get_shift_data($roster->roster->day_29) ?? '';

            })
            ->addColumn('day_30', function ($roster) {

                return get_shift_data($roster->roster->day_30) ?? '';

            })
            ->addColumn('day_31', function ($roster) {

                return get_shift_data($roster->roster->day_31) ?? '';

            })
            ->addColumn('location', function ($roster) {

                return $roster->roster->location->location ?? '';

            })
            ->editColumn('status', function ($roster) {

                return $roster->roster->status == 1 ? 'Approved' : 'Create';

            })


            ->rawColumns(['employee','day_01','day_02','day_03', 'day_04','day_05','day_06','day_07','day_08',
                'day_09','day_10','day_11','day_12','day_13','day_14','day_15','day_16','day_17','day_18','day_19',
                'day_20','day_21','day_22','day_23','day_24','day_25','day_26','day_27','day_28','day_29','day_30','day_31','location','status'])

            ->make(true);


    }

}
