<?php $__env->startSection('pagetitle'); ?>
    <h2 class="no-margin-bottom">Manual Attendance</h2>
    <h2 class="no-margin-bottom" id="emp_details" style="color: red"></h2>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <script type="text/javascript" src="<?php echo asset('assets/js/jquery-3.3.1.min.js'); ?>"></script>

    <link href="<?php echo asset('assets/css/jquery.datetimepicker.min.css'); ?>" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo asset('assets/js/jquery.datetimepicker.js'); ?>"></script>

    <script type="text/javascript" src="<?php echo asset('assets/js/bootstrap3-typeahead.js'); ?>"></script>


    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6">
                <div class="pull-left">
                    <a class="btn btn-primary" href="<?php echo URL::previous(); ?>"> <i class="fa fa-list"></i> Back </a>
                </div>
            </div>
        </div>


        <div class="row justify-content-left">
            <div class="col-md-7">
                <div class="card">
                    

                    <div class="card-body">
                        <form method="post" action="<?php echo e(route('attendance/updatePost')); ?>" >
                            <?php echo csrf_field(); ?>

                            <input type="hidden" name="to_id" id="to_id" class="form-control">

                            <div class="form-group row">
                                <label for="att_date" class="col-md-4 col-form-label text-md-right">Select Date</label>

                                <div class="col-md-8">

                                    <input type="text" name="att_date" id="att_date" class="form-control" value="<?php echo \Carbon\Carbon::now()->format('d-m-Y'); ?>" required readonly />

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="emp_id" class="col-sm-4 col-form-label text-md-right">Name</label>
                                <div class="col-sm-8">
                                    <div class="input-group mb-3">
                                        <input type="text" name="emp_id" id="emp_id" class="form-control typeahead" required autocomplete="off">
                                    </div>
                                </div>
                            </div>


                            
                                
                                
                                    

                                        

                                    
                                
                            

                            
                                
                                
                                    

                                        

                                    
                                
                            

                            <div class="form-group row">
                                <label for="emp_id" class="col-sm-4 col-form-label text-md-right">Late Allow</label>
                                <div class="col-sm-8">
                                    <div class="input-group mb-3">

                                        <?php echo Form::select('late_allow',[''=>'Select','1'=>'Yes'],null,['class'=>'form-control','id'=>'late_allow']); ?>


                                    </div>
                                </div>
                            </div>

                            
                                
                                
                                    
                                        
                                    
                                
                            

                            
                                
                                
                                    

                                        

                                    
                                
                            


                            <div class="form-group row">
                                <label for="leave_id" class="col-sm-4 col-form-label text-md-right">Force Leave</label>
                                <div class="col-sm-8">
                                    <div class="input-group mb-3">

                                        <?php echo Form::select('leave_id',$leaves,null,['class'=>'form-control','id'=>'leave_id','placeholder'=>'Select Leave Type']); ?>


                                    </div>
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="reason" class="col-sm-4 col-form-label text-md-right">Reason</label>
                                <div class="col-sm-8">
                                    <div class="input-group mb-3">
                                        <textarea class="form-control" name="reason" cols="50" rows="4" id="reason" required></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="col-md-5">
                <div class="card">
                    

                    <div class="card-body">
                        <table class="table table-bordered table-responsive">
                            <tr>
                                <td>Shift</td>
                                <td>:</td>
                                <td id="shift-data"></td>
                            </tr>
                            <tr>
                                <td>Leave</td>
                                <td>:</td>
                                <td id="current_leave_flag"></td>
                            </tr>

                            <tr>
                                <td>Overtime</td>
                                <td>:</td>
                                <td id="current_overtime_hour"></td>
                            </tr>


                        </table>
                    </div>
                </div>
            </div>


        </div>

    </div> <!--/.Container-->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

    <script>


        $(document).on('click', '.form-control.typeahead', function() {

            var dt = $('#att_date').val();

            $(this).typeahead({
                minLength: 1,
                displayText:function (data) {
                    return data.employee_id + " : " + data.personal.full_name;
                },

                // $('#att_date').val()

                source: function (query, process) {
                    $.ajax({
                        url: 'autocomplete/' + $('#att_date').val(),
                        type: 'GET',
                        dataType: 'JSON',
                        data: 'query=' + query ,
                        success: function(data) {
                            return process(data);
                        }
                    });
                },
                afterSelect: function (data) {
                    $('#shift-data').html(data.attendance[0].shift_entry_time + ' To ' + data.attendance[0].shift_exit_time);
                    $('#current_leave_flag').html(data.attendance[0].leave_flag);
                    $('#current_overtime_hour').html(data.attendance[0].overtime_hour);
                    $('#to_id').val(data.attendance[0].id);
                }

            });
        });


        $(document).ready(function(){

            $( "#att_date" ).datetimepicker({
                format:'d-m-Y',
                timepicker: false,
                closeOnDateSelect: true,
                scrollInput : false,
                inline:false,
                maxDate: new Date()
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