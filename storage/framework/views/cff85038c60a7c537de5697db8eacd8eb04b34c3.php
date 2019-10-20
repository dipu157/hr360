<?php $__env->startSection('pagetitle'); ?>
    <h2 class="no-margin-bottom">Monthly Salary Report</h2>
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
                        <form method="get" action="<?php echo e(route('payroll/bankLetterIndex')); ?>" >
                            <?php echo csrf_field(); ?>

                            <div class="form-group row">
                                <label for="year_id" class="col-md-4 col-form-label text-md-right">Year</label>
                                <div class="col-md-6">
                                    <?php echo Form::selectYear('year_id',2019,2025, 2019,['id'=>'year_id', 'class'=>'form-control']); ?>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="month_id" class="col-md-4 col-form-label text-md-right">Month</label>
                                <div class="col-md-6">
                                    <?php echo Form::selectMonth('month_id',5,['id'=>'month_id', 'class'=>'form-control']); ?>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="bank_id" class="col-md-4 col-form-label text-md-right">Bank</label>
                                <div class="col-md-6">

                                    <?php echo Form::select('bank_id',$banks,null,['id'=>'bank_id', 'class'=>'form-control']); ?>

                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary" name="action" value="preview">Preview</button>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <button type="submit" class="btn btn-secondary" name="action" value="print">Print</button>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>





    </div> <!--/.Container-->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>


<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>