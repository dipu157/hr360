@extends('layouts.master')

@section('pagetitle')
    <h2 class="no-margin-bottom">Payroll Attendance Report</h2>
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


        <div class="row justify-content-center" id="div-select">
            <div class="col-md-8">
                <div class="card">
                    {{--<div class="card-header">User Privillege</div>--}}

                    <div class="card-body">
                        <form method="get" action="{{ route('attendance/payrollAttReportIndex') }}" >
                            @csrf

                            <div class="form-group row">
                                <label for="from_date" class="col-md-4 col-form-label text-md-right">From Date</label>
                                <div class="col-md-6">
                                    <input type="text" name="from_date" id="from_date" class="form-control" value="{!! \Carbon\Carbon::now()->format('d-m-Y') !!}" required readonly />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="to_date" class="col-md-4 col-form-label text-md-right">To Date</label>
                                <div class="col-md-6">
                                    <input type="text" name="to_date" id="to_date" class="form-control" value="{!! \Carbon\Carbon::now()->format('d-m-Y') !!}" required readonly />
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

            {!! Form::open(['method'=>'get']) !!}
            <div class="row">
                <div class="col-sm-7 form-group">
                    <div class="input-group">
                        <input class="form-control" id="search"
                               value="{{ request('search') }}"
                               placeholder="Search name" name="search"
                               type="text" id="search"/>

                        <button type="submit" class="btn btn-primary mb-2">Search</button>

                        <input type="hidden" value="{!! $from_date !!}" name="from_date"/>
                        <input type="hidden" value="{!! $to_date !!}" name="to_date"/>
                        {{--<div class="input-group-btn">--}}
                            {{--<button type="submit" class="btn btn-warning">--}}
                                {{--Search--}}
                            {{--</button>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
            {!! Form::close() !!}

            <!-- {{--@foreach($departments as $dept)--}} -->
            <div class="card">
                <div class="card-header">
                    <h3 style="font-weight: bold"><!-- Department Name : {!! isset($data[0]->department_id) ? $data[0]->department->name : '' !!}<br/> -->
                        Report Title: Attendance Summery Report. Date from : {!! \Carbon\Carbon::parse($from_date)->format('d-M-Y') !!} to {!! \Carbon\Carbon::parse($to_date)->format('d-M-Y') !!}</h3>
                </div>
                <div class="card-body">

                    <table class="table table-info table-striped table-bordered">

                        <thead>
                        <tr style="width: 600px">
                            <th>Sl.No</th>
                            <th>PF.NO</th>
                            <th>Emp ID</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Date of Joining</th>
                            <th>CL</th>
                            <th>EL</th>
                            <th>SL</th>
                            <th>AL</th>
                            <td>Weekly Holy Day</td>
                            <th>Public Holy Day</th>
                            <th>L.W.P</th>
                            <th>W.P for Late Att</th>
                            <th>Total W.P</th>
                            <th>Total Working Days</th>
                            <th>Total Days to be Paid</th>
                            <th>Remarks</th>

                        </tr>
                        </thead>
                        <tbody>


                        @foreach($data as $i=>$row)

                            <tr>
                                <td>{!! $i + 1 !!}</td>
                                <td>{!! $row->professional->pf_no !!}</td>
                                <td>{!! $row->professional->employee_id !!}</td>
                                <td>{!! $row->professional->personal->full_name !!}</td>
                                <td>{!! $row->professional->designation->short_name !!}</td>
                                <td>{!! $row->professional->joining_date !!}</td>
                                <td>{!! $cl=($row->cl) !!}</td>
                                <td>{!! $el=($row->el) !!}</td>
                                <td>{!! $sl=($row->sl) !!}</td>
                                <td>{!! $al=($row->al) !!}</td>
                                <td>{!! $off=($row->offday) !!}</td>
                                <td>{!! $holiday=($row->holiday) !!}</td>
                                <td>{!! $row->lwp !!}</td></td>
                                <td>{!! $lc=($row->late_count) !!}</td>
                                <td>{!! $twp=($row->lwp)+$lc !!}</td>
                                <td>{!! $present=($row->present) !!}</td>
                                <td>{!! ($present+$cl+$el+$sl+$al+$off+$holiday)-$twp !!}</td>
                                <td></td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
            <!-- {{--@endforeach--}} -->
        @endif

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