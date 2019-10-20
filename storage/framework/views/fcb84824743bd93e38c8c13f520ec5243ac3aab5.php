<?php $__env->startSection('pagetitle'); ?>
    <h2 class="no-margin-bottom">Overtime Information</h2>
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
                        <form method="get" action="<?php echo e(route('overtime/employeeOvertimeIndex')); ?>" >
                            <?php echo csrf_field(); ?>

                            <div class="form-group row">
                                <label for="from_date" class="col-md-4 col-form-label text-md-right">From Date</label>
                                <div class="col-md-6">
                                    <input type="text" name="from_date" id="from_date" class="form-control" value="<?php echo \Carbon\Carbon::now()->format('d-m-Y'); ?>" required readonly />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="to_date" class="col-md-4 col-form-label text-md-right">To Date</label>
                                <div class="col-md-6">
                                    <input type="text" name="to_date" id="to_date" class="form-control" value="<?php echo \Carbon\Carbon::now()->format('d-m-Y'); ?>" required readonly />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="employee_id" class="col-md-4 col-form-label text-md-right">Employee ID</label>
                                <div class="col-md-6">
                                    <input type="text" name="employee_id" id="employee_id" class="form-control" placeholder="Enter ID" autocomplete="off" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="department_id" class="col-md-4 col-form-label text-md-right">Department</label>
                                <div class="col-md-6">
                                    <?php echo Form::select('department_id',$departments,null,['id'=>'department_id', 'class'=>'form-control']); ?>

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
            <?php ($grandtotal = 0); ?>
            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php if($data->contains('employee_id',$emp->employee_id)): ?>
                    <div class="card">

                        <div class="card-header">
                            <h3 style="font-weight: bold">Department Name : <?php echo $emp->professional->personal->full_name; ?><br/>
                                Report Title: Overtime Report For Date From: <?php echo \Carbon\Carbon::parse($from_date)->format('d-M-Y'); ?> To <?php echo \Carbon\Carbon::parse($to_date)->format('d-M-Y'); ?></h3>
                        </div>
                        <div class="card-body">

                            <table class="table table-info table-striped table-bordered">

                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Date</th>
                                    <th>Hour</th>
                                    <th>Reason</th>
                                    <th>Entered By</th>
                                    <th>Approved By</th>
                                    <th>Finalise By</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php ($count = 1); ?>
                                <?php ($subtotal = 0); ?>

                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($emp->employee_id == $row->employee_id): ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $row->ot_date; ?></td>
                                            <td><?php echo $row->ot_hour; ?></td>
                                            <td><?php echo $row->reason; ?></td>
                                            <td><?php echo $row->user->name; ?></td>
                                            <td><?php echo $row->approver->name ?? ''; ?></td>
                                            <td><?php echo $row->finalize_by ?? ''; ?></td>
                                        </tr>
                                        <?php ($count++); ?>
                                        <?php ($subtotal = $subtotal + $row->ot_hour); ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">Employee Total</td>
                                        <td colspan="2"><?php echo $subtotal; ?> Hours</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>

                <?php ($grandtotal = $grandtotal + $subtotal); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div>Department Grand Total : <?php echo $grandtotal; ?> Hours</div>
        <?php endif; ?>



    </div> <!--/.Container-->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

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


<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>