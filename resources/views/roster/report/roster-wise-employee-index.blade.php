@extends('layouts.master')

@section('pagetitle')
    <h2 class="no-margin-bottom">Roster Data For <strong style="color: #980000">{!! \Illuminate\Support\Facades\Session::get('session_user_dept_name') !!} </strong> Department</h2>
@endsection
@section('content')
    <script type="text/javascript" src="{!! asset('assets/js/jquery-3.3.1.min.js') !!}"></script>

    <link href="{!! asset('assets/css/jquery.datetimepicker.min.css') !!}" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{!! asset('assets/js/jquery.datetimepicker.js') !!}"></script>


    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6">
                <div class="pull-left">
                    <a class="btn btn-primary" href="{!! URL::previous() !!}"> <i class="fa fa-list"></i> Back </a>
                </div>
            </div>
        </div>


        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    {{--<div class="card-header">User Privillege</div>--}}

                    <div class="card-body">

                        <form class="form-inline" id="search-form" method="get" action="{{ route('roster/printRosterWiseEmployeeIndex') }}">

                            <div class="form-group mb-1 col-3">
                                {!! Form::select('session_id',['O'=>'OFF DAY','G'=>'GENERAL','M'=>'MORNING','E'=>'EVENING','N'=>'NIGHT','R'=>'NO ROSTER'], null,['id'=>'session_id', 'class'=>'form-control']) !!}
                                {{--{!! Form::select('shift_id',$shifts, null,['id'=>'shift_id', 'class'=>'form-control']) !!}--}}
                            </div>


                            <div class="form-group row">
                                <label for="report_date" class="col-md-4 col-form-label text-md-right">Report Date</label>

                                <div class="col-md-6">

                                    <input type="text" name="report_date" id="report_date" class="form-control" value="{!! \Carbon\Carbon::now()->format('d-m-Y') !!}" required readonly />

                                </div>
                            </div>


                            <div class="form-group row mb-0 col-3">
                                {{--<div class="col-md-6 offset-md-1">--}}
                                    {{--<button type="submit" class="btn btn-primary btn-sm" name="action" value="preview">Preview</button>--}}
                                {{--</div>--}}
                                <div class="col-md-5 mx-sm-1 text-md-right">
                                    <button type="submit" class="btn btn-secondary btn-sm" name="action" value="print">Print</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>




        {{--@if(!is_null($year))--}}



            {{--@foreach($departments as $dept)--}}
            {{--<div class="card">--}}
                {{--<div class="card-header">--}}
                {{--<h3 style="font-weight: bold">Department Name : {!! isset($data[0]->department_id) ? $data[0]->department->name : '' !!}<br/>--}}
                {{--Report Title: Attendance Summery Report. Date from : {!! \Carbon\Carbon::parse($from_date)->format('d-M-Y') !!} to {!! \Carbon\Carbon::parse($to_date)->format('d-M-Y') !!}</h3>--}}
                {{--</div>--}}
                {{--<div class="card-body">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-12" style="overflow-x:auto;">--}}
                            {{--<table class="table table-bordered table-hover table-striped" id="roster-table">--}}
                                {{--<thead style="background-color: #b0b0b0">--}}
                                {{--<tr>--}}
                                    {{--<th>Name</th>--}}
                                    {{--<th>Day 01</th>--}}
                                    {{--<th>Day 02</th>--}}
                                    {{--<th>Day 03</th>--}}
                                    {{--<th>Day 04</th>--}}
                                    {{--<th>Day 05</th>--}}
                                    {{--<th>Day 06</th>--}}
                                    {{--<th>Day 07</th>--}}
                                    {{--<th>Day 08</th>--}}
                                    {{--<th>Day 09</th>--}}
                                    {{--<th>Day 10</th>--}}
                                    {{--<th>Day 11</th>--}}
                                    {{--<th>Day 12</th>--}}
                                    {{--<th>Day 13</th>--}}
                                    {{--<th>Day 14</th>--}}
                                    {{--<th>Day 15</th>--}}
                                    {{--<th>Day 16</th>--}}
                                    {{--<th>Day 17</th>--}}
                                    {{--<th>Day 18</th>--}}
                                    {{--<th>Day 19</th>--}}
                                    {{--<th>Day 20</th>--}}
                                    {{--<th>Day 21</th>--}}
                                    {{--<th>Day 22</th>--}}
                                    {{--<th>Day 23</th>--}}
                                    {{--<th>Day 24</th>--}}
                                    {{--<th>Day 25</th>--}}
                                    {{--<th>Day 26</th>--}}
                                    {{--<th>Day 27</th>--}}
                                    {{--<th>Day 28</th>--}}
                                    {{--<th>Day 29</th>--}}
                                    {{--<th>Day 30</th>--}}
                                    {{--<th>Day 31</th>--}}
                                    {{--<th>Location</th>--}}
                                    {{--<th>Status</th>--}}
                                {{--</tr>--}}
                                {{--</thead>--}}
                            {{--</table>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--@endforeach--}}
        {{--@endif--}}

    </div> <!--/.Container-->

@endsection

@push('scripts')

    <script>

        $(document).ready(function(){

            $( "#report_date" ).datetimepicker({
                format:'d-m-Y',
                timepicker: false,
                closeOnDateSelect: true,
                scrollInput : false,
                inline:false
            });
        });

    </script>


@endpush