<?php $__env->startSection('pagetitle'); ?>
    <h2 class="no-margin-bottom">Employee Attendance Process</h2>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <script type="text/javascript" src="<?php echo asset('assets/js/jquery-3.3.1.min.js'); ?>"></script>

    <link href="<?php echo asset('assets/css/jquery.datetimepicker.min.css'); ?>" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo asset('assets/js/jquery.datetimepicker.js'); ?>"></script>


    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6">
                <div class="pull-left">
                    <a class="btn btn-primary" href="<?php echo URL::previous(); ?>"> <i class="fa fa-list"></i> Back </a>
                </div>
            </div>
        </div>


        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    

                    <div class="card-body">
                        <form method="get" action="<?php echo e(route('attendance/dateReportIndex')); ?>" >
                            <?php echo csrf_field(); ?>

                            <div class="form-group row">
                                <label for="report_date" class="col-md-4 col-form-label text-md-right">Report Date</label>

                                <div class="col-md-6">

                                    <input type="text" name="report_date" id="report_date" class="form-control" value="<?php echo \Carbon\Carbon::now()->format('d-m-Y'); ?>" required readonly />

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


        <?php if(!empty($data)): ?>
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
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo $i + 1; ?></td>
                        <td><a href="<?php echo url('attendance/report/department/'.$row->department_id.'/'.$row->attend_date); ?>">
                                <?php echo $row->department->name; ?>

                            </a></td>
                        <td><?php echo $row->emp_count; ?></td>
                        <td><?php echo $row->present; ?></td>
                        <td><?php echo $row->offday; ?></td>
                        <td><?php echo $row->n_leave; ?></td>
                        <td><?php echo $row->holiday; ?></td>
                        <td><?php echo $row->absent; ?></td>
                        <td><a href="<?php echo url('attendance/report/department/print/'.$row->department_id.'/'.$row->attend_date); ?>"><i class="fa fa-print"></i></a></td>
                    </tr>

                    
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                    <tr style="background-color: #0e4377">
                        <td colspan="2">Total</td>
                        <td><?php echo $data->sum('emp_count'); ?></td>


                        <td><?php echo $data->sum('present'); ?></td>
                        <td><?php echo $data->sum('offday'); ?></td>
                        

                        <td><a href="<?php echo url('attendance/report/leave/'.$row->attend_date); ?>">
                                <?php echo $data->sum('n_leave'); ?>

                            </a></td>
                        <td><?php echo $data->sum('holiday'); ?></td>
                        <td><?php echo $data->sum('absent'); ?></td>
                    </tr>
                </tfoot>
            </table>

        <?php endif; ?>

    </div> <!--/.Container-->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

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


<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>