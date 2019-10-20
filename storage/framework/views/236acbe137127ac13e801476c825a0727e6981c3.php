<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Login</title>

    <!-- Styles -->
    
    <link href="<?php echo e(asset('assets/css/login.css')); ?>" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="<?php echo asset('assets/bootstrap-4.1.3/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <script src="<?php echo asset('assets/bootstrap-4.1.3/js/bootstrap.min.js'); ?>"></script>
</head>

<style>
    #text {display:none;color:red}
</style>


<body>


<div class="container">

    <div class="row">
        <div class="col-8 mx-auto">
            
            
            
            
            
            
        </div>
    </div>

    <div class="row">
        <div class="col-8 mx-auto">
            <h1 style="font-size: 30px; color: #3371FF" class="text-center login-title">Welcome To "HR360" Module</h1>
            <h3 class="text-center login-title">Login To Continue</h3>

            <div class="account-wall">
                <img class="profile-img" src="<?php echo asset('assets/images/sign.png'); ?>"  alt="Key Image">
                <?php if(count($errors) > 0): ?>
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>

                    </div>
                <?php endif; ?>

                
                <form class="form-signin" role="form" method="POST" action="<?php echo e(route('login')); ?>">
                    
                    

                    <?php echo e(csrf_field()); ?>

                    

                    <?php echo Form::email('email', 'your-id@brbhospital.com' , array('id' => 'email', 'class' => 'col-sm-12 form-control','placeholder' => 'email', 'required')); ?>



                    <?php echo Form::password('password', array('class' => 'form-control','placeholder' => 'Password', 'required','id'=>'password')); ?>

                    <?php echo e($errors->has('password') ? ' has-error' : ''); ?>

                    <p id="text">WARNING! Caps lock is ON.</p>
                    <?php if($errors->has('password')): ?>
                        <span class="help-block">
                                <strong><?php echo e($errors->first('password')); ?></strong>
                            </span>
                    <?php endif; ?>

                    <button class="btn btn-lg btn-primary btn-block" type="submit">
                        Sign in</button>
                </form>

                

                
                
                

            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('partials.flash-message', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<script>
    var input = document.getElementById("password");
    var text = document.getElementById("text");
    input.addEventListener("keyup", function(event) {

        if (event.getModifierState("CapsLock")) {
            text.style.display = "block";
        } else {
            text.style.display = "none"
        }
    });
</script>



</body>
</html>
