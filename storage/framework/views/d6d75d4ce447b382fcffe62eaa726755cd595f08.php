<div class="card">
    <div class="card-body">
        <h5 class="card-title"><?php echo app('translator')->getFromJson('app.authentication_throttling'); ?></h5>

        <?php echo Form::open(['route' => 'settings.auth.update', 'id' => 'auth-throttle-settings-form']); ?>


        <div class="form-group my-4">
            <div class="d-flex align-items-center">
                <div class="switch">
                    <input type="hidden" value="0" name="throttle_enabled">
                    <?php echo Form::checkbox('throttle_enabled', 1, settings('throttle_enabled'), ['class' => 'switch', 'id' => 'switch-throttle']); ?>

                    <label for="switch-throttle"></label>
                </div>
                <div class="ml-3 d-flex flex-column">
                    <label class="mb-0"><?php echo app('translator')->getFromJson('app.throttle_authentication'); ?></label>
                    <small class="text-muted">
                        <?php echo app('translator')->getFromJson('app.should_the_system_throttle_authentication_requests'); ?>
                    </small>
                </div>
            </div>
        </div>

        <div class="form-group my-4">
            <label for="throttle_attempts">
                <?php echo app('translator')->getFromJson('app.maximum_number_of_attempts'); ?> <br>
                <small class="text-muted"><?php echo app('translator')->getFromJson('app.max_number_of_incorrect_login_attempts'); ?></small>
            </label>
            <input type="text" name="throttle_attempts" class="form-control"
                   value="<?php echo e(settings('throttle_attempts', 10)); ?>">
        </div>

        <div class="form-group my-4">
            <label for="throttle_lockout_time">
                <?php echo app('translator')->getFromJson('app.lockout_time'); ?> <br>
                <small class="text-muted"><?php echo app('translator')->getFromJson('app.num_of_minutes_to_lock_the_user'); ?></small>
            </label>
            <input type="text" name="throttle_lockout_time" class="form-control"
                   value="<?php echo e(settings('throttle_lockout_time', 1)); ?>">
        </div>

        <button type="submit" class="btn btn-primary">
            <?php echo app('translator')->getFromJson('app.update_settings'); ?>
        </button>

        <?php echo Form::close(); ?>

    </div>
</div>