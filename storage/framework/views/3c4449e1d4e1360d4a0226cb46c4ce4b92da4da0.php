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


        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    

                    <div class="card-body">
                        <form method="post" action="<?php echo e(route('attendance/manualPost')); ?>" >
                            <?php echo csrf_field(); ?>

                            <input type="hidden" name="to_id" id="to_id" class="form-control">

                            <div class="form-group row">
                                <label for="emp_id" class="col-sm-4 col-form-label text-md-right">Name</label>
                                <div class="col-sm-8">
                                    <div class="input-group mb-3">
                                        <input type="text" name="emp_id" id="emp_id" class="form-control typeahead" required autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="att_date" class="col-md-4 col-form-label text-md-right">Select Date</label>

                                <div class="col-md-8">

                                    <input type="text" name="att_date" id="att_date" class="form-control" value="<?php echo \Carbon\Carbon::now()->format('d-m-Y'); ?>" required readonly />

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="entry_time" class="col-sm-4 col-form-label text-md-right">Entry Time</label>
                                <div class="col-sm-8">
                                    <div class="input-group mb-3">
                                        <input type="text" name="entry_time" id="entry_time" class="form-control" readonly autocomplete="off">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="exit_time" class="col-sm-4 col-form-label text-md-right">Exit Time</label>
                                <div class="col-sm-8">
                                    <div class="input-group mb-3">
                                        <input type="text" name="exit_time" id="exit_time" class="form-control" readonly autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="reason" class="col-sm-4 col-form-label text-md-right">Reason</label>
                                <div class="col-sm-8">
                                    <div class="input-group mb-3">
                                        <textarea class="form-control" name="reason" cols="50" rows="4" id="reason"></textarea>
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
        </div>

    </div> <!--/.Container-->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

    <script>


        $(document).on('click', '.form-control.typeahead', function() {

            $(this).typeahead({
                minLength: 1,
                displayText:function (data) {
                    return data.full_name + ' : ' + data.professional.employee_id;
                },

                source: function (query, process) {
                    $.ajax({
                        url: "<?php echo e(url('autocomplete/employeeNameId')); ?>",
                        type: 'GET',
                        dataType: 'JSON',
                        data: 'query=' + query ,
                        success: function(data) {
                            return process(data);
                        }
                    });
                },
                afterSelect: function (data) {
                    $('#to_id').val(data.professional.employee_id);
                    $('#emp_details').html('ID: '+ data.professional.employee_id );
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

            $( "#entry_time" ).datetimepicker({
                format:'H:i',
                datepicker:false,
                closeOnTimeSelect:true,
                inline:false,
                step:15
            });

            $( "#exit_time" ).datetimepicker({
                format:'Y-m-d H:i',
                closeOnTimeSelect:true,
                inline:false,
                step:15,
                // onSelectTime: function () {
                //     document.getElementById('duty_hour').value = document.getElementById('from_time').value - document.getElementById('to_time').value;
                // }
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