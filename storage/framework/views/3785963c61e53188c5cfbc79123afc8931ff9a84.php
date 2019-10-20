<?php $__env->startSection('pagetitle'); ?>
    <h2 class="no-margin-bottom">Employee List</h2>
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
                    <div class="card-header">Department Wise Active Employee List</div>

                    <div class="card-body">
                        <form method="get" action="<?php echo e(route('employee/report/empListIndex')); ?>" >

                            <div class="form-group row">
                                <label for="department_id" class="col-md-4 col-form-label text-md-right">Department</label>
                                <div class="col-md-6">
                                    <?php echo Form::select('department_id',$departments,null,['id'=>'department_id', 'class'=>'form-control']); ?>

                                </div>
                            </div>

                            <?php echo Form::hidden('search_id',1); ?>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-1">
                                    <button type="submit" class="btn btn-primary" name="action" value="export">Export</button>
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





        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Working Status Wise Employee</div>

                    <div class="card-body">
                        <form method="get" action="<?php echo e(route('employee/report/empListWStatusIndex')); ?>" >

                            <div class="form-group row">
                                <label for="status_id" class="col-md-4 col-form-label text-md-right">Working Status</label>
                                <div class="col-md-6">
                                    <?php echo Form::select('status_id',$wStatus,null,['id'=>'status_id', 'class'=>'form-control']); ?>

                                </div>
                            </div>

                            

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-1">
                                    <button type="submit" class="btn btn-primary" name="action" value="export">Export</button>
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