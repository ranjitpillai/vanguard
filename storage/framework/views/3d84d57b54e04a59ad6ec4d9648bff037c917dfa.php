<div class="card">
    <div class="card-body">

        <h5 class="card-title">
            <?php echo app('translator')->getFromJson('app.general'); ?>
        </h5>

        <?php echo Form::open(['route' => 'settings.auth.update', 'id' => 'auth-general-settings-form']); ?>


        <div class="form-group my-4">
            <div class="d-flex align-items-center">
                 <div class="switch">
                     <input type="hidden" value="0" name="remember_me">
                     <?php echo Form::checkbox('remember_me', 1, settings('remember_me'), ['class' => 'switch', 'id' => 'switch-remember-me']); ?>

                     <label for="switch-remember-me"></label>
                 </div>
                <div class="ml-3 d-flex flex-column">
                    <label class="mb-0"><?php echo app('translator')->getFromJson('app.allow_remember_me'); ?></label>
                    <small class="pt-0 text-muted">
                        <?php echo app('translator')->getFromJson('app.should_remember_me_be_displayed'); ?>
                    </small>
                </div>
            </div>
        </div>

        <div class="form-group my-4">
            <div class="d-flex align-items-center">
                <div class="switch">
                    <input type="hidden" value="0" name="forgot_password">
                    <?php echo Form::checkbox('forgot_password', 1, settings('forgot_password'), ['class' => 'switch', 'id' => 'switch-forgot-pass']); ?>

                    <label for="switch-forgot-pass"></label>
                </div>
                <div class="ml-3 d-flex flex-column">
                    <label class="mb-0"><?php echo app('translator')->getFromJson('app.forgot_password'); ?></label>
                    <small class="pt-0 text-muted">
                        <?php echo app('translator')->getFromJson('app.enable_disable_forgot_password'); ?>
                    </small>
                </div>
            </div>
        </div>

        <div class="form-group my-4">
            <label for="login_reset_token_lifetime">
                <?php echo app('translator')->getFromJson('app.reset_token_lifetime'); ?> <br>
                <small class="text-muted"><?php echo app('translator')->getFromJson('app.number_of_minutes'); ?></small>
            </label>
            <input type="text" name="login_reset_token_lifetime"
                   class="form-control" value="<?php echo e(settings('login_reset_token_lifetime', 30)); ?>">
        </div>

        <button type="submit" class="btn btn-primary">
            <?php echo app('translator')->getFromJson('app.update_settings'); ?>
        </button>

        <?php echo Form::close(); ?>

    </div>
</div>