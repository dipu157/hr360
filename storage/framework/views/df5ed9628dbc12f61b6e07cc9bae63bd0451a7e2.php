<?php $__env->startSection('pagetitle'); ?>
    <h2 class="no-margin-bottom">Monthly Salary Process</h2>
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
                        <form method="post" action="<?php echo e(route('payroll/salaryProcess')); ?>" >
                            <?php echo csrf_field(); ?>


                            <div class="alert alert-warning required" role="alert">
                                Please Make Sure All The Attendance Data Are Already Verified
                            </div>

                            <div class="alert alert-info required" role="alert">
                                 Salary To Be Processed For Year : <?php echo $period->calender_year; ?> Month : <?php echo $period->month_name; ?><br/>

                            </div>

                            <?php echo Form::hidden('period_id',$period->id); ?>



                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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

            $( "#run_date" ).datetimepicker({
                format:'d-m-Y',
                timepicker: false,
                closeOnDateSelect: true,
                scrollInput : false,
                inline:false
            });
        });

        $(function (){
            $(document).on("focus", "input:text", function() {
                $(this).select();
            });
        });


    </script>






<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>