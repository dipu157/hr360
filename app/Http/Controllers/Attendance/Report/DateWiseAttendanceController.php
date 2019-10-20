<?php

namespace App\Http\Controllers\Attendance\Report;

use App\Models\Attendance\DailyAttendance;
use App\Models\Attendance\PunchDetail;
use Carbon\Carbon;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DateWiseAttendanceController extends Controller
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

        if(check_privilege(38,1) == false) //2=show Division  1=view
        {
            return redirect()->back()->with('error', trans('message.permission'));
            die();
        }


        if(!empty($request['action']))
        {
            $report_date = Carbon::createFromFormat('d-m-Y',$request['report_date'])->format('Y-m-d');

            switch ($request['action'])
            {


                case 'preview':

                    if($request->filled('employee_id'))
                    {
                        $data = DailyAttendance::query()
                            ->select('department_id','employee_id','attend_date','entry_date','shift_entry_time','entry_time',
                                'exit_date','exit_time','shift_exit_time','attend_status','night_duty','holiday_flag',
                                'leave_flag','offday_flag','shift_id','overtime_hour',
                                DB::raw('case when attend_status = "P" then "Present"
                                            when offday_flag = true and attend_status = "A" then "OffDay"
                                            when leave_flag = true and attend_status = "A" then "InLeave"
                                            when holiday_flag = true and attend_status = "A" then "Holiday"
                                            when attend_status = "A" and leave_flag = false and  holiday_flag = false and offday_flag = false then "Absent" else "Noth" end as Status') )
                            ->where('attend_date',$report_date)
                            ->where('employee_id',$request['employee_id'])
                            ->with('professional')
                            ->first();

                        $punchs = PunchDetail::query()->where('employee_id',$request['employee_id'])
                            ->whereDate('attendance_datetime',$report_date)->get();


                        return view('attendance.report.employee-punch-details',compact('data','punchs'));
                    }


                    $data = DailyAttendance::query()
                        ->where('attend_date',$report_date)
                        ->select('attend_date','department_id', DB::Raw('count(employee_id) as emp_count'),
                            DB::raw('sum(case when attend_status = "P" then 1 else 0 end) as present'),
                            DB::raw('sum(case when offday_flag = true and attend_status = "A" then 1 else 0 end) as offday'),
                            DB::raw('sum(case when leave_flag = true and attend_status = "A" then 1 else 0 end) as n_leave'),
                            DB::raw('sum(case when holiday_flag = true and attend_status = "A" then 1 else 0 end) as holiday'),
                            DB::raw('sum(case when attend_status = "A" and leave_flag = false and  holiday_flag = false and offday_flag = false then 1 else 0 end) as absent')
                            )
                        ->groupBy('attend_date','department_id')
                        ->with('department')
                        ->get();

                    return view('attendance.report.date-wise-attendance-report-index',compact('data'));

                break;

                case 'print':

                    dd('print');



                $view = \View::make('prescription.pdf-print-prescription',compact('prescription','patient'));
                $html = $view->render();

                $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
//                    $pdf = new TCPDF('L', PDF_UNIT, array(105,148), true, 'UTF-8', false);
//                    $pdf::setMargin(0,0,0);

                $fontname = TCPDF_FONTS::addTTFfont('font/solaiman-lipi.ttf', 'TrueTypeUnicode', '', 32);
                $pdf::SetFont($fontname, '', 14, '', false);

//        $fontname1 = TCPDF_FONTS::addTTFfont('font/solaiman-lipi.ttf', 'TrueTypeUnicode', '', 32);
//        $pdf::SetFont($fontname1, '', 8, '', false);



                $pdf::SetMargins(10, 25, 5,0);

                $pdf::AddPage();

                $pdf::writeHTML($html, true, false, true, false, '');
                $pdf::Output('prescription.pdf');

                return view('prescription.pdf-print-prescription');

                break;

            }
        }



        return view('attendance.report.date-wise-attendance-report-index');
    }

    public function departmentDetailsReport($id,$date)
    {
        $data = DailyAttendance::query()
            ->select('department_id','employee_id','attend_date','entry_date','shift_entry_time','entry_time',
                'exit_date','exit_time','shift_exit_time','attend_status','night_duty','holiday_flag',
                'leave_flag','offday_flag','shift_id','overtime_hour',
                DB::raw('case when attend_status = "P" and offday_flag = false then "Present"
                                            when offday_flag = true then "OffDay"
                                            when leave_flag = true then "InLeave"
                                            when holiday_flag = true then "HloiDay"
                                            when attend_status = "A" and leave_flag = false and  holiday_flag = false and offday_flag = false then "Absent" else "Noth" end as Status') )
            ->where('attend_date',$date)
            ->where('department_id',$id)
            ->with('professional')
            ->get();


        return view('attendance.report.date-wise-employee-attendance-status',compact('data'));
    }

    public function printdepartmentDetailsReport($id,$date)
    {
        $data = DailyAttendance::query()
            ->select('department_id','employee_id','attend_date','entry_date','shift_entry_time','entry_time',
                'exit_date','exit_time','shift_exit_time','attend_status','night_duty','holiday_flag',
                'leave_flag','offday_flag','shift_id','overtime_hour',
                DB::raw('case when attend_status = "P" and offday_flag = false then "Present"
                                            when offday_flag = true then "OffDay"
                                            when leave_flag = true then "InLeave"
                                            when holiday_flag = true then "HloiDay"
                                            when attend_status = "A" and leave_flag = false and  holiday_flag = false and offday_flag = false then "Absent" else "Noth" end as Status') )
            ->where('attend_date',$date)
            ->where('department_id',$id)
            ->with('professional')
            ->get();


            $view = \View::make('attendance.report.pdf.print-departmentDetailsReport',compact('data'));
                    $html = $view->render();

                    $html = $view->render();

                    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(216,355), true, 'UTF-8', false);

                    $pdf::SetMargins(20, 5, 5,0);

                    $pdf::AddPage('L');

                    $pdf::writeHTML($html, true, false, true, false, '');
                    $pdf::Output('attendance.pdf');


        return view('attendance.report.pdf.print-departmentDetailsReport',compact('data'));
    }

    public function inLeaveReport(Request $request)
    {
        dd($request->all());

        if(!empty($request['action']))
        {
            $report_date = Carbon::createFromFormat('d-m-Y',$request['report_date'])->format('Y-m-d');

            switch ($request['action'])
            {


                case 'preview':

                    if($request->filled('employee_id'))
                    {
                        $data = DailyAttendance::query()
                            ->select('department_id','employee_id','attend_date','entry_date','shift_entry_time','entry_time',
                                'exit_date','exit_time','shift_exit_time','attend_status','night_duty','holiday_flag',
                                'leave_flag','offday_flag','shift_id','overtime_hour',
                                DB::raw('case when attend_status = "P" and offday_flag = false then "Present"
                                            when offday_flag = true then "OffDay"
                                            when leave_flag = true then "InLeave"
                                            when holiday_flag = true then "HloiDay"
                                            when attend_status = "A" and leave_flag = false and  holiday_flag = false and offday_flag = false then "Absent" else "Noth" end as Status') )
                            ->where('attend_date',$report_date)
                            ->where('employee_id',$request['employee_id'])
                            ->with('professional')
                            ->first();

                        $punchs = PunchDetail::query()->where('employee_id',$request['employee_id'])
                            ->whereDate('attendance_datetime',$report_date)->get();


                        return view('attendance.report.employee-punch-details',compact('data','punchs'));
                    }


                    $data = DailyAttendance::query()
                        ->where('attend_date',$report_date)
                        ->select('attend_date','department_id', DB::Raw('count(employee_id) as emp_count'),
                            DB::raw('sum(case when attend_status = "P" and offday_flag = false then 1 else 0 end) as present'),
                            DB::raw('sum(case when offday_flag = true then 1 else 0 end) as offday'),
                            DB::raw('sum(case when leave_flag = true then 1 else 0 end) as n_leave'),
                            DB::raw('sum(case when holiday_flag = true then 1 else 0 end) as holiday'),
                            DB::raw('sum(case when attend_status = "A" and leave_flag = false and  holiday_flag = false and offday_flag = false then 1 else 0 end) as absent')
                        )
                        ->groupBy('attend_date','department_id')
                        ->with('department')
                        ->get();

                    return view('attendance.report.date-wise-attendance-report-index',compact('data'));

                    break;

                case 'print':

                    dd('print');



                    $view = \View::make('prescription.pdf-print-prescription',compact('prescription','patient'));
                    $html = $view->render();

                    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
//                    $pdf = new TCPDF('L', PDF_UNIT, array(105,148), true, 'UTF-8', false);
//                    $pdf::setMargin(0,0,0);

                    $fontname = TCPDF_FONTS::addTTFfont('font/solaiman-lipi.ttf', 'TrueTypeUnicode', '', 32);
                    $pdf::SetFont($fontname, '', 14, '', false);

//        $fontname1 = TCPDF_FONTS::addTTFfont('font/solaiman-lipi.ttf', 'TrueTypeUnicode', '', 32);
//        $pdf::SetFont($fontname1, '', 8, '', false);



                    $pdf::SetMargins(10, 25, 5,0);

                    $pdf::AddPage();

                    $pdf::writeHTML($html, true, false, true, false, '');
                    $pdf::Output('prescription.pdf');

                    return view('prescription.pdf-print-prescription');

                    break;

            }
        }



        return view('attendance.report.date-wise-attendance-report-index');
    }

}
