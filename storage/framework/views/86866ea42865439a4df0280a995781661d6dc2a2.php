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
                   <h3 style="font-weight: bold">Department Name : <?php echo $data[0]->department->name; ?><br/>
                   Report Title: List Of Present Employees of the date : <?php echo $data[0]->attend_date; ?></h3>
                </div>
                <div class="card-body">
                    <table class="table table-info table-striped">

                        <thead>
                        <tr>
                            <th>SL</th>
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
                        <?php ($p=0); ?>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($row->Status == 'Present'): ?>
                                <?php ($p++); ?>
                                <tr>
                                    <td><?php echo $p; ?></td>
                                    <td><?php echo $row->employee_id; ?></td>
                                    <td><?php echo $row->professional->personal->full_name; ?></td>
                                    <td><?php echo $row->shift->name; ?><br/><?php echo \Carbon\Carbon::parse($row->shift->from_time)->format('g:i A'); ?> - <?php echo \Carbon\Carbon::parse($row->shift->to_time)->format('g:i A'); ?></td>
                                    <td><?php echo isset($row->entry_time) ? \Carbon\Carbon::parse($row->entry_time)->format('g:i A') :''; ?></td>
                                    <td><?php echo isset($row->exit_time) ? \Carbon\Carbon::parse($row->exit_time)->format('g:i A') : ''; ?></td>
                                    <td><?php echo $row->overtime_hour; ?></td>
                                    <td><?php echo $row->Status; ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="card">
                <div class="card-header">
                    <h3 style="font-weight: bold">Department Name : <?php echo $data[0]->department->name; ?><br/>
                        Report Title: List Of Employees Enjoying Off Day of the date : <?php echo $data[0]->attend_date; ?></h3>
                </div>
                <div class="card-body">
                    <table class="table table-secondary table-striped">

                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Shift</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php ($off=0); ?>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($row->Status == 'OffDay'): ?>
                                <?php ($off++); ?>
                                <tr>
                                    <td><?php echo $off; ?></td>
                                    <td><?php echo $row->employee_id; ?></td>
                                    <td><?php echo $row->professional->personal->full_name; ?></td>
                                    <td><?php echo $row->shift->name; ?><br/><?php echo \Carbon\Carbon::parse($row->shift->from_time)->format('g:i A'); ?> - <?php echo \Carbon\Carbon::parse($row->shift->to_time)->format('g:i A'); ?></td>
                                    <td><?php echo $row->Status; ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="card">
                <div class="card-header">
                    <h3 style="font-weight: bold">Department Name : <?php echo $data[0]->department->name; ?><br/>
                        Report Title: List Of Employees Enjoying Leave of the date : <?php echo $data[0]->attend_date; ?></h3>
                </div>
                <div class="card-body">
                    <table class="table table-secondary table-striped">

                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Shift</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php ($lv=0); ?>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($row->Status == 'InLeave'): ?>
                                <?php ($lv++); ?>
                                <tr>
                                    <td><?php echo $lv; ?></td>
                                    <td><?php echo $row->employee_id; ?></td>
                                    <td><?php echo $row->professional->personal->full_name; ?></td>
                                    <td><?php echo $row->shift->name; ?><br/><?php echo \Carbon\Carbon::parse($row->shift->from_time)->format('g:i A'); ?> - <?php echo \Carbon\Carbon::parse($row->shift->to_time)->format('g:i A'); ?></td>
                                    <td><?php echo $row->Status; ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="card">
                <div class="card-header">
                    <h3 style="font-weight: bold">Department Name : <?php echo $data[0]->department->name; ?><br/>
                        Report Title: List Of Absent Employees of the date : <?php echo $data[0]->attend_date; ?></h3>
                </div>
                <div class="card-body">
                    <table class="table table-primary table-striped">

                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Shift</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php ($ab=0); ?>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($row->Status == 'Absent'): ?>
                                <?php ($ab++); ?>
                                <tr>
                                    <td><?php echo $ab; ?></td>
                                    <td><?php echo $row->employee_id; ?></td>
                                    <td><?php echo $row->professional->personal->full_name; ?></td>
                                    <td><?php echo $row->shift->name; ?><br/><?php echo \Carbon\Carbon::parse($row->shift->from_time)->format('g:i A'); ?> - <?php echo \Carbon\Carbon::parse($row->shift->to_time)->format('g:i A'); ?></td>
                                    <td><?php echo $row->Status; ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>





        <?php endif; ?>

    </div> <!--/.Container-->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>