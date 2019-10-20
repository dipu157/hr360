<?php

namespace App\Http\Controllers\Payroll\Salary;

use App\Models\Common\Bank;
use App\Models\Common\OrgCalender;
use App\Models\Common\Section;
use App\Models\Employee\EmpProfessional;
use App\Models\Payroll\MonthlySalary;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalaryReportController extends Controller
{
    public function index(Request $request)
    {

        if(check_privilege(703,1) == false) //2=show Division  1=view
        {
            return redirect()->back()->with('error', trans('message.permission'));
            die();
        }

        $periods = OrgCalender::query()->where('company_id',1)->pluck('month_name','id');

        if($request->filled('action'))
        {
            $period = OrgCalender::query()->where('calender_year',$request['year_id'])
                ->where('month_id',$request['month_id'])->first();

            $salaries = EmpProfessional::query()->where('emp_professionals.company_id',1)
//                ->whereIn('emp_professionals.department_id',[5])
                ->whereIn('working_status_id',[1,2,8])
                ->with(['salary'=>function($query) use ($period) {
                    $query->where('period_id',$period->id);
                }])
                ->join('designations','designations.id','=','emp_professionals.designation_id')
                ->orderBy('designations.precedence')
                ->with('personal')
//                ->take(300)
                ->get();

//            dd($salaries);

            $sections = $salaries->unique('section_id');

//            $sections = Section::query()->where('company_id',1)->where('status',true)->get();

//            dd($sections);

            $departments = $salaries->unique('department_id');


            $dept_sum = $salaries->groupBy('department_id')->map(function ($row)  {

                $grouped = Collect();

//                $row->department_id = $row->department_id;
                $row->basic = $row->sum('salary.basic');
                $row->house_rent = $row->sum('salary.house_rent');
                $row->medical = $row->sum('salary.medical');
                $row->entertainment = $row->sum('salary.entertainment');

                $row->conveyance = $row->sum('salary.conveyance');
                $row->other_allowance = $row->sum('salary.other_allowance');
                $row->gross_salary = $row->sum('salary.gross_salary');
                $row->paid_days = $row->sum('salary.paid_days');
                $row->earned_salary = $row->sum('salary.earned_salary');
                $row->increment_amt = $row->sum('salary.increment_amt');
                $row->arear_amount = $row->sum('salary.arear_amount');
                $row->overtime_hour = $row->sum('salary.overtime_hour');
                $row->overtime_amount = $row->sum('salary.overtime_amount');
                $row->payable_salary = $row->sum('salary.payable_salary');

                $row->income_tax = $row->sum('salary.income_tax');
                $row->advance = $row->sum('salary.advance');
                $row->mobile_others = $row->sum('salary.mobile_others');
                $row->stamp_fee = $row->sum('salary.stamp_fee');
                $row->food_charge = $row->sum('salary.food_charge');
                $row->net_salary = $row->sum('salary.net_salary');





                $grouped->push($row);

                return $grouped;

            });

//            dd($dept_sum);


//            dd($departments);

            $view = \View::make('payroll.salary.report.pdf-monthly-salary', compact('period','salaries','sections','departments','dept_sum'));
            $html = $view->render();

            $pdf = new TCPDF('L', PDF_UNIT, array(216,420), true, 'UTF-8', false);

//            set_time_limit(180);
            ini_set('max_execution_time', 900);
            ini_set('memory_limit', '1024M');
            ini_set("output_buffering", 10240);
            ini_set('max_input_time',300);
            ini_set('default_socket_timeout',300);
            ini_set('pdo_mysql.cache_size',4000);
            ini_set('pcre.backtrack_limit', 10000000);




//            $pdf::SetMargins(10, 5, 5,0);



            $pdf::changeFormat(array(216,420));
            $pdf::reset();

            $pdf::AddPage('L');

            $pdf::setFooterCallback(function($pdf){

                // Position at 15 mm from bottom
                $pdf->SetY(-10);
                // Set font
                $pdf->SetFont('helvetica', 'I', 8);
                // Page number
                $pdf->Cell(0, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');

            });


            $pdf::writeHTML($html, true, false, true, false, '');



            $pdf::Output('salary.pdf');

        }

        return view('payroll.salary.report.monthly-salary-report-index',compact('periods'));
    }

    public function bankLetterIndex(Request $request)
    {

        if(check_privilege(703,1) == false) //2=show Division  1=view
        {
            return redirect()->back()->with('error', trans('message.permission'));
            die();
        }

        $banks = Bank::query()->where('company_id',1)->pluck('name','id');

        if(!empty($request['month_id']))
        {
            $period = OrgCalender::query()->where('calender_year',$request['year_id'])
                ->where('month_id',$request['month_id'])->first();

            $bank = Bank::query()->where('id',$request['bank_id'])->first();

            $salaries = EmpProfessional::query()->where('emp_professionals.company_id',1)
                ->whereIn('working_status_id',[1,2,8])
                ->with(['salary'=>function($query) use ($period,$bank) {
                    $query->where('period_id',$period->id)->where('bank_id',$bank->id)->where('withheld',false);
                }])
                ->whereHas('salary',function ($query) use ($period,$bank) {
                    $query->where('period_id',$period->id)->where('bank_id',$bank->id)->where('withheld',false);
                })
                ->join('designations','designations.id','=','emp_professionals.designation_id')
                ->orderBy('designations.precedence')
                ->with('personal')
                ->get();


            $view = \View::make('payroll.salary.report.pdf.pdf-bank-letter', compact('period','salaries','bank'));
            $html = $view->render();

            $pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);

//            set_time_limit(180);
            ini_set('max_execution_time', 900);
            ini_set('memory_limit', '1024M');
            ini_set("output_buffering", 10240);
            ini_set('max_input_time',300);
            ini_set('default_socket_timeout',300);
            ini_set('pdo_mysql.cache_size',4000);
            ini_set('pcre.backtrack_limit', 5000000);


//            $pdf::changeFormat(array(216,420));
//            $pdf::reset();

            $pdf::SetMargins(30, 45, 10,20);


            $pdf::AddPage('P');

            $pdf::setFooterCallback(function($pdf){

                // Position at 15 mm from bottom
                $pdf->SetY(-10);
                // Set font
                $pdf->SetFont('helvetica', 'I', 8);
                // Page number
                $pdf->Cell(0, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');

            });


            $pdf::writeHTML($html, true, false, true, false, '');

            $pdf::Output('bankLetter.pdf');

        }


        return view('payroll.salary.report.bank-letter-index',compact('banks'));
    }
}
