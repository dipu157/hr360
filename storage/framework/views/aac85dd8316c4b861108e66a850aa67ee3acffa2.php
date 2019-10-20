<?php $__env->startSection('pagetitle'); ?>
    <h2 class="no-margin-bottom">Update Salary</h2>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <script type="text/javascript" src="<?php echo asset('assets/js/jquery-3.3.1.min.js'); ?>"></script>
    <link href="<?php echo asset('assets/css/bootstrap-imageupload.css'); ?>" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo asset('assets/js/bootstrap-imageupload.js'); ?>"></script>

    <link href="<?php echo asset('assets/css/jquery.datetimepicker.min.css'); ?>" rel="stylesheet" type="text/css" />

    <link href="<?php echo asset('assets/tabs/css/style.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo asset('assets/css/pretty-checkbox.css'); ?>" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="<?php echo asset('assets/js/jquery.datetimepicker.js'); ?>"></script>


    <?php echo $__env->make('partials.flash-message', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6">
                <div class="pull-left">
                    <a class="btn btn-primary" href="<?php echo URL::previous(); ?>"> <i class="fa fa-list"></i> Back </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12" style="overflow-x:auto;">
                <table class="table table-bordered table-hover table-striped" id="employees-table">
                    <thead style="background-color: #b0b0b0">
                    <tr>
                        <th></th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Designation <br/><span style="color: #0c5460">Department</span></th>
                        <th>Basic</th>
                        <th>Days Paid</th>
                        <th>Net Salary</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div> <!--/.Container-->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

    <script>

        $(function() {
            var table= $('#employees-table').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                ajax: 'MonthlySalaryDataTable',
                columns: [
                    { data: 'id', name: 'id', visible: false },
                    { data: 'showimage', name: 'showimage'},
                    { data: 'name', name: 'name'},
                    { data: 'designation', name: 'designation'},
                    { data: 'basic', name: 'basic', default: 0 },
                    { data: 'paid_days', name: 'paid_days', default: 0 },
                    { data: 'net_salary', name: 'net_salary', default: 0 },

                    { data: 'action', name: 'action', orderable: false, searchable: false, printable: false}

                ],
                order: [ [0, 'desc'] ]
            });

            $(this).on("click", ".btn-edit", function (e) {
                e.preventDefault();

                var url = $(this).data('remote');
                window.location.href = url;

            });
        });

    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>