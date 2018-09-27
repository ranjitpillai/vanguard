<?php $__env->startSection('page-title', trans('app.login')); ?>

<?php $__env->startSection('content'); ?>

<div class="col-md-8 col-lg-6 col-xl-5 mx-auto my-10p" id="login">
    <div class="text-center">
        <img src="<?php echo e(url('assets/img/vanguard-logo.png')); ?>" alt="<?php echo e(settings('app_name')); ?>" height="50">
    </div>

    <div class="card mt-5">
        <div class="card-body">
            <h5 class="card-title text-center mt-4 text-uppercase">
                <?php echo app('translator')->getFromJson('app.login'); ?>
            </h5>

            <div class="p-4">
                <?php echo $__env->make('auth.social.buttons', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <?php echo $__env->make('partials.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <form role="form" action="<?= url('login') ?>" method="POST" id="login-form" autocomplete="off" class="mt-3">

                    <input type="hidden" value="<?= csrf_token() ?>" name="_token">

                    <?php if(Input::has('to')): ?>
                        <input type="hidden" value="<?php echo e(Input::get('to')); ?>" name="to">
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="username" class="sr-only"><?php echo app('translator')->getFromJson('app.email_or_username'); ?></label>
                        <input type="text"
                                name="username"
                                id="username"
                                class="form-control"
                                placeholder="<?php echo app('translator')->getFromJson('app.email_or_username'); ?>">
                    </div>

                    <div class="form-group password-field">
                        <label for="password" class="sr-only"><?php echo app('translator')->getFromJson('app.password'); ?></label>
                        <input type="password"
                               name="password"
                               id="password"
                               class="form-control"
                               placeholder="<?php echo app('translator')->getFromJson('app.password'); ?>">
                    </div>


                    <?php if(settings('remember_me')): ?>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="remember" id="remember" value="1"/>
                            <label class="custom-control-label font-weight-normal" for="remember">
                                <?php echo app('translator')->getFromJson('app.remember_me'); ?>
                            </label>
                        </div>
                    <?php endif; ?>


                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn-login">
                            <?php echo app('translator')->getFromJson('app.log_in'); ?>
                        </button>
                    </div>
                </form>

                <?php if(settings('forgot_password')): ?>
                    <a href="<?= url('password/remind') ?>" class="forgot"><?php echo app('translator')->getFromJson('app.i_forgot_my_password'); ?></a>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <div class="text-center text-muted">
        <?php if(settings('reg_enabled')): ?>
            <?php echo app('translator')->getFromJson('app.dont_have_an_account'); ?> <a class="font-weight-bold" href="<?= url("register") ?>">Sign Up</a>
        <?php endif; ?>
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php echo HTML::script('assets/js/as/login.js'); ?>

    <?php echo JsValidator::formRequest('Vanguard\Http\Requests\Auth\LoginRequest', '#login-form'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>