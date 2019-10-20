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
                    <h3 style="font-weight: bold"> <?php echo $data[0]->employee_id; ?> :  <?php echo $data[0]->professional->personal->full_name; ?><br/>
                        Department Name : <?php echo $data[0]->department->name; ?><br/>
                        Report Title: Employee Attendance History : </h3>
                </div>
                <div class="card-body">
                    <table class="table table-info table-striped">

                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Shift</th>
                            <td>Entry Time</td>
                            <th>Exit Time</th>
                            <th>Over Time</th>
                            <th>Late</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr <?php echo $row->attend_status == 'A' ? 'style="background-color: rgba(123,0,0,0.25)"' : ($row->holiday_flag == 1 ? 'style="background-color: rgba(255,204,255,0.2)"' : ($row->leave_flag == 1 ? 'style="background-color: rgba(153,153,102,0.2)"' : null)); ?> >
                                <td><?php echo $row->attend_date; ?></td>
                                <td><?php echo $row->shift->name; ?><br/><?php echo \Carbon\Carbon::parse($row->shift->from_time)->format('g:i A'); ?> - <?php echo \Carbon\Carbon::parse($row->shift->to_time)->format('g:i A'); ?></td>
                                <td><?php echo is_null($row->entry_time) ? '' : \Carbon\Carbon::parse($row->entry_time)->format('g:i A'); ?></td>
                                <td><?php echo is_null($row->exit_time) ? '' : \Carbon\Carbon::parse($row->exit_time)->format('g:i A'); ?></td>
                                <td><?php echo $row->overtime_hour; ?></td>
                                <td><?php echo $row->late_minute; ?></td>
                                <td><?php echo $row->attend_status == 'P' ? 'Present' : ($row->offday_flag == 1 ? 'Off Day' : ($row->holiday_flag == 1 ? 'Public Holiday' : ($row->leave_flag == 1 ? 'In leave' : 'Absent'))); ?></td>
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