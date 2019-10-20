@extends('layouts.master')

@section('pagetitle')
    <h2 class="no-margin-bottom">Employee Attendance Process</h2>
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
                    {{--<div class="card-header">User Privillege</div>--}}

                    <div class="card-body">
                        <form method="get" action="{{ route('attendance/dateReportIndex') }}" >
                            @csrf

                            <div class="form-group row">
                                <label for="report_date" class="col-md-4 col-form-label text-md-right">Report Date</label>

                                <div class="col-md-6">

                                    <input type="text" name="report_date" id="report_date" class="form-control" value="{!! \Carbon\Carbon::now()->format('d-m-Y') !!}" required readonly />

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="employee_id" class="col-md-4 col-form-label text-md-right">Employee ID</label>
                                <div class="col-md-6">
                                    <input type="text" name="employee_id" id="employee_id" class="form-control" placeholder="Enter ID Or Leave Empty If Need All" autocomplete="off" />
                                </div>
                            </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-1">
                                    <button type="submit" class="btn btn-primary" name="action" value="preview">Preview</button>
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


        @if(!empty($data))
            <table class="table table-info table-striped">

                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Department</th>
                        <td>Total</td>
                        <th>Present</th>
                        <th>Off Day</th>
                        <th>In Leave</th>
                        <th>Public Holiday</th>
                        <th>Absent</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                @foreach($data as $i=>$row)
                    <tr>
                        <td>{!! $i + 1 !!}</td>
                        <td><a href="{!! url('attendance/report/department/'.$row->department_id.'/'.$row->attend_date) !!}">
                                {!! $row->department->name !!}
                            </a></td>
                        <td>{!! $row->emp_count !!}</td>
                        <td>{!! $row->present !!}</td>
                        <td>{!! $row->offday !!}</td>
                        <td>{!! $row->n_leave !!}</td>
                        <td>{!! $row->holiday !!}</td>
                        <td>{!! $row->absent !!}</td>
                        <td><a href="{!! url('attendance/report/department/print/'.$row->department_id.'/'.$row->attend_date) !!}"><i class="fa fa-print"></i></a></td>
                    </tr>

                    {{--@php($t_emp = $t_emp+)--}}
                @endforeach
                </tbody>
                <tfoot>
                    <tr style="background-color: #0e4377">
                        <td colspan="2">Total</td>
                        <td>{!! $data->sum('emp_count') !!}</td>


                        <td>{!! $data->sum('present') !!}</td>
                        <td>{!! $data->sum('offday') !!}</td>
                        {{--<td>{!! $data->sum('n_leave') !!}</td>--}}

                        <td><a href="{!! url('attendance/report/leave/'.$row->attend_date) !!}">
                                {!! $data->sum('n_leave') !!}
                            </a></td>
                        <td>{!! $data->sum('holiday') !!}</td>
                        <td>{!! $data->sum('absent') !!}</td>
                    </tr>
                </tfoot>
            </table>

        @endif

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