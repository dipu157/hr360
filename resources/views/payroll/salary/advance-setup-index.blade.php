@extends('layouts.master')

@section('pagetitle')
    <h2 class="no-margin-bottom">Advance Setup</h2>
@endsection
@section('content')
    <script type="text/javascript" src="{!! asset('assets/js/jquery-3.3.1.min.js') !!}"></script>
    <link href="{!! asset('assets/css/bootstrap-imageupload.css') !!}" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{!! asset('assets/js/bootstrap-imageupload.js') !!}"></script>

    <link href="{!! asset('assets/css/jquery.datetimepicker.min.css') !!}" rel="stylesheet" type="text/css" />

    <link href="{!! asset('assets/tabs/css/style.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('assets/css/pretty-checkbox.css') !!}" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="{!! asset('assets/js/jquery.datetimepicker.js') !!}"></script>


    @include('partials.flash-message')

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

                        <form class="form-inline" id="search-form" method="get" action="{{ route('payroll/advanceSetupIndex') }}">

                            <div class="form-group mx-sm-3 mb-1">
                                {!! Form::select('department_id',$departments, null,['id'=>'department_id', 'class'=>'form-control']) !!}
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-1">
                                    <button type="submit" class="btn btn-primary" name="action" value="preview">Submit</button>
                                </div>

                            </div>

                            {{--<button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search">Submit</i></button>--}}
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {!! Form::hidden('dept_id', $department_id, array('id' => 'dept_id')) !!}

        @if(!is_null($department_id))

        <div class="row">
            <div class="col-md-12" style="overflow-x:auto;">
                <table class="table table-bordered table-hover table-striped" id="employees-table">
                    <thead style="background-color: #b0b0b0">
                    <tr>
                        <th></th>
                        <th>Photo</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Designation <br/><span style="color: #0c5460">Department</span></th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

        @endif

    </div> <!--/.Container-->

     @include('payroll.salary.modals.add.advance-setup')

@endsection

@push('scripts')

    <script>

        $(function() {
            var table= $('#employees-table').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                ajax: 'employeeDataforAdvance/' + $('#dept_id').val(),
                columns: [
                    { data: 'id', name: 'id', visible: false },
                    { data: 'showimage', name: 'showimage'},
                    { data: 'employee_id', name: 'employee_id'},
                    { data: 'personal.full_name', name: 'personal.full_name'},
                    { data: 'designation', name: 'designation'},
                    { data: 'action', name: 'action', orderable: false, searchable: false, printable: false}
                    
                ],
                order: [ [0, 'desc'] ]
            });

            $(this).on("click", ".btn-view", function (e) {
                e.preventDefault();

                var url = $(this).data('remote');
                window.location.href = url;

            });

            $(this).on("click", ".btn-advance-setup", function (e) {
                e.preventDefault();

                document.getElementById('employee_id').value=$(this).data('employee_id');

            });

        });

        $(function (){
            $(document).on("focus", "input:text", function() {
                $(this).select();
            });
        });

    </script>
@endpush