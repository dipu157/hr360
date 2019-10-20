<?php $__env->startSection('pagetitle'); ?>
    <h2 class="no-margin-bottom">Overtime Finalization : <?php echo $department->name ?? ''; ?></h2>
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
            <div class="col-md-12">
                <div class="card">
                    

                    <div class="card-body">

                        <form class="form-inline" id="search-form" method="get" action="<?php echo e(route('overtime/calculationIndex')); ?>">

                            <div class="form-group mx-sm-3 mb-1">
                                <?php echo Form::select('department_id',$departments, null,['id'=>'department_id', 'class'=>'form-control']); ?>

                            </div>



                            <div class="form-group mx-sm-3 mb-1">
                                <?php echo Form::label('from', 'From', array('class' => 'control-label')); ?>

                                <?php echo Form::text('from_date', \Carbon\Carbon::now()->format('d-m-Y'),array('id'=>'from_date','class'=>'form-control','autocomplete'=>'off')); ?>

                            </div>

                            <div class="form-group mx-sm-3 mb-1">
                                <?php echo Form::label('status', 'To', array('class' => 'control-label')); ?>

                            </div>

                            <div class="form-group mx-sm-3 mb-1">
                                <?php echo Form::text('to_date', \Carbon\Carbon::now()->format('d-m-Y'),array('id'=>'to_date','class'=>'form-control','autocomplete'=>'off')); ?>

                            </div>

                            
                                
                            

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-1">
                                    <button type="submit" class="btn btn-primary" name="action" value="preview">Submit</button>
                                </div>

                            </div>

                            
                        </form>




                    </div>
                </div>
            </div>
        </div>

        
        
        


        <?php if(!is_null($dateRange)): ?>



            <?php $__currentLoopData = $dateRange; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php if($newdata->contains('ot_date',$row)): ?>


                <div class="card">
                <div class="card-header">
                    <h3>Overtime Date <?php echo $row; ?> : <?php echo $department->name ?? ''; ?></h3>
                
                
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12" style="overflow-x:auto;">
                            <table class="table table-bordered table-hover table-striped" id="roster-table">
                                <thead style="background-color: #b0b0b0">
                                <tr>
                                    <th width="15px">SL</th>
                                    <th width="180px">Name</th>
                                    <th width="180px">Shift</th>
                                    <th width="180px">Punch</th>
                                    <th width="60px">Approved Hour</th>
                                    <th width="60px">From Punch</th>
                                    <th width="60px">Final</th>
                                    <th width="80px">Action</th>

                                </tr>
                                </thead>
                                <?php ($count = 1); ?>
                                <tbody>
                                    <?php $__currentLoopData = $newdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <?php if($row == $emp->ot_date): ?>
                                            <tr id="tr-id-<?php echo $i; ?>" style="background-color: <?php echo $emp->ot_hour <> $emp->calculated_hour ? '#FFDAB9' : ''; ?>">
                                                <?php echo Form::hidden('id', $emp->id, array('id' => 'row_id-'.$i)); ?>

                                                <?php echo Form::hidden('punch_date', $emp->ot_date, array('id' => 'punch_date-'.$i)); ?>

                                                <td><?php echo $count ++; ?></td>
                                                <td><?php echo $emp->employee_id; ?> <br/> <?php echo $emp->professional->personal->full_name; ?><br/> <span style="color: rebeccapurple"><?php echo $emp->professional->designation->name; ?></span></td>
                                                <td width="180px">ROSTER: <?php echo $emp->shift_entry; ?>--<?php echo $emp->shift_exit; ?> <br/>
                                                 <span style="color: #0062cc">OT SCH <?php echo \Carbon\Carbon::parse($emp->entry_time)->format('g:i A'); ?> -- <?php echo \Carbon\Carbon::parse($emp->exit_time)->format('g:i A'); ?></span>
                                                    <br/><span style="color: #7d0000">Reason : <?php echo $emp->reason; ?></span>
                                                    </td>
                                                <td width="180px"> <span style="color: #033565;">IN: <?php echo $emp->entry; ?></span> <br/> OUT: <?php echo $emp->exit; ?> <br>
                                                    <button type="submit" id="emp-punch-<?php echo $i; ?>" value="<?php echo $emp->employee_id; ?>" class="btn btn-emp-punch btn-secondary btn-sm">Punch</button>
                                                </td>
                                                <td><?php echo $emp->ot_hour; ?> Hour <br/> <span style="color: #7d0000"><?php echo $emp->approver->name ?? ''; ?></span> </td>
                                                <td><?php echo $emp->calculated_hour; ?></td>
                                                <td><?php echo Form::text('final_hour',$emp->ot_hour,['id'=>'final_hour-'.$i,'class'=>'form-control']); ?></td>
                                                <td><button type="submit" id="emp-data-<?php echo $i; ?>" value="<?php echo $emp->employee_id; ?>" class="btn btn-emp-data btn-primary btn-sm">Approve</button><br/>
                                                    <button type="submit" id="emp-reject-<?php echo $i; ?>" value="<?php echo $emp->employee_id; ?>" class="btn btn-emp-reject btn-danger btn-sm">Reject</button></td>
                                            </tr>
                                        <?php endif; ?>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <?php echo $__env->make('overtime.modal.punch-modal', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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


        $(document).ready(function() {

            $(document).on('click', '.btn-emp-data', function () {
                // e.preventDefault();

                input_id = $(this).attr('id').split('-');
                item_id = parseInt(input_id[input_id.length - 1]);


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var url = 'calculate';

                // confirm then
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',

                    data: {
                        method: '_POST', submit: true, employee_id: $('#emp-data-' + item_id).val(),
                        final_hour: $('#final_hour-' + item_id).val(),
                        row_id: $('#row_id-' + item_id).val(),
                    },

                    error: function (request) {
                        alert(request.responseText);
                    },

                    success: function (data) {
                        // alert(data.success);
                        $('#tr-id-'+item_id).remove();
                    },

                });

            });





            $(document).on('click', '.btn-emp-reject', function () {
                // e.preventDefault();

                input_id = $(this).attr('id').split('-');
                item_id = parseInt(input_id[input_id.length - 1]);


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var url = 'overtimeReject';

                // confirm then
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',

                    data: {
                        method: '_POST', submit: true, employee_id: $('#emp-data-' + item_id).val(),
                        final_hour: $('#final_hour-' + item_id).val(),
                        row_id: $('#row_id-' + item_id).val(),
                    },

                    error: function (request) {
                        alert(request.responseText);
                    },

                    success: function (data) {
                        // alert(data.success);
                        $('#tr-id-'+item_id).remove();
                    },

                });

            });









            $(document).on('click', '.btn-emp-punch', function () {
                // e.preventDefault();

                input_id = $(this).attr('id').split('-');
                item_id = parseInt(input_id[input_id.length - 1]);
                $("#new-row").remove();


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var url = 'getPunchData';

                // confirm then
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',

                    data: {
                        method: '_GET', submit: true, employee_id: $('#emp-punch-' + item_id).val(),
                        punch_date: $('#punch_date-' + item_id).val(),
                    },

                    error: function (request) {
                        alert(request.responseText);
                    },

                    success: function (response) {

                        // $('#new-row').remove();
                        $(".new-row").remove();

                        var trHTML = '';

                        $.each(response, function (i, item) {
                            trHTML += '<tr class="new-row"><td>' + item.punch_dt + '</td></tr>';
                        });
                        $('#punch_table').append(trHTML);

                        $('#punchInfoModalSuccess').modal('show')
                    },

                });

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