<?php

namespace App\Http\Controllers\Attendance\Report;

use App\Models\Attendance\DailyAttendance;
use App\Models\Leaves\LeaveRegister;
use App\Models\leaves\leaveApplication;
use App\Models\Common\Department;
use Elibyy\TCPDF\Facades\TCPDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PayrollAttController extends Controller
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

        if(check_privilege(39,1) == false) //2=show Division  1=view
        {
            return redirect()->back()->with('error', trans('message.permission'));
            die();
        }

        $dept_lists = Department::query()->where('company_id',$this->company_id)->where('status',true)->get();

        if(!empty($request['action']))
        {
            $from_date = Carbon::createFromFormat('d-m-Y',$request['from_date'])->format('Y-m-d');
            $to_date = Carbon::createFromFormat('d-m-Y',$request['to_date'])->format('Y-m-d');

            $data = DailyAttendance::query()
                ->where('company_id',$this->company_id)
                ->whereBetween('attend_date',[$from_date,$to_date])
                ->select('department_id','employee_id',
                    DB::raw('sum(case when attend_status = "P" and leave_flag = false and offday_flag = false then 1 else 0 end) as present'),
                    DB::raw('sum(case when offday_flag = true and leave_flag = false then 1 else 0 end) as offday'),
                    DB::raw('sum(case when holiday_flag = true and attend_status = "A" and offday_flag = false then 1 else 0 end) as holiday'),
                    DB::raw('sum(case when attend_status = "A" and leave_flag = false and  holiday_flag = false and offday_flag = false then 1 else 0 end) as absent'),
                    DB::raw('sum(case when leave_id = 1 and leave_flag = true then 1 else 0 end) as cl'),
                    DB::raw('sum(case when leave_id = 4 and leave_flag = true then 1 else 0 end) as el'),
                    DB::raw('sum(case when leave_id = 2 and leave_flag = true then 1 else 0 end) as sl'),
                    DB::raw('sum(case when leave_id = 3 and leave_flag = true then 1 else 0 end) as al'),
                    DB::raw('sum(case when leave_id = 9 and leave_flag = true then 1 else 0 end) as lwp'),
                    DB::raw('floor(sum(case when (late_flag = true) and (late_allow = false) then 1 else 0 end)/3) as late_count')
                )
                ->groupBy('department_id','employee_id')
                ->orderBy('employee_id','ASC')
                ->with('department')
                ->get();

            switch ($request['action'])
            {
                case 'preview':

                    return view('attendance.report.payroll-attendance-report',compact('data','from_date','to_date','dept_lists'));

                    break;

                case 'print':


                    $view = \View::make('attendance.report.pdf.print-payroll-attendance-report', compact('data', 'from_date', 'to_date', 'dept_lists'));
                    $html = $view->render();

                    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);

                    $pdf::SetMargins(20, 5, 5,0);

                    $pdf::AddPage('L');

                    $pdf::writeHTML($html, true, false, true, false, '');
                    $pdf::Output('attendance.pdf');

                    break;

            }
        }
        return view('attendance.report.payroll-attendance-report');
    }

}
