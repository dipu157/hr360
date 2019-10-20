<?php

namespace App\Http\Controllers\Roster;

use App\Models\Common\Department;
use App\Models\Common\Division;
use App\Models\Common\Section;
use App\Models\Employee\EmpPersonal;
use App\Models\Employee\EmpProfessional;
use App\Models\Roster\DutyLocation;
use App\Models\Roster\Roster;
use App\Models\Roster\Shift;
use Carbon\Carbon;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;


class EmployeeRosterController extends Controller
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

        if(check_privilege(23,1) == false) //2=show Division  1=view
        {
            return redirect()->back()->with('error', trans('message.permission'));
            die();
        }

//        $db_ext = DB::connection('sqlsrv');
//        $data =  $db_ext->select("select * from pr_tblRoster where Year = 2019 and Month = 3;");
//
////        dd($data);
//
//
//        Roster::query()->where('company_id',$this->company_id)
//            ->where('r_year','2019')->where('month_id',3)->delete();
//
////        dd('complete');
//
//        DB::beginTransaction();
//
//        try {
//
//            foreach ($data as $i=>$row)
//            {
////                dd($row);
//
//                $emp_prof = EmpProfessional::query()->where('employee_id',$row->EmpID)->first();
//
////                dd($emp_prof);
//
//                if(!empty($emp_prof))
//
//                    Roster::query()->firstOrCreate(['employee_id' => $row->EmpID,'r_year'=>$row->Year,'month_id'=>$row->Month],
//                    ['company_id'=>$this->company_id,
//                        'department_id'=>$emp_prof->department_id,
////                        'r_year'=>$row->Year,
////                        'month_id' => $row->Month,
//                        'day_01'=>Shift::query()->where('shift_code',$row->Day01)->value('id'),
//                        'day_02'=>Shift::query()->where('shift_code',$row->Day02)->value('id'),
//                        'day_03'=>Shift::query()->where('shift_code',$row->Day03)->value('id'),
//                        'day_04'=>Shift::query()->where('shift_code',$row->Day04)->value('id'),
//                        'day_05'=>Shift::query()->where('shift_code',$row->Day05)->value('id'),
//                        'day_06'=>Shift::query()->where('shift_code',$row->Day06)->value('id'),
//                        'day_07'=>Shift::query()->where('shift_code',$row->Day07)->value('id'),
//                        'day_08'=>Shift::query()->where('shift_code',$row->Day08)->value('id'),
//                        'day_09'=>Shift::query()->where('shift_code',$row->Day09)->value('id'),
//                        'day_10'=>Shift::query()->where('shift_code',$row->Day10)->value('id'),
//                        'day_11'=>Shift::query()->where('shift_code',$row->Day11)->value('id'),
//                        'day_12'=>Shift::query()->where('shift_code',$row->Day12)->value('id'),
//                        'day_13'=>Shift::query()->where('shift_code',$row->Day13)->value('id'),
//                        'day_14'=>Shift::query()->where('shift_code',$row->Day14)->value('id'),
//                        'day_15'=>Shift::query()->where('shift_code',$row->Day15)->value('id'),
//                        'day_16'=>Shift::query()->where('shift_code',$row->Day16)->value('id'),
//                        'day_17'=>Shift::query()->where('shift_code',$row->Day17)->value('id'),
//                        'day_18'=>Shift::query()->where('shift_code',$row->Day18)->value('id'),
//                        'day_19'=>Shift::query()->where('shift_code',$row->Day19)->value('id'),
//                        'day_20'=>Shift::query()->where('shift_code',$row->Day20)->value('id'),
//                        'day_21'=>Shift::query()->where('shift_code',$row->Day21)->value('id'),
//                        'day_22'=>Shift::query()->where('shift_code',$row->Day22)->value('id'),
//                        'day_23'=>Shift::query()->where('shift_code',$row->Day23)->value('id'),
//                        'day_24'=>Shift::query()->where('shift_code',$row->Day24)->value('id'),
//                        'day_25'=>Shift::query()->where('shift_code',$row->Day25)->value('id'),
//                        'day_26'=>Shift::query()->where('shift_code',$row->Day26)->value('id'),
//                        'day_27'=>Shift::query()->where('shift_code',$row->Day27)->value('id'),
//                        'day_28'=>Shift::query()->where('shift_code',$row->Day28)->value('id'),
//                        'day_29'=>Shift::query()->where('shift_code',$row->Day29)->value('id'),
//                        'day_30'=>Shift::query()->where('shift_code',$row->Day30)->value('id'),
//                        'day_31'=>Shift::query()->where('shift_code',$row->Day31)->value('id'),
//                        'loc_01'=>DutyLocation::query()->where('old_id',$row->Location)->value('id'),
//                        'loc_02'=>DutyLocation::query()->where('old_id',$row->Location)->value('id'),
//                        'loc_03'=>DutyLocation::query()->where('old_id',$row->Location)->value('id'),
//                        'loc_04'=>DutyLocation::query()->where('old_id',$row->Location)->value('id'),
//                        'loc_05'=>DutyLocation::query()->where('old_id',$row->Location)->value('id'),
//                        'inserted_by'=>$this->user_id,
//                        'inserted_date'=>Carbon::now(),
//                        'user_id'=>Auth::user()->id,
//                        'status'=>true
//                    ]);
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

//        $da = Roster::query()
//            ->where('r_year',2019)
//        ->where('month_id',3)
//        ->where('status',false)->get();
//
//        dd($da);


//


        $divisions = Division::query()->where('company_id',$this->company_id)->pluck('name','id');
        $departments = Department::query()->where('company_id',$this->company_id)
            ->where('status',true)->pluck('name','id');

        $sections = Section::query()->where('company_id',$this->company_id)
            ->where('department_id',$request->session()->get('session_user_dept_id'))->pluck('name','id');

        $user_dept = Department::query()->where('id',$request->session()->get('session_user_dept_id'))->first();

        $month_days = cal_days_in_month(CAL_GREGORIAN,$user_dept->roster_month_id,$user_dept->roster_year);

        $r_year = $user_dept->roster_year;
        $r_month = $user_dept->roster_month_id;

        $data_list = EmpProfessional::query()
            ->with(['roster'=>function ($query) use($r_month,$r_year){
                $query->where('r_year',$r_year)->where('month_id',$r_month)
                    ->orderBy('employee_id','desc');
            }])
            ->with('personal')->with('department')
            ->where('company_id',$this->company_id)
            ->where('department_id',$request->session()->get('session_user_dept_id'))
            ->whereIn('working_status_id',[1,2])
            ->take(60)
            ->get();

            $emp_list = $data_list->where('roster.status',false);

//            Get Single Single Employee Roster

            if($request->filled('search_name'))
            {

                $r_year = $request['r_year'];
                $r_month = $request['r_month'];

                $emp_id = $request['search_id'];

                $emp_list = EmpProfessional::query()->where('company_id',$this->company_id)
                    ->where('employee_id',$emp_id)
                    ->with(['roster'=>function ($query) use($r_month,$r_year){
                        $query->where('r_year',$r_year)->where('month_id',$r_month)
                            ->orderBy('employee_id','desc');
                    }])
                    ->with('personal')
                    ->get();

            }

            //Employee By Section

            if($request->filled('section_id'))
            {

                $r_year = $request['r_year'];
                $r_month = $request['r_month'];

                $section_id = $request['section_id'];

                $emp_list = EmpProfessional::query()->where('company_id',$this->company_id)
                    ->where('section_id',$section_id)
                    ->with(['roster'=>function ($query) use($r_month,$r_year){
                        $query->where('r_year',$r_year)->where('month_id',$r_month)
                            ->orderBy('employee_id','desc');
                    }])
                    ->with('personal')
                    ->get();

            }

        // For Employee Joined After Approved

            if($request->filled('search_new'))
            {

                $r_year = $request['search_year'];
                $r_month = $request['search_month'];

                $month_days=cal_days_in_month(CAL_GREGORIAN,$user_dept->roster_month_id,$user_dept->roster_year);

                $emp_list  = EmpProfessional::query()->where('company_id',$this->company_id)
                    ->where('department_id',$request->session()->get('session_user_dept_id'))
                    ->whereIn('working_status_id',[1,2])
                    ->with('roster')
                    ->whereDoesntHave('roster',function (Builder $query) use($r_year,$r_month){
                        $query->where('r_year',$r_year)->where('month_id',$r_month);
                    } )
                    ->get();
            }

        $shifts = Shift::query()->where('company_id',$this->company_id)
            ->select(DB::raw('CONCAT(short_name, " : ", from_time,"-",to_time) AS shift'), 'id')
            ->where('status',true)->pluck('shift','id');

        $locations = DutyLocation::query()->where('company_id',$this->company_id)->where('status',true)->pluck('location','id');

        return view('roster.employee-roster-index',compact('divisions','shifts','emp_list','locations','departments','sections','month_days','r_year','r_month'));
    }

    public function create(Request $request)
    {

        if(check_privilege(23,2) == false) //2=show Division  1=view
        {
//            return response()->json('error', trans('message.permission'),404);
            return response()->json(['error' => trans('message.permission')], 404);
            die();
        }


        $emp_id = Auth::user()->emp_id;
        $emp_dept = EmpProfessional::query()->where('employee_id',$emp_id)->first();
        $dept_data = Department::query()->where('company_id',$this->company_id)->where('id',$emp_dept->department_id)->first();

        $request['company_id'] = $this->company_id;
        $request['user_id'] = $this->user_id;
        $request['status'] = false;
//        $request['r_year'] = $request['r_year'];
        $request['month_id'] = $request['r_month'];
        $request['inserted_by'] = $this->user_id;
        $request['department_id'] = $emp_dept->department_id;


        DB::beginTransaction();

        try {

            switch ($request['week_id'])
            {
                case    'first':

                    $off_count = 0;

                    $off_count = $off_count + ($request['day_01'] == 1 ?  1 : 0);
                    $off_count = $off_count + ($request['day_02'] == 1 ?  1 : 0);
                    $off_count = $off_count + ($request['day_03'] == 1 ?  1 : 0);
                    $off_count = $off_count + ($request['day_04'] == 1 ?  1 : 0);
                    $off_count = $off_count + ($request['day_05'] == 1 ?  1 : 0);
                    $off_count = $off_count + ($request['day_06'] == 1 ?  1 : 0);
                    $off_count = $off_count + ($request['day_07'] == 1 ?  1 : 0);

//                    if($off_count > 1)
//                    {
//                        return response()->json(['error' => 'More Than One Off Day In A Week Not Allowed'], 404);
//                    }


                    if (Roster::query()->where('company_id', $this->company_id)
                        ->where('employee_id',$request['employee_id'])->where('r_year',$request['r_year'])->where('month_id',$request['month_id'])
                        ->exists())
                    {

                        $data = Roster::query()->where('company_id', $this->company_id)
                            ->where('employee_id',$request['employee_id'])
                            ->where('r_year',$request['r_year'])
                            ->where('month_id',$request['month_id'])
                            ->update([
                                'day_01'=>$request['day_01'],
                                'day_02'=>$request['day_02'],
                                'day_03'=>$request['day_03'],
                                'day_04'=>$request['day_04'],
                                'day_05'=>$request['day_05'],
                                'day_06'=>$request['day_06'],
                                'day_07'=>$request['day_07'],
                                'loc_01'=>$request['loc_01'],
                                'loc_05'=>$request['loc_01'],
                            ]);
                    }else{

                        $request['loc_05'] = $request['loc_01'];
                        $data = Roster::query()->create($request->all());
                    }

                    break;

                case    'second':


                    $off_count = 0;

                    $off_count = $off_count + ($request['day_08'] == 1 ?  1 : 0);
                    $off_count = $off_count + ($request['day_09'] == 1 ?  1 : 0);
                    $off_count = $off_count + ($request['day_10'] == 1 ?  1 : 0);
                    $off_count = $off_count + ($request['day_11'] == 1 ?  1 : 0);
                    $off_count = $off_count + ($request['day_12'] == 1 ?  1 : 0);
                    $off_count = $off_count + ($request['day_13'] == 1 ?  1 : 0);
                    $off_count = $off_count + ($request['day_14'] == 1 ?  1 : 0);

//                    if($off_count > 1)
//                    {
//                        return response()->json(['error' => 'More Than One Off Day In A Week Not Allowed'], 404);
//                    }


                    if (Roster::query()->where('company_id', $this->company_id)
                        ->where('employee_id',$request['employee_id'])->where('r_year',$request['r_year'])->where('month_id',$request['month_id'])
                        ->exists())
                    {

                        $data = Roster::query()->where('company_id', $this->company_id)
                            ->where('employee_id',$request['employee_id'])
                            ->where('r_year',$request['r_year'])
                            ->where('month_id',$request['month_id'])
                            ->update([
                                'day_08'=>$request['day_08'],
                                'day_09'=>$request['day_09'],
                                'day_10'=>$request['day_10'],
                                'day_11'=>$request['day_11'],
                                'day_12'=>$request['day_12'],
                                'day_13'=>$request['day_13'],
                                'day_14'=>$request['day_14'],
                                'loc_02'=>$request['loc_02'],
                                'loc_05'=>$request['loc_02'],
                            ]);
                    }else{

                        $request['loc_05'] = $request['loc_01'];
                        $data = Roster::query()->create($request->all());
                    }

                    break;



                case    'third':

//                    dd($request);
                    $off_count = 0;

                    $off_count = $off_count + ($request['day_15'] == 1 ?  1 : 0);
                    $off_count = $off_count + ($request['day_16'] == 1 ?  1 : 0);
                    $off_count = $off_count + ($request['day_17'] == 1 ?  1 : 0);
                    $off_count = $off_count + ($request['day_18'] == 1 ?  1 : 0);
                    $off_count = $off_count + ($request['day_19'] == 1 ?  1 : 0);
                    $off_count = $off_count + ($request['day_20'] == 1 ?  1 : 0);
                    $off_count = $off_count + ($request['day_21'] == 1 ?  1 : 0);

//                    if($off_count > 1)
//                    {
//                        return response()->json(['error' => 'More Than One Off Day In A Week Not Allowed'], 404);
//                    }

                    if (Roster::query()->where('company_id', $this->company_id)
                        ->where('employee_id',$request['employee_id'])->where('r_year',$request['r_year'])->where('month_id',$request['month_id'])
                        ->exists())
                    {

                        $data = Roster::query()->where('company_id', $this->company_id)
                            ->where('employee_id',$request['employee_id'])
                            ->where('r_year',$request['r_year'])
                            ->where('month_id',$request['month_id'])
                            ->update([
                                'day_15'=>$request['day_15'],
                                'day_16'=>$request['day_16'],
                                'day_17'=>$request['day_17'],
                                'day_18'=>$request['day_18'],
                                'day_19'=>$request['day_19'],
                                'day_20'=>$request['day_20'],
                                'day_21'=>$request['day_21'],
                                'loc_03'=>$request['loc_03'],
                                'loc_05'=>$request['loc_03'],
                            ]);
                    }else{

                        $request['loc_05'] = $request['loc_01'];
                        $data = Roster::query()->create($request->all());
                    }

                    break;


                case    'forth':

//                    dd($request);

                    $off_count = 0;

                    $off_count = $off_count + ($request['day_22'] == 1 ?  1 : 0);
                    $off_count = $off_count + ($request['day_23'] == 1 ?  1 : 0);
                    $off_count = $off_count + ($request['day_24'] == 1 ?  1 : 0);
                    $off_count = $off_count + ($request['day_25'] == 1 ?  1 : 0);
                    $off_count = $off_count + ($request['day_26'] == 1 ?  1 : 0);
                    $off_count = $off_count + ($request['day_27'] == 1 ?  1 : 0);
                    $off_count = $off_count + ($request['day_28'] == 1 ?  1 : 0);

//                    if($off_count > 1)
//                    {
//                        return response()->json(['error' => 'More Than One Off Day In A Week Not Allowed'], 404);
//                    }

                    if (Roster::query()->where('company_id', $this->company_id)
                        ->where('employee_id',$request['employee_id'])->where('r_year',$request['r_year'])->where('month_id',$request['month_id'])
                        ->exists())
                    {

                        $data = Roster::query()->where('company_id', $this->company_id)
                            ->where('employee_id',$request['employee_id'])
                            ->where('r_year',$request['r_year'])
                            ->where('month_id',$request['month_id'])
                            ->update([
                                'day_22'=>$request['day_22'],
                                'day_23'=>$request['day_23'],
                                'day_24'=>$request['day_24'],
                                'day_25'=>$request['day_25'],
                                'day_26'=>$request['day_26'],
                                'day_27'=>$request['day_27'],
                                'day_28'=>$request['day_28'],
                                'loc_04'=>$request['loc_04'],
                                'loc_05'=>$request['loc_04'],
                            ]);
                    }else{

                        $request['loc_05'] = $request['loc_01'];
                        $data = Roster::query()->create($request->all());
                    }

                    break;

//Fifth week

                case    'fifth':

//                    dd($request);

                    if (Roster::query()->where('company_id', $this->company_id)
                        ->where('employee_id',$request['employee_id'])->where('r_year',$request['r_year'])->where('month_id',$request['month_id'])
                        ->exists())
                    {

                        $data = Roster::query()->where('company_id', $this->company_id)
                            ->where('employee_id',$request['employee_id'])
                            ->where('r_year',$request['r_year'])
                            ->where('month_id',$request['month_id'])
                            ->update([
                                'day_29'=>$request['day_29'],
                                'day_30'=>$request['day_30'],
                                'day_31'=>$request['day_31'],
                                'loc_05'=>$request['loc_05'],
                            ]);
                    }else{

                        $data = Roster::query()->create($request->all());
                    }

                    break;

            }


        }catch (\Exception $e)
        {
            DB::rollBack();
            $error = $e->getMessage();
//            $request->session()->flash('alert-danger', $error.'Not Saved');
            return response()->json(['error' => $error], 404);
//            return redirect()->back()->with('error','Not Saved '.$error);
        }

        DB::commit();


        return json_encode($data);
    }
}
