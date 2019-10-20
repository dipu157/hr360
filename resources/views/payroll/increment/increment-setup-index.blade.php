@extends('layouts.master')

@section('pagetitle')
    <h2 class="no-margin-bottom">Increment Setup</h2>
    <h2 class="no-margin-bottom" id="emp_details" style="color: red"></h2>
@endsection
@section('content')
    <script type="text/javascript" src="{!! asset('assets/js/jquery-3.3.1.min.js') !!}"></script>

    <link href="{!! asset('assets/css/jquery.datetimepicker.min.css') !!}" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{!! asset('assets/js/jquery.datetimepicker.js') !!}"></script>

    <script type="text/javascript" src="{!! asset('assets/js/bootstrap3-typeahead.js') !!}"></script>


    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6">
                <div class="pull-left">
                    <a class="btn btn-primary" href="{!! URL::previous() !!}"> <i class="fa fa-list"></i> Back </a>
                </div>
            </div>
        </div>


        <div class="row justify-content-left">
            <div class="col-md-5">
                <div class="card">
                    {{--<div class="card-header">User Privillege</div>--}}

                    <div class="card-body">
                        <form method="post" action="{{ route('payroll/incrementSetup') }}" >
                            @csrf

                            <input type="hidden" name="to_emp_id" id="to_emp_id" class="form-control">


                            <div class="form-group row">
                                <label for="emp_id" class="col-sm-4 col-form-label text-md-right">ID</label>
                                <div class="col-sm-8">
                                    <div class="input-group mb-3">
                                        <input type="text" name="emp_id" id="emp_id" class="form-control typeahead" required autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="effective_from" class="col-md-4 col-form-label text-md-right">Effective From</label>
                                <div class="col-md-8">
                                    <input type="text" name="effective_from" id="effective_from" class="form-control" value="{!! \Carbon\Carbon::now()->format('d-m-Y') !!}" required readonly />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ot_type" class="col-md-4 col-form-label text-md-right">Salary Year</label>

                                <div class="col-md-8">

                                    {!! Form::selectYear('salary_year',2019,2015,2019,['id'=>'salary_year', 'class'=>'form-control']) !!}

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ot_type" class="col-md-4 col-form-label text-md-right">Salary Year</label>

                                <div class="col-md-8">

                                    {!! Form::selectMonth('salary_month',5,['id'=>'salary_month', 'class'=>'form-control']) !!}

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="previous_basic" class="col-sm-4 col-form-label text-md-right">Previous Basic</label>
                                <div class="col-sm-8">
                                    <div class="input-group mb-3">
                                        <input type="text" name="previous_basic" id="previous_basic" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="increased_basic" class="col-sm-4 col-form-label text-md-right">Increased Basic</label>
                                <div class="col-sm-8">
                                    <div class="input-group mb-3">
                                        <input type="text" name="increased_basic" id="increased_basic" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="increment_amount" class="col-sm-4 col-form-label text-md-right">Increment Amount</label>
                                <div class="col-sm-8">
                                    <div class="input-group mb-3">
                                        <input type="text" name="increment_amount" id="increment_amount" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="due_months" class="col-sm-4 col-form-label text-md-right">Due Months</label>
                                <div class="col-sm-8">
                                    <div class="input-group mb-3">
                                        <input type="text" name="due_months" id="due_months" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="reason" class="col-sm-4 col-form-label text-md-right">Description</label>
                                <div class="col-sm-8">
                                    <div class="input-group mb-3">
                                        <textarea class="form-control" name="description" cols="50" rows="4" id="description"></textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">Last Inserted Arears</div>

                    <form class="form-inline" method="get" action="{{ route('payroll/incrementSetupIndex') }}">
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="search_name" class="sr-only">Search by ID/Name</label>
                            <input type="text" class="form-control typeahead_b" name="search_name" id="search" placeholder="search by name or id" autocomplete="off">
                        </div>

                        {!! Form::hidden('search_id', null, array('id' => 'search_id')) !!}

                        <button type="submit" class="btn btn-primary btn-sm mb-2"><i class="fa fa-search">Search</i></button>
                    </form>

                    <div class="card-body">
                        <table class="table table-bordered table-responsive table-striped">
                            <thead>
                            <tr>
                                <th width="220px" style="font-weight: bold">Name</th>
                                <th width="80px" style="font-weight: bold">Period</th>
                                <th style="font-weight: bold">Amount</th>
                                <th style="font-weight: bold">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $i=>$row)
                                <tr>
                                    <td>{!! $row->professional->personal->full_name !!} <br/>{!! $row->professional->employee_id !!}</td>
                                    <td>{!! $row->period->month_name !!} , {!! $row->period->year !!}</td>
                                    <td>{!! $row->increment_amount !!}</td>
                                    <td><button type="submit" id="arear-data-{!! $i !!}" value="{!! $row->id !!}" class="btn btn-arear-delete btn-danger btn-sm"><i class="fa fa-trash"></i></button></td>
                                    {{--<td><button class="btn btn-secondary btn-ot-delete btn-sm" value="{!! $row->id !!}" type="submit" name="action"> <i class="fa fa-trash"></i>  </button></td>--}}
                                </tr>

                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>


        </div>

    </div> <!--/.Container-->

@endsection

@push('scripts')

    <script>


        $(document).on('click', '.form-control.typeahead', function() {

            var autocomplete_path = "{{ url('autocomplete/employeeNameId') }}";

            $(this).typeahead({
                minLength: 1,
                displayText:function (data) {
                    return data.professional.employee_id + " : " + data.full_name;
                },

                source: function (query, process) {
                    $.ajax({
                        url: autocomplete_path,
                        type: 'GET',
                        dataType: 'JSON',
                        data: 'query=' + query ,
                        success: function(data) {
                            return process(data);
                        }
                    });
                },
                afterSelect: function (data) {

                    $('#to_emp_id').val(data.professional.employee_id);
                    $('#emp_details').html(data.professional.employee_id);

                }

            });
        });



        $(document).on('click', '.form-control.typeahead_b', function() {

            var autocomplete_path = "{{ url('autocomplete/employeeNameId') }}";

            $(this).typeahead({
                minLength: 1,
                displayText:function (data) {
                    return data.professional.employee_id + " : " + data.full_name;
                },

                source: function (query, process) {
                    $.ajax({
                        url: autocomplete_path,
                        type: 'GET',
                        dataType: 'JSON',
                        data: 'query=' + query ,
                        success: function(data) {
                            return process(data);
                        }
                    });
                },
                afterSelect: function (data) {

                    $('#search_id').val(data.professional.employee_id);

                }

            });
        });





        $(document).on('click', '.btn-arear-delete', function () {
            // e.preventDefault();

            input_id = $(this).attr('id').split('-');
            item_id = parseInt(input_id[input_id.length - 1]);
            var $tr = $(this).closest('tr');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var url = 'deleteIncrement';

            // confirm then
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',

                data: {
                    method: '_POST', submit: true, row_id: $('#arear-data-' + item_id).val(),
                },

                error: function (request) {

                    alert(request.responseText);
                },

                success: function (data) {

                    alert(data.success);
                    $tr.find('td').fadeOut(1000,function(){
                        $tr.remove();
                    });
                },

            });

        });


        $(function (){

            $( "#from_date" ).datetimepicker({
                format:'d-m-Y',
                timepicker: false,
                closeOnDateSelect: true,
                scrollInput : false,
                inline:false,
            });

            $(document).on("focus", "input:text", function() {
                $(this).select();
            });
        });

    </script>

@endpush