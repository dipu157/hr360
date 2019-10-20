<?php

namespace App\Http\Controllers\Attendance\Report;

use App\Exports\AttendanceSummaryExport;
use App\Models\Attendance\DailyAttendance;
use App\Models\Common\Department;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Elibyy\TCPDF\Facades\TCPDF;
use Maatwebsite\Excel\Facades\Excel;

class DateRangeAttendanceController extends Controller
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

        $dept_lists = Department::query()->where('company_id',$this->company_id)->where('status',true)
            ->orderBy('name')->pluck('name','id');

        if(!empty($request['action']))
        {
            $from_date = Carbon::createFromFormat('d-m-Y',$request['from_date'])->format('Y-m-d');
            $to_date = Carbon::createFromFormat('d-m-Y',$request['to_date'])->format('Y-m-d');
            $departments = Department::query()->where('company_id',$this->company_id)->where('status',true)->get();

            switch ($request['action'])
            {
                case 'preview':


                    if($request->filled('employee_id'))
                    {
                        $data = DailyAttendance::query()
                            ->where('company_id',$this->company_id)
                            ->where('employee_id',$request['employee_id'])
                            ->whereBetween('attend_date',[$from_date,$to_date])
                            ->select('department_id','employee_id',
                                DB::raw('sum(case when attend_status = "P" and offday_flag = false then 1 else 0 end) as present'),
                                DB::raw('sum(case when offday_flag = true then 1 else 0 end) as offday'),
                                DB::raw('sum(case when leave_flag = true then 1 else 0 end) as n_leave'),
                                DB::raw('sum(case when holiday_flag = true then 1 else 0 end) as holiday'),
                                DB::raw('sum(case when (late_flag = true) and (late_allow = false) then 1 else 0 end) as late_count'),
                                DB::raw('sum(overtime_hour) as overtime_hour'),
                                DB::raw('sum(case when attend_status = "A" and leave_flag = false and  holiday_flag = false and offday_flag = false then 1 else 0 end) as absent')
                            )
                            ->groupBy('department_id','employee_id')
                            ->orderBy('employee_id','ASC')
                            ->with('department')
                            ->get();
                    }else

                    if($request->filled('department_id'))
                    {
                        $data = DailyAttendance::query()
                            ->where('company_id',$this->company_id)
                            ->where('department_id',$request['department_id'])
                            ->whereBetween('attend_date',[$from_date,$to_date])
                            ->select('department_id','employee_id',
                                DB::raw('sum(case when attend_status = "P" and offday_flag = false then 1 else 0 end) as present'),
                                DB::raw('sum(case when offday_flag = true then 1 else 0 end) as offday'),
                                DB::raw('sum(case when leave_flag = true then 1 else 0 end) as n_leave'),
                                DB::raw('sum(case when holiday_flag = true then 1 else 0 end) as holiday'),
                                DB::raw('sum(case when (late_flag = true) and (late_allow = false) then 1 else 0 end) as late_count'),
                                DB::raw('sum(overtime_hour) as overtime_hour'),
                                DB::raw('sum(case when attend_status = "A" and leave_flag = false and  holiday_flag = false and offday_flag = false then 1 else 0 end) as absent')
                            )
                            ->groupBy('department_id','employee_id')
                            ->orderBy('employee_id','ASC')
                            ->with('department')
                            ->get();
                    }

                    return view('attendance.report.date-range-attendance-report',compact('data','from_date','to_date','departments','dept_lists'));

                    break;

                case 'print':

//                    dd('print');

                    if($request->filled('department_id'))
                    {
                        $data = DailyAttendance::query()
                            ->where('company_id',$this->company_id)
                            ->where('department_id',$request['department_id'])
                            ->whereBetween('attend_date',[$from_date,$to_date])
                            ->select('department_id','employee_id',
                                DB::raw('sum(case when attend_status = "P" and offday_flag = false and holiday_flag = false and leave_flag=false then 1 else 0 end) as present'),
                                DB::raw('sum(case when offday_flag = true and leave_flag=false and holiday_flag=false then 1 else 0 end) as offday'),

                                DB::raw('sum(case when leave_id = 1 then 1 else 0 end) as casual'),
                                DB::raw('sum(case when leave_id = 4 then 1 else 0 end) as earn'),
                                DB::raw('sum(case when leave_id = 2 then 1 else 0 end) as sick'),
                                DB::raw('sum(case when leave_id = 3 then 1 else 0 end) as alterLeave'),
                                DB::raw('sum(case when leave_id = 9 then 1 else 0 end) as wpLeave'),

                                DB::raw('floor(sum(case when late_flag = true then 1 else 0 end)/3) as lateCount'),

                                DB::raw('sum(case when holiday_flag = true and leave_flag=false then 1 else 0 end) as holiday'),
                                DB::raw('sum(case when (late_flag = true) and (late_allow = false) then 1 else 0 end) as late_count'),
                                DB::raw('sum(overtime_hour) as overtime_hour'),


                                DB::raw('sum(case when attend_status = "A" and leave_flag = false and  holiday_flag = false and offday_flag = false then 1 else 0 end) as absent')
                            )
                            ->groupBy('department_id','employee_id')
                            ->orderBy('employee_id','ASC')
                            ->with('department')
                            ->get();
                    }

                    $final = Collect();

                    foreach ($data as $row)
                    {
//                        $row['leaveWPay']= $row->wpLeave + $row->absent;
                        $row['total_lwp'] = $row->lateCount + $row->wpLeave + $row->absent;
                        $row['total_pdays'] = ($row->present + $row->offday + $row->holiday + $row->casual+ $row->earn + $row->sick + $row->alterLeave) - ($row->lateCount);

                        $row['designation'] = $row->professional->designation->name;
                        $row['deg_order'] = $row->professional->designation->precedence;

                        $final->push($row);
                    }

                    $final = $final->sortBy('deg_order');

                    $view = \View::make('attendance.report.pdf.employee-attendance-summery', compact('final', 'from_date', 'to_date'));
                    $html = $view->render();

                    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(216,355), true, 'UTF-8', false);

                    $pdf::SetMargins(10, 5, 5,0);

                    $pdf::AddPage('L');

                    $pdf::writeHTML($html, true, false, true, false, '');
                    $pdf::Output('AttendanceSummery.pdf');

                    break;

                case 'download':

//                    dd($request['department_id']);

                    if(is_null($request['department_id']))
                    {
                        return redirect()->back()->with('error','Please Select Department');
                    }

//                    $department_id = $request['department_id'];
//                    $exporter = app()->makeWith(AttendanceSummaryExport::class, compact('from_date','to_date','department_id'));
//                    return $exporter->download('Summary Attendance.xlsx');

                    $data = DailyAttendance::query()
                        ->where('company_id',$this->company_id)
                        ->where('department_id',$request['department_id'])
                        ->whereBetween('attend_date',[$from_date,$to_date])
                        ->select('department_id','employee_id',
                            DB::raw('sum(case when attend_status = "P" and offday_flag = false and holiday_flag = false and leave_flag=false then 1 else 0 end) as present'),
                            DB::raw('sum(case when offday_flag = true and leave_flag=false and holiday_flag=false then 1 else 0 end) as offday'),

                            DB::raw('sum(case when leave_id = 1 then 1 else 0 end) as casual'),
                            DB::raw('sum(case when leave_id = 4 then 1 else 0 end) as earn'),
                            DB::raw('sum(case when leave_id = 2 then 1 else 0 end) as sick'),
                            DB::raw('sum(case when leave_id = 3 then 1 else 0 end) as alterLeave'),
                            DB::raw('sum(case when leave_id = 9 then 1 else 0 end) as wpLeave'),

                            DB::raw('floor(sum(case when late_flag = true then 1 else 0 end)/3) as lateCount'),

                            DB::raw('sum(case when holiday_flag = true and leave_flag = false then 1 else 0 end) as holiday'),
                            DB::raw('sum(case when (late_flag = true) and (late_allow = false) then 1 else 0 end) as late_count'),
                            DB::raw('sum(overtime_hour) as overtime_hour'),


                            DB::raw('sum(case when attend_status = "A" and leave_flag = false and  holiday_flag = false and offday_flag = false then 1 else 0 end) as absent')
                        )
                        ->groupBy('department_id','employee_id')
                        ->orderBy('employee_id','ASC')
                        ->with('department')
                        ->get();

                    $final = Collect();

                    foreach ($data as $row)
                    {
                        $row['total_lwp'] = $row->lateCount + $row->wpLeave + $row->absent;
                        $row['total_pdays'] = ($row->present + $row->offday + $row->holiday + $row->casual+ $row->earn + $row->sick + $row->alterLeave) - ($row->lateCount);
                        $row['department_name'] = preg_replace("/[^a-zA-Z 0-9]+/", "", $row->professional->department->name );
                        $row['designation_name'] = preg_replace("/[^a-zA-Z 0-9]+/", "", $row->professional->designation->name );
                        $final->push($row);
                    }

//                    dd($final);


                    return Excel::download(new AttendanceSummaryExport($final,$from_date,$to_date), 'export.xls');

                    break;


            }
        }

        return view('attendance.report.date-range-attendance-report',compact('dept_lists'));
    }

    public function employeeRange($id, $from, $to)
    {
        $data = DailyAttendance::query()->where('company_id',$this->company_id)
            ->where('employee_id',$id)
            ->whereBetween('attend_date',[$from,$to])
            ->with('professional')
            ->orderBy('attend_date','ASC')
            ->get();

        return view('attendance.report.date-range-employee-report',compact('data'));
    }

    public function printEmployeeRange($id, $from_date, $to_date)
    {
        $data = DailyAttendance::query()->where('company_id',$this->company_id)
            ->where('employee_id',$id)
            ->whereBetween('attend_date',[$from_date,$to_date])
            ->with('professional')
            ->orderBy('attend_date','ASC')
            ->get();

        $view = \View::make('attendance.report.pdf.pdf-date-range-emp-attendance', compact('data', 'from_date', 'to_date'));
        $html = $view->render();

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);

        $pdf::SetMargins(20, 5, 5,0);

        $pdf::AddPage();

        $pdf::writeHTML($html, true, false, true, false, '');
        $pdf::Output('Attendance.pdf');


//        return view('attendance.report.pdf.pdf-date-range-emp-attendance',compact('data'));
    }

    public function statusPrint(Request $request)
    {
        $from_date = Carbon::createFromFormat('d-m-Y',$request['s_from_date'])->format('Y-m-d');
        $to_date = Carbon::createFromFormat('d-m-Y',$request['s_to_date'])->format('Y-m-d');

        if($request['status_id'] == 1)
        {

            if($request->filled('employee_id'))
            {
                $data = DailyAttendance::query()
                    ->where('company_id',$this->company_id)
                    ->where('employee_id',$request['employee_id'])
                    ->where('late_flag',true)
                    ->where('leave_flag',false)
                    ->where('offday_flag',false)
                    ->whereBetween('attend_date',[$from_date,$to_date])
                    ->with('professional','shift')
                    ->orderBy('attend_date')
                    ->get();

                $employees = $data->unique('employee_id');
            }

            if($request->filled('department_id'))
            {
                $data = DailyAttendance::query()
                    ->where('company_id',$this->company_id)
                    ->where('department_id',$request['department_id'])
                    ->where('late_flag',true)
                    ->where('leave_flag',false)
                    ->where('offday_flag',false)
                    ->whereBetween('attend_date',[$from_date,$to_date])
                    ->with('professional','shift')
                    ->orderBy('attend_date')
                    ->get();

                $employees = $data->unique('employee_id');
            }
            $status = $request['status_id'];
        }



        if($request['status_id'] == 2)
        {

            if($request->filled('employee_id'))
            {
                $data = DailyAttendance::query()
                    ->where('company_id',$this->company_id)
                    ->where('employee_id',$request['employee_id'])
                    ->where('attend_status','A')
                    ->where('leave_flag',false)
                    ->where('offday_flag',false)
                    ->where('holiday_flag',false)
                    ->whereBetween('attend_date',[$from_date,$to_date])
                    ->with('professional','shift')
                    ->orderBy('attend_date')
                    ->get();

                $employees = $data->unique('employee_id');
            }

            if($request->filled('department_id'))
            {
                $data = DailyAttendance::query()
                    ->where('company_id',$this->company_id)
                    ->where('department_id',$request['department_id'])
                    ->where('attend_status','A')
                    ->where('leave_flag',false)
                    ->where('offday_flag',false)
                    ->where('holiday_flag',false)
                    ->whereBetween('attend_date',[$from_date,$to_date])
                    ->with('professional','shift')
                    ->orderBy('attend_date')
                    ->get();

                $employees = $data->unique('employee_id');
            }
            $status = $request['status_id'];
        }



        if($request['status_id'] == 3)
        {

            if($request->filled('employee_id'))
            {
                $data = DailyAttendance::query()
                    ->where('company_id',$this->company_id)
                    ->where('employee_id',$request['employee_id'])
                    ->where('attend_status','A')
                    ->where('leave_flag',true)
                    ->whereBetween('attend_date',[$from_date,$to_date])
                    ->with('professional','shift')
                    ->orderBy('attend_date')
                    ->get();

                $employees = $data->unique('employee_id');
            }

            if($request->filled('department_id'))
            {
                $data = DailyAttendance::query()
                    ->where('company_id',$this->company_id)
                    ->where('department_id',$request['department_id'])
                    ->where('attend_status','A')
                    ->where('leave_flag',true)
                    ->whereBetween('attend_date',[$from_date,$to_date])
                    ->with('professional','shift')
                    ->orderBy('attend_date')
                    ->get();

                $employees = $data->unique('employee_id');
            }
            $status = $request['status_id'];
        }




        $view = \View::make('attendance.report.pdf.pdf-date-range-status', compact('data', 'from_date', 'to_date','employees','status'));
        $html = $view->render();

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);

        $pdf::SetMargins(20, 5, 5,0);

        $pdf::AddPage();

        $pdf::writeHTML($html, true, false, true, false, '');
        $pdf::Output('AttendanceStatus.pdf');
    }
}
