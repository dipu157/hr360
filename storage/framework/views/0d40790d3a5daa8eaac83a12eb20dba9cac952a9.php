<?php $__env->startSection('pagetitle'); ?>
    <h2 class="no-margin-bottom">Dashboard</h2>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <script type="text/javascript" src="<?php echo asset('assets/js/jquery-3.3.1.min.js'); ?>"></script>

    <div class="container-fluid">

        <div class="alert alert-danger justify-content-center" role="alert">
            <strong>Important! <br/>  </strong> <strong class="blinking font-weight-bold">১। এখন থেকে শুধুমাত্র নতুন সফটওয়ার এই Roster Data সঠিকভাবে এন্ট্রি করতে হবে।
                চলতি মাসে বিগত দিনের Roster Data সব সময় চলতি দিনের মধ্যে Update করে
                ফেলতে হবে। নাহলে সংশ্লিস্ট অফিসিয়ালকে ভুল রোস্টার অনুযায়ী Attendance দেখাবে।
            </strong>
        </div>

        <div class="alert alert-danger justify-content-center" role="alert">
            <strong></strong> <strong class="blinking font-weight-bold">২। সময়মত বিগত দিনের Overtime Data এখানে এন্ট্রি করতে হবে।
            </strong>
        </div>

        <div class="alert alert-danger justify-content-center" role="alert">
            <strong></strong> <strong class="blinking font-weight-bold">৩। সময়মত Leave Application, Acknowledge & Recommend করতে হবে। নাহলে
                সংশ্লিস্ট অফিসিয়াল সেই দিন অনুপস্থিত হিসাবে গন্য হবে।
            </strong>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        REQUESTS
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped table-success">
                            <tbody>


                                <?php if($ack_leave > 0): ?>

                                    <button type="button" class="btn btn-info btn-acknowledge">
                                        <strong style="color: #980000">Your Colleague Need Your Kind Attention</strong><span class="badge badge-light"><?php echo $ack_leave; ?></span>
                                    </button>

                                    <img src="<?php echo asset('assets/images/ackLeave.jpg'); ?>" width="400px" height="400px" class="rounded-circle" alt="Cinque Terre">

                                <?php endif; ?>


                                <?php if($rec_count > 0): ?>

                                    <button type="button" class="btn btn-default btn-recommend">
                                        <strong style="color: #980000">Some One Need Your Kind Recommendation</strong><span class="badge badge-light"><?php echo $rec_count; ?></span>
                                    </button>

                                    <img src="<?php echo asset('assets/images/recommendLeave.jpg'); ?>" width="400px" height="200px" class="rounded-circle" alt="Cinque Terre">

                                <?php endif; ?>


                            </tbody>


                        </table>

                    </div>
                    <div class="card-footer text-muted">
                        <?php echo \Carbon\Carbon::now()->format('d-m-Y H:i'); ?>

                    </div>
                </div>
            </div>


            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header text-center">
                        NOTICE BOARD
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped table-primary">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Title</th>
                                    <th>Details</th>
                                    <th>VIEW</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $notices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo \Carbon\Carbon::parse($row->notice_date)->format('d-M-Y'); ?></td>
                                    <td><?php echo $row->title; ?></td>
                                    <td><?php echo $row->description; ?></td>
                                    <td><button type="button" id="notice-id-<?php echo $i; ?>" value="<?php echo $row->id; ?>" class="btn btn-sm btn-primary btn-notice-view">VIEW</button></td>
                                </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- Dashboard Counts Section-->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

    <script>
        $(function() {

            $(document).on("click", ".btn-acknowledge", function (e) {
                e.preventDefault();

                window.location.href = 'leave/acknowledgeIndex';

            });

            $(document).on("click", ".btn-recommend", function (e) {
                e.preventDefault();

                window.location.href = 'leave/recommendIndex';

            });


            $(document).on("click", ".btn-notice-view", function (e) {
                e.preventDefault();

                input_id = $(this).attr('id').split('-');
                item_id = parseInt(input_id[input_id.length - 1]);

                window.location.href = 'notice/view/'+ $('#notice-id-' + item_id).val();

            });

        });

        idleTimer();


        function blinker() {
            $('.blinking').fadeOut(500);
            $('.blinking').fadeIn(500);
        }
        setInterval(blinker, 5000);




    </script>






<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>