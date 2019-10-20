<?php $__env->startSection('pagetitle'); ?>
    <h2 class="no-margin-bottom">Employee Leave Application Status</h2>
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
        <?php ($off = 0 ); ?>
        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="card">
                <div class="card-header">
                    <h3 style="font-weight: bold">Department Name : <?php echo $dept->professional->department->name; ?></h3>
                </div>
                <div class="card-body">
                    <table class="table table-secondary table-striped">

                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($row->professional->department_id == $dept->professional->department_id): ?>
                                <?php ($off++); ?>
                                <tr>
                                    <td><?php echo $off; ?></td>
                                    <td><?php echo $row->professional->employee_id; ?></td>
                                    <td><?php echo $row->professional->personal->full_name; ?></td>
                                    <td><?php echo \Carbon\Carbon::parse($row->from_date)->format('d-m-Y'); ?> To <?php echo \Carbon\Carbon::parse($row->from_date)->format('d-m-Y'); ?></td>
                                    <td><?php echo $row->status == 'C' ? 'Applied' : ($row->status == 'K' ? 'Acknowledged' : 'Recommended'); ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

    </div> <!--/.Container-->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>