@extends('layouts.master')

@section('pagetitle')
    <h2 class="no-margin-bottom">Employee List</h2>
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
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Department Wise Active Employee List</div>

                    <div class="card-body">
                        <form method="get" action="{{ route('employee/report/empListIndex') }}" >

                            <div class="form-group row">
                                <label for="department_id" class="col-md-4 col-form-label text-md-right">Department</label>
                                <div class="col-md-6">
                                    {!! Form::select('department_id',$departments,null,['id'=>'department_id', 'class'=>'form-control']) !!}
                                </div>
                            </div>

                            {!! Form::hidden('search_id',1) !!}

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-1">
                                    <button type="submit" class="btn btn-primary" name="action" value="export">Export</button>
                                </div>
                                <div class="col-md-5 text-md-right">
                                    <button type="submit" class="btn btn-secondary" name="action" value="print">Print</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>





        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Working Status Wise Employee</div>

                    <div class="card-body">
                        <form method="get" action="{{ route('employee/report/empListWStatusIndex') }}" >

                            <div class="form-group row">
                                <label for="status_id" class="col-md-4 col-form-label text-md-right">Working Status</label>
                                <div class="col-md-6">
                                    {!! Form::select('status_id',$wStatus,null,['id'=>'status_id', 'class'=>'form-control']) !!}
                                </div>
                            </div>

                            {{--{!! Form::hidden('search_id',1) !!}--}}

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-1">
                                    <button type="submit" class="btn btn-primary" name="action" value="export">Export</button>
                                </div>
                                <div class="col-md-5 text-md-right">
                                    <button type="submit" class="btn btn-secondary" name="action" value="print">Print</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>



        {{--@if(!empty($data))--}}




            {{--@foreach($dates as $i=>$date)--}}

                {{--@if($data->contains('ot_date',$date))--}}
                    {{--<div class="card">--}}

                        {{--<div class="card-header">--}}
                            {{--<h3 style="font-weight: bold">Department Name : {!! $dept_data->name !!}<br/>--}}
                                {{--Report Title: Overtime Setup Report For Date : {!! \Carbon\Carbon::parse($date)->format('d-M-Y') !!}</h3>--}}
                        {{--</div>--}}
                        {{--<div class="card-body">--}}

                            {{--<table class="table table-info table-striped table-bordered">--}}

                                {{--<thead>--}}
                                {{--<tr>--}}
                                    {{--<th>ID</th>--}}
                                    {{--<th>Name</th>--}}
                                    {{--<th>Hour</th>--}}
                                    {{--<th>Reason</th>--}}
                                    {{--<th>Entered By</th>--}}
                                    {{--<th>Approved By</th>--}}

                                {{--</tr>--}}
                                {{--</thead>--}}
                                {{--<tbody>--}}
                                {{--@foreach($data as $row)--}}
                                    {{--@if($date == $row->ot_date)--}}
                                        {{--<tr>--}}
                                            {{--<td>{!! $row->employee_id !!}</td>--}}
                                            {{--<td>{!! $row->professional->personal->full_name !!}</td>--}}
                                            {{--<td>{!! $row->ot_hour !!}</td>--}}
                                            {{--<td>{!! $row->reason !!}</td>--}}
                                            {{--<td>{!! $row->user->name !!}</td>--}}
                                            {{--<td>{!! $row->approver->name ?? '' !!}</td>--}}
                                        {{--</tr>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                                {{--</tbody>--}}
                            {{--</table>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endif--}}
            {{--@endforeach--}}
        {{--@endif--}}

    </div> <!--/.Container-->

@endsection

@push('scripts')

    <script>

        $(document).ready(function(){

            $( "#from_date" ).datetimepicker({
                format:'d-m-Y',
                timepicker: false,
                closeOnDateSelect: true,
                scrollInput : false,
                inline:false
            });

            $( "#to_date" ).datetimepicker({
                format:'d-m-Y',
                timepicker: false,
                closeOnDateSelect: true,
                scrollInput : false,
                inline:false
            });
        });

    </script>


@endpush