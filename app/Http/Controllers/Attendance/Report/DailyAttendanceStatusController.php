<?php

namespace App\Http\Controllers\Attendance\Report;

use App\Models\Attendance\DailyAttendance;
use Carbon\Carbon;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DailyAttendanceStatusController extends Controller
{
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

        if (check_privilege(41, 1) == false) //2=show Division  1=view
        {
            return redirect()->back()->with('error', trans('message.permission'));
            die();
        }

        $data = null;
        $report_date = null;

        if($request->filled('report_date'))
        {

            $report_date = Carbon::createFromFormat('d-m-Y',$request['report_date'])->format('Y-m-d');
//
//            $data = DailyAttendance::query()->where('company_id',$this->company_id)
//                ->whereDate('attend_date',$report_date)->get();

            $data = DailyAttendance::query()->where('company_id',$this->company_id)
                ->where('attend_date',$report_date)
                ->select(DB::Raw('count(employee_id) as emp_count'),
                    DB::raw('sum(case when attend_status = "P" then 1 else 0 end) as present'),
                    DB::raw('sum(case when offday_flag = true and attend_status = "A" then 1 else 0 end) as offday'),
                    DB::raw('sum(case when leave_flag = true and attend_status = "A"  then 1 else 0 end) as n_leave'),
                    DB::raw('sum(case when holiday_flag = true and attend_status = "A" then 1 else 0 end) as holiday'),
                    DB::raw('sum(case when attend_status = "R" then 1 else 0 end) as next_roster'),
                    DB::raw('sum(case when attend_status = "A" and leave_flag = false and  holiday_flag = false and offday_flag = false then 1 else 0 end) as absent')
                )
                ->with('department')
                ->get();


//            dd($data);
        }



        return view('attendance.report.daily-attendance-status-index',compact('data','report_date'));
    }

    public function statusPrint($status,$date)
    {

        $report_date = Carbon::createFromFormat('Y-m-d',$date)->format('Y-m-d');

        switch ($status)
        {

            case 'leave':

                $data = DailyAttendance::query()->where('company_id',$this->company_id)
                    ->where('attend_date',$report_date)->where('leave_flag',true)
                    ->where('attend_status','A')
                    ->with('professional')
                    ->get();

                $departments = $data->unique('department_id');

                $groups = DailyAttendance::query()->where('company_id',$this->company_id)
                    ->where('attend_date',$report_date)->where('leave_flag',true)
                    ->where('attend_status','A')
                    ->with('professional')
                    ->selectRaw('department_id, count(employee_id) as emp_count')
                    ->groupBy('department_id')
                    ->get();

                break;


            case 'absent':

                $data = DailyAttendance::query()->where('company_id',$this->company_id)
                    ->where('attend_date',$report_date)->where('leave_flag',false)
                    ->where('attend_status','A')->where('holiday_flag',false)
                    ->where('offday_flag',false)
                    ->with('professional')
                    ->get();

                $departments = $data->unique('department_id');

                $groups = DailyAttendance::query()->where('company_id',$this->company_id)
                    ->where('attend_date',$report_date)->where('leave_flag',false)
                    ->where('attend_status','A')->where('holiday_flag',false)
                    ->where('offday_flag',false)
                    ->with('professional')
                    ->selectRaw('department_id, count(employee_id) as emp_count')
                    ->groupBy('department_id')
                    ->get();

                break;

            case 'offday':

                $data = DailyAttendance::query()->where('company_id',$this->company_id)
                    ->where('attend_date',$report_date)
                    ->where('attend_status','A')
                    ->where('offday_flag',true)
                    ->with('professional')
                    ->get();

                $departments = $data->unique('department_id');

                $groups = DailyAttendance::query()->where('company_id',$this->company_id)
                    ->where('attend_date',$report_date)
                    ->where('attend_status','A')
                    ->where('offday_flag',true)
                    ->with('professional')
                    ->selectRaw('department_id, count(employee_id) as emp_count')
                    ->groupBy('department_id')
                    ->get();

                break;

            default:

                dd($status);

        }

        $view = \View::make('attendance.report.pdf.pdf-date-wise-status-employee',compact('data','departments','report_date','status','groups'));
        $html = $view->render();

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
//                    $pdf = new TCPDF('L', PDF_UNIT, array(105,148), true, 'UTF-8', false);
//                    $pdf::setMargin(0,0,0);


        $pdf::SetMargins(20, 5, 5,0);

        $pdf::AddPage();

        $pdf::writeHTML($html, true, false, true, false, '');
        $pdf::Output('attendance.pdf');

        return view('attendance.report.pdf.pdf-date-wise-status-employee');

//
    }
}
