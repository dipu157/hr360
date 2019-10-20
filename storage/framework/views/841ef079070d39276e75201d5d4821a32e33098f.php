<?php $__env->startSection('pagetitle'); ?>
    <h2 class="no-margin-bottom">Employee Attendance Process</h2>
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
            <div class="col-md-6">
                <div class="card">
                    

                    <div class="card-body">
                        <form method="post" action="<?php echo e(route('attendance/create')); ?>" >
                            <?php echo csrf_field(); ?>

                            <div class="form-group row">
                                <label for="run_date" class="col-md-4 col-form-label text-md-right">Select Date</label>

                                <div class="col-md-6">

                                    <input type="text" name="run_date" id="run_date" class="form-control" value="<?php echo \Carbon\Carbon::now()->format('d-m-Y'); ?>" required readonly />

                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-footer">
                        <div class="progress">
                            <div class="bar"></div >
                            <div class="percent">0%</div >
                        </div>

                        <div id="status"></div>
                    </div>
                </div>
            </div>


            <?php if(!empty($data)): ?>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">

                                <table class="table table-bordered table-success table-striped">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Submitted By</th>
                                            <th>Submitted Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo $row->process_date_param; ?></td>
                                                <td><?php echo $row->user->name; ?></td>
                                                <td><?php echo $row->created_at; ?></td>
                                            </tr>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>

                                </table>


                        </div>
                    </div>
                </div>
            <?php endif; ?>



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


        $(function() {
            var bar = $('.bar');
            var percent = $('.percent');
            var status = $('#status');

            $('form').ajaxForm({
                beforeSend: function() {
                    status.empty();
                    var percentVal = '0%';
                    bar.width(percentVal);
                    percent.html(percentVal);
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    bar.width(percentVal);
                    percent.html(percentVal);
                },
                complete: function(xhr) {
                    status.html(xhr.responseText);
                }
            });
        });




    </script>






<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>