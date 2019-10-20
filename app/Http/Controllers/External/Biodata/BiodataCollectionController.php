<?php

namespace App\Http\Controllers\External\Biodata;

use App\Models\External\Biodata\BiodataCollection;
use Carbon\Carbon;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BiodataCollectionController extends Controller
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

    public function index()
    {

        $data = BiodataCollection::query()->orderBy('id', 'desc')->take(5)->get();

        return view('external.biodata.biodata-submission-index',compact('data'));
    }

    public function create(Request $request)
    {
        DB::beginTransaction();

        try {

            $request['company_id'] = $this->company_id;
            $request['user_id'] = $this->user_id;
            $request['submission_date'] =  Carbon::createFromFormat('d-m-Y',$request['submission_date'])->format('Y-m-d');
            $s_year =  Carbon::now()->format('Y');

            $max_no = BiodataCollection::query()->where('company_id',$this->company_id)
                ->max('issue_number');
            $issue_no = $max_no > 0 ? $max_no + 1 : $s_year.'0001';

            $request['issue_number'] = $issue_no;

            $id = BiodataCollection::query()->create($request->all());

        }catch (\Exception $e)
        {
            DB::rollBack();
            $error = $e->getMessage();
//            $request->session()->flash('alert-danger', $error.'Not Saved');
            return redirect()->back()->with('error',$error);
//            return response()->json(['error' => $error], 404);
        }

        DB::commit();


        return redirect()->action('External\Biodata\BiodataCollectionController@index')->with('success','Bio Data Successfully Created. ID :'.$id->issue_number);

    }

    public function updateIndex(Request $request)
    {

        $data = null;

        if(!empty($request['search_id']))
        {
            $data = BiodataCollection::query()->where('company_id',$this->company_id)
                ->where('id',$request['search_id'])->first();

        }
        return view('external.biodata.bio-data-update',compact('data'));
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        try {

            $request['submission_date'] =  Carbon::createFromFormat('d-m-Y',$request['submission_date'])->format('Y-m-d');
            $request['joining_date'] = $request->filled('joining_date') ? Carbon::createFromFormat('d-m-Y',$request['joining_date'])->format('Y-m-d') : null;

            BiodataCollection::query()->where('id',$request['update_id'])->update($request->except('_token','update_id'));

        }catch (\Exception $e)
        {
            DB::rollBack();
            $error = $e->getMessage();
//            $request->session()->flash('alert-danger', $error.'Not Saved');
            return redirect()->back()->with('error',$error);
//            return response()->json(['error' => $error], 404);
        }

        DB::commit();


        return redirect()->action('External\Biodata\BiodataCollectionController@updateIndex')->with('success','Bio Data Successfully Updated');

    }

    public function search(Request $request)
    {

        $date_wise = null;

        if($request->filled('submission_date'))
        {
            $from_date = Carbon::createFromFormat('Y-m-d',$request['from_date'])->format('Y-m-d');
            $to_date = Carbon::createFromFormat('Y-m-d',$request['to_date'])->format('Y-m-d');

            $data = BiodataCollection::query()->where('company_id',$this->company_id)
                ->whereBetween('submission_date',[$from_date,$to_date])->get();

            $title = 'Biodata Collection : Date from : '.Carbon::createFromFormat('Y-m-d',$request['from_date'])->format('d-m-Y'). ' To '.
                Carbon::createFromFormat('Y-m-d',$request['to_date'])->format('d-m-Y');



            switch($request['action'])
            {
                case 'preview':

                    return view('external.biodata.search-biodata-index',compact('data','from_date','to_date','title'));

                break;

                case 'print':

                    $view = \View::make('external.biodata.print.print-bio-data',compact('data','from_date','to_date','title'));
                    $html = $view->render();

                    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LEGAL', true, 'UTF-8', false);

                    $pdf::SetMargins(10, 5, 5,0);

                    $pdf::AddPage('L');

                    // for direct print

                    $pdf::writeHTML($html, true, false, true, false, '');


                    $pdf::Output('biodata.pdf');

            }



        }



        if($request->filled('search-name'))
        {

            $term = $request['search-name'];

            $data = BiodataCollection::query()->where('company_id',$this->company_id)
                ->where('name','LIKE',"%$term%")->get();

            $title = 'Biodata Collection : Search Name : '.$request['search-name'];



            switch($request['action'])
            {
                case 'preview':

                    return view('external.biodata.search-biodata-index',compact('data','from_date','to_date','title'));

                    break;

                case 'print':

                    $view = \View::make('external.biodata.print.print-bio-data',compact('data','from_date','to_date','title'));
                    $html = $view->render();

                    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LEGAL', true, 'UTF-8', false);

                    $pdf::SetMargins(10, 5, 5,0);

                    $pdf::AddPage('L');

                    // for direct print

                    $pdf::writeHTML($html, true, false, true, false, '');


                    $pdf::Output('biodata.pdf');

            }



        }




        if($request->filled('search-mobile'))
        {

            $term = $request['search-mobile'];

            $data = BiodataCollection::query()->where('company_id',$this->company_id)
                ->where('mobile_no','LIKE',"%$term%")->get();

            $title = 'Biodata Collection : Search Mobile No : '.$request['search-mobile'];



            switch($request['action'])
            {
                case 'preview':

                    return view('external.biodata.search-biodata-index',compact('data','from_date','to_date','title'));

                    break;

                case 'print':

                    $view = \View::make('external.biodata.print.print-bio-data',compact('data','from_date','to_date','title'));
                    $html = $view->render();

                    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LEGAL', true, 'UTF-8', false);

                    $pdf::SetMargins(10, 5, 5,0);

                    $pdf::AddPage('L');

                    // for direct print

                    $pdf::writeHTML($html, true, false, true, false, '');


                    $pdf::Output('biodata.pdf');

            }



        }





        if($request->filled('applied_post'))
        {
            $from_date = Carbon::createFromFormat('Y-m-d',$request['date_after'])->format('Y-m-d');
            $term = $request['applied_post'];

            $data = BiodataCollection::query()->where('company_id',$this->company_id)
                ->where('applied_post','LIKE',"%$term%")
                ->where('submission_date','>=',$from_date)->get();


            $title = 'Biodata Collection After Date : '.Carbon::createFromFormat('Y-m-d',$request['date_after'])->format('d-m-Y');



            switch($request['action'])
            {
                case 'preview':

                    return view('external.biodata.search-biodata-index',compact('data','from_date','to_date','title'));

                    break;

                case 'print':

                    $view = \View::make('external.biodata.print.print-bio-data',compact('data','from_date','to_date','title'));
                    $html = $view->render();

                    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LEGAL', true, 'UTF-8', false);

                    $pdf::SetMargins(10, 5, 5,0);

                    $pdf::AddPage('L');

                    // for direct print

                    $pdf::writeHTML($html, true, false, true, false, '');


                    $pdf::Output('biodata.pdf');

            }



        }


        if($request->filled('reference_name'))
        {
            $term = $request['reference_name'];

            $data = BiodataCollection::query()->where('company_id',$this->company_id)
                ->where('reference_name','like',"%$term%")->get();

            $title = 'Biodata Collection From Reference : '.$request['reference_name'];



            switch($request['action'])
            {
                case 'preview':

                    return view('external.biodata.search-biodata-index',compact('data','from_date','to_date','title'));

                    break;

                case 'print':

                    $view = \View::make('external.biodata.print.print-bio-data',compact('data','from_date','to_date','title'));
                    $html = $view->render();

                    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LEGAL', true, 'UTF-8', false);

                    $pdf::SetMargins(10, 5, 5,0);

                    $pdf::AddPage('L');

                    // for direct print

                    $pdf::writeHTML($html, true, false, true, false, '');


                    $pdf::Output('biodata.pdf');

            }

        }


        return view('external.biodata.search-biodata-index',compact('date_wise'));

    }
}
