<?php

namespace App\Http\Controllers\Employee\Report;

use App\Exports\EmployeeExport;
use App\Models\Common\Department;
use App\Models\Common\WorkingStatus;
use App\Models\Employee\EmpProfessional;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Elibyy\TCPDF\Facades\TCPDF;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeListController extends Controller
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

        $departments = Department::query()->where('company_id',$this->company_id)
            ->where('status',true)
            ->orderBy('name')
            ->pluck('name','id');

        $wStatus = WorkingStatus::query()->where('company_id',$this->company_id)
            ->where('status',true)
            ->orderBy('id')
            ->pluck('name','id');

        if($request->filled('search_id'))
        {



            $departments = Department::query()->where('company_id',$this->company_id)
                ->where('status',true)
                ->orderBy('name')->get();

            if($request->filled('department_id'))
            {
                $employees = EmpProfessional::query()->whereIn('working_status_id',[1,2,8])
//                    ->where('department_id',$request['department_id'])
//                    ->where('department_id','>=',15)
                    ->whereIn('working_status_id',[1,2,8])
                    ->orderBy('id','DESC')
                    ->get();

//                dd($employees);

            }else{
                $employees = EmpProfessional::query()
                    ->whereIn('working_status_id',[1,2,8])
//                    ->take(500)
                    ->get();
            }

            switch($request['action'])
            {
                case    'export':

                    return Excel::download(new EmployeeExport(), 'employee.xlsx');
                    break;

                case    'print':

//                    dd(ini_get('pdo_mysql.cache_size'));

                    ini_set('max_execution_time', 900);
                    ini_set('memory_limit', '1024M');
                    ini_set("output_buffering", 10240);
                    ini_set('max_input_time',300);
                    ini_set('default_socket_timeout',300);
                    ini_set('pdo_mysql.cache_size',4000);
                    ini_set('pcre.backtrack_limit', 5000000);

                    $view = \View::make('employee.report.print.pdf-employee-list', compact('employees','departments'));
                    $html = $view->render();

                    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);

//                    dd(ini_get('max_execution_time'));

                    $pdf::SetMargins(20, 5, 5,0);

                    $pdf::AddPage();

//                    $employees->chunk(100, function ($rows) use($pdf, $html) {

                        $pdf::writeHTML($html, true, false, true, false, '');

//                    });

                    $pdf::Output('employees.pdf');

                    break;
            }

        }

        return view('employee.report.employee-list-index',compact('departments','wStatus'));
    }

    public function wStatus(Request $request)
    {

        $employees = EmpProfessional::query()
            ->where('working_status_id',$request['status_id'])
            ->get();

        $status = WorkingStatus::query()->where('id',$request['status_id'])->first();


        $departments = $employees->unique('department_id');

//        dd($departments);

        $view = \View::make('employee.report.print.pdf-emp-list-working-status', compact('employees','departments','status'));
        $html = $view->render();

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);

        ini_set('max_execution_time', 900);
        ini_set('memory_limit', '1024M');
        ini_set("output_buffering", 10240);
        ini_set('max_input_time',300);
        ini_set('default_socket_timeout',300);
        ini_set('pdo_mysql.cache_size',4000);
        ini_set('pcre.backtrack_limit', 5000000);

        $pdf::SetMargins(20, 5, 5,0);

        $pdf::AddPage();

        $pdf::writeHTML($html, true, false, true, false, '');
        $pdf::Output('employees.pdf');

        return view('pdf-emp-list-working-status');
    }


}
