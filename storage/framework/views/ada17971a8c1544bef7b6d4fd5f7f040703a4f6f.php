<?php $__env->startSection('pagetitle'); ?>
    <h2 class="no-margin-bottom">Employee Attendance</h2>
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



        <?php if(!empty($data)): ?>

            <div class="card">
                <div class="card-header">
                    <h3 style="font-weight: bold">Department Name : <?php echo $data->department->name; ?><br/>
                        Report Title: List Of Present Employees of the date : <?php echo $data->attend_date; ?></h3>
                </div>
                <div class="card-body">
                    <table class="table table-info table-striped">

                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Shift</th>
                            <td>Entry Time</td>
                            <th>Exit Time</th>
                            <th>Over Time</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $data->employee_id; ?></td>
                                <td><?php echo $data->professional->personal->full_name; ?></td>
                                <td><?php echo $data->shift->name; ?><br/><?php echo \Carbon\Carbon::parse($data->shift->from_time)->format('g:i A'); ?> - <?php echo \Carbon\Carbon::parse($data->shift->to_time)->format('g:i A'); ?></td>
                                <td><?php echo isset($data->entry_time) ? \Carbon\Carbon::parse($data->entry_time)->format('g:i A') : ''; ?></td>
                                <td><?php echo isset($data->exit_time) ? \Carbon\Carbon::parse($data->exit_time)->format('g:i A') : ''; ?></td>
                                <td><?php echo $data->overtime_hour; ?></td>
                                <td><?php echo $data->Status; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php endif; ?>


        <?php if(!empty($punchs)): ?>

            <div class="card">
                <div class="card-header">
                    <h3 style="font-weight: bold">Punch Details</h3>
                </div>
                <div class="card-body">
                    <table class="table table-info table-striped">

                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Punch Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $punchs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo $i+1; ?></td>
                                <td><?php echo \Carbon\Carbon::parse($row->attendance_datetime)->format('d-M-Y g:i:s A'); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php endif; ?>

    </div> <!--/.Container-->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>