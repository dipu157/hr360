<?php

namespace App\Http\Controllers\Overtime\Report;

use App\Exports\OvertimeSetupExport;
use App\Models\Common\Department;
use App\Models\Overtime\OvertimeSetup;
use Carbon\Carbon;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DateRangeOvertimeReportController extends Controller
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

        if(check_privilege(53,1) == false) //2=show Division  1=view
        {
            return redirect()->back()->with('error', trans('message.permission'));
            die();
        }

        $departments = Department::query()->where('company_id',$this->company_id)
            ->where('status',true)
            ->orderBy('name','ASC')
            ->pluck('name','id');


        if(!empty($request['action'])) {

            $from_date = Carbon::createFromFormat('d-m-Y', $request['from_date'])->format('Y-m-d');
            $to_date = Carbon::createFromFormat('d-m-Y', $request['to_date'])->format('Y-m-d');
            $department_id = $request['department_id'];
            $dept_data = Department::query()->where('company_id', $this->company_id)->where('id', $request['department_id'])->first();

            $dates = createDateRange($from_date, getNextDay($to_date) ,'Y-m-d');


            $data = OvertimeSetup::query()
                ->where('company_id', $this->company_id)
                ->whereBetween('ot_date', [$from_date, $to_date])
                ->with('professional')
                ->whereHas('professional',function ($query) use($department_id){
                    $query->where('department_id',$department_id);
                })
                ->with('approver')
                ->with('user')
                ->orderBy('ot_date','ASC')
                ->get();

            switch ($request['action']) {


                case 'preview':

                    return view('overtime.report.date-range-overtime-index', compact('data', 'from_date', 'to_date', 'dept_data', 'departments','dates'));

                    break;

                case 'print':


                    $view = \View::make('overtime.report.print-date-range-overtime', compact('data', 'from_date', 'to_date', 'dept_data', 'departments','dates'));
                    $html = $view->render();

                    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);

                    $pdf::SetMargins(20, 5, 5,0);

                    $pdf::AddPage();

                    $pdf::writeHTML($html, true, false, true, false, '');
                    $pdf::Output('overtime.pdf');

                    break;

                case 'excel':

//                    dd($data);

//                    foreach ($data as $row)
//                    {
//                        $row['department_name'] = preg_replace("/[^a-zA-Z 0-9]+/", "", $row->professional->department->name );
//                        $row['designation_name'] = preg_replace("/[^a-zA-Z 0-9]+/", "", $row->professional->designation->name );
//                        $final->push($row);
//                    }


                    return Excel::download(new OvertimeSetupExport($data,$from_date,$to_date,$dept_data,$dates,$departments), 'OvertimeExport.xls');






            }
        }

        return view('overtime.report.date-range-overtime-index',compact('departments'));
    }
}
