<?php

namespace App\Http\Controllers\Leave;

use App\Models\Common\Department;
use App\Models\Employee\EmpPersonal;
use App\Models\Employee\EmpProfessional;
use App\Models\Leaves\LeaveApplication;
use App\Models\Leaves\LeaveMaster;
use App\Models\Leaves\LeaveRegister;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ApplyLeaveController extends Controller
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
        if(check_privilege(29,1) == false) //2=show Division  1=view
        {
            return redirect()->back()->with('error', trans('message.permission'));
            die();
        }

//         LEAVE CALCULATION UPDATE


//        $actual = DB::Select("SELECT `emp_personals_id`, `leave_id`, sum(nods) nods  FROM `leave_applications` WHERE `status` = 'A' and leave_year = 2019 group by `emp_personals_id`, `leave_id` ");
//
//        $register = DB::Select("Select * from leave_registers");
//
//        foreach ($register as $reg)
//        {
//            foreach ($actual as $row)
//            {
//                if(($reg->emp_personals_id == $row->emp_personals_id) and ($reg->leave_id == $row->leave_id))
//                {
//                    if($reg->leave_enjoyed <> $row->nods)
//                    {
//                        LeaveRegister::query()->where('id',$reg->id)
//                            ->update(['leave_enjoyed'=>$row->nods]);
//
//                    }
//                }
//            }
//        }
//
//        DB::update("update leave_registers set leave_balance = leave_eligible - leave_enjoyed where leave_id in(1,2,4)");


//        LEAVE GET FROM AKHIL

//        $db_ext = DB::connection('sqlsrv');
//        $data =  $db_ext->select("SELECT l.Emp_no, p.Emp_Old_No, l.Leave_id, l.From_Dt, l.To_Dt,l.No_of_days
//                                          FROM Pr_Leave_detail l JOIN Pr_Emp_Personal p
//                                            ON l.Emp_no = p.Emp_No
//                                         where l.From_Dt > '2018-12-31' order by l.From_Dt;");
//
////        dd($data);
//
//
//        DB::beginTransaction();
//
//        try {
//
//            foreach ($data as $i=>$row)
//            {
////                dd($row);
//
//                $emp_prof = EmpProfessional::query()->where('employee_id',$row->Emp_Old_No)->first();
//
////                dd($emp_prof);
//
//                if(!empty($emp_prof))
//                {
//                    switch($row->Leave_id)
//                    {
//                        case 6:
//                            $leave_id = 5;
//                        break;
//
//                        case 7:
//                            $leave_id = 6;
//                            break;
//                        case 8:
//                            $leave_id = 7;
//                            break;
//                        case 9:
//                            $leave_id = 8;
//                            break;
//                        case 11:
//                            $leave_id = 9;
//                            break;
//
//                        case 14:
//                            $leave_id = 10;
//                            break;
//                        default:
//                            $leave_id = $row->Leave_id;
//
//                            break;
//
//                    }
//
//                    LeaveApplication::query()->insert([
//                        'company_id'=>$this->company_id,
//                        'leave_year'=>'2019',
//                        'emp_personals_id' =>$emp_prof->emp_personals_id,
//                        'leave_id'=>$leave_id,
//                        'from_date'=>$row->From_Dt,
//                        'to_date'=>$row->To_Dt,
//                        'nods' =>$row->No_of_days,
//                        'application_time'=>$row->From_Dt,
//                        'reason'=>'Migrated From Previous System',
//                        'location'=>'Migrated From Previous System',
//                        'alternate_id'=>$emp_prof->emp_personals_id,
//                        'alternate_submit'=>$row->From_Dt,
//                        'approver_id'=>1,
//                        'approve_date'=>$row->From_Dt,
//                        'recommend_id'=>1,
//                        'recommend_date'=>$row->From_Dt,
//                        'status'=>'A',
//                        'user_id'=>1
//                    ]);
//
//                    LeaveRegister::query()->where('emp_personals_id',$emp_prof->emp_personals_id)
//                        ->where('leave_id',$leave_id)->increment('leave_enjoyed',$row->No_of_days);
//
//                    if(($leave_id == 1) OR ($leave_id == 2) OR ($leave_id == 4))
//                    {
//                        LeaveRegister::query()->where('emp_personals_id',$emp_prof->emp_personals_id)
//                            ->where('leave_id',$leave_id)->decrement('leave_balance',round(trim($row->No_of_days)));
//                    }
//                }
//            }
//
//        }catch (\Exception $e)
//        {
//            DB::rollBack();
//            $error = $e->getMessage();
//            dd($error);
//            $request->session()->flash('alert-danger', $error.'Not Saved');
//            return redirect()->back();
//        }
//
//        DB::commit();
//
//        dd('complete');
////
////



        //

        if(!empty($request['emp_id']))
        {
            $emp_info = EmpPersonal::query()->where('id',$request['emp_id'])->first();
            $leaves = LeaveMaster::query()->where('company_id',$this->company_id)->pluck('name','id');

            $emp_leaves = LeaveMaster::query()->where('company_id',$this->company_id)->get();

            $l_year = Carbon::now()->format('Y');

            foreach ($emp_leaves as $row)
            {
                if (!LeaveRegister::query()->where('emp_personals_id', $request['emp_id'])
                    ->where('leave_id',$row->id)->where('leave_year',$l_year)
                    ->exists()) {

                    LeaveRegister::query()->insert([
                        'company_id'=>$this->company_id,
                        'emp_personals_id' =>$request['emp_id'],
                        'leave_id' =>$row['id'],
                        'leave_eligible' =>$row['yearly_limit'],
                        'leave_year'=>$l_year
                    ]);
                }
            }

            return view('leave.index.apply-leave-index',compact('emp_info','leaves'));
        }

        return view('leave.index.apply-leave-index');
    }

    public function create(Request $request)
    {

        if(check_privilege(29,2) == false) //2=show Division  1=view
        {
            return redirect()->back()->with('error', trans('message.permission'));
            die();
        }

        $validator = Validator::make($request->all(), [
            'from_date' => 'required',
            'to_date' => 'required',
            'alternate_id' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $dept_id = Session::get('session_user_dept_id');
        $leave_steps = Department::query()->whereId($dept_id)->first();


        $request['duty_date'] =  $request['leave_id'] == 3 ? Carbon::createFromFormat('d-m-Y',$request['duty_date']) : null;
        $request['from_date']= Carbon::createFromFormat('d-m-Y',$request['from_date'])->format('Y-m-d');
        $request['to_date'] = Carbon::createFromFormat('d-m-Y',$request['to_date'])->format('Y-m-d');
        $request['company_id'] = $this->company_id;
        $request['user_id'] = $this->user_id;
        $request['status'] =  $leave_steps->leave_steps == '1111' ? 'C' : 'K';
        $request['emp_personals_id'] = $request['emp_id'];
        $request['nods'] = dateDifference($request['from_date'],$request['to_date']) + 1;
        $today = Carbon::now()->format('Y-m-d');
        $request['application_time'] = $request['to_date'] < $today ? 'A' : 'B';
        $request['leave_year'] = Carbon::createFromFormat('Y-m-d',$request['from_date'])->format('Y');
//        $request['alternate_id']

        DB::beginTransaction();

        try {

            LeaveApplication::query()->create($request->all());

        }catch (\Exception $e)
        {
            DB::rollBack();
            $error = $e->getMessage();
//            $request->session()->flash('alert-danger', $error.'Not Saved');
            return response()->json(['error' => $error], 404);
        }

        DB::commit();


        return redirect()->action('Leave\ApplyLeaveController@index')->with('success','Leave Application Successfully Created for Approval');
    }

}
