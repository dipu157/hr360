<?php $__env->startSection('pagetitle'); ?>
    <h2 class="no-margin-bottom">Grant Privillege To User</h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <script type="text/javascript" src="<?php echo asset('assets/js/jquery-3.3.1.min.js'); ?>"></script>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User Privillege</div>

                    <div class="card-body">
                        <form method="get" action="<?php echo e(route('privillege/index')); ?>" >
                            <?php echo csrf_field(); ?>

                            <div class="form-group row">
                                <label for="user_email" class="col-md-4 col-form-label text-md-right">Select User</label>

                                <div class="col-md-6">

                                    <?php echo Form::select('user_email',$emails,null,array('id'=>'user_email','class'=>'form-control','autofocus')); ?>


                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="group_id" class="col-md-4 col-form-label text-md-right">Select Menu</label>

                                <div class="col-md-6">

                                    <?php echo Form::select('group_id',$menus,null,array('id'=>'group_id','class'=>'form-control')); ?>


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

        <?php if(!empty($data)): ?>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Name: <?php echo $user->name; ?>  Email: <?php echo $user->email; ?></div>

                    <div class="card-body">
                        <form method="post" action="<?php echo e(route('privillege/grant')); ?>" >
                            <?php echo csrf_field(); ?>

                            <table class="table table-responsive table-hover table-bordered table-striped w-auto">
                                <thead style="background-color: rgba(26,220,246,0.06)">
                                <tr>
                                    <th>Use Case</th>
                                    <th>Description</th>
                                    <th>View</th>
                                    <th>Add</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr >
                                        <td width="10%"><label for="paid_amt" class="control-label"><?php echo $row->usecase->usecase_id; ?></label></td>
                                        <td width="20%"><label for="paid_amt" class="control-label"><?php echo $row->usecase->name; ?></label></td>
                                        <?php if($row->usecase->menu_type == 'S'): ?>
                                        <td  width="10%" class="table-primary"><?php echo Form::checkbox('view[]',$row->menu_id, $row->view); ?></td>
                                        <td  width="10%" class="table-success"><?php echo Form::checkbox('add[]',$row->menu_id, $row->add); ?></td>
                                        <td  width="10%" class="table-info"><?php echo Form::checkbox('edit[]',$row->menu_id, $row->edit); ?></td>
                                        <td  width="10%" class="table-danger"><?php echo Form::checkbox('delete[]',$row->menu_id, $row->delete); ?></td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                            <input type="hidden" id="group_id" name="group_id" value="<?php echo $data[0]->group_id; ?>">

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" name="action" value="<?php echo $user->id; ?>">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php endif; ?>

    </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>