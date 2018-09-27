<div class="card">
    <div class="card-body">
        <h5 class="card-title mb-1"><?php echo app('translator')->getFromJson('app.two_factor_authentication'); ?></h5>

        <small class="text-muted d-block mb-4">
            <?php echo app('translator')->getFromJson('app.enable_disable_2fa'); ?>
        </small>

        <?php if(! config('services.authy.key')): ?>
            <div class="alert alert-info">
                <?php echo app('translator')->getFromJson('app.in_order_to_enable_2fa'); ?>
                <?php echo app('translator')->getFromJson('app.new_application_on'); ?> <a href="https://www.authy.com/" target="_blank"><strong><?php echo app('translator')->getFromJson('app.authy_website'); ?></strong></a>,
                <?php echo app('translator')->getFromJson('app.and_update_your'); ?> <code>AUTHY_KEY</code> <?php echo app('translator')->getFromJson('app.environment_variable_inside'); ?> <code>.env</code> <?php echo app('translator')->getFromJson('app.file'); ?>.
            </div>
        <?php else: ?>
            <?php if(settings('2fa.enabled')): ?>
                <?php echo Form::open(['route' => 'settings.auth.2fa.disable', 'id' => 'auth-2fa-settings-form']); ?>

                <button type="submit" class="btn btn-danger" data-toggle="loader" data-loading-text="<?php echo app('translator')->getFromJson('app.disabling'); ?>">
                    <?php echo app('translator')->getFromJson('app.disable'); ?>
                </button>
                <?php echo Form::close(); ?>

            <?php else: ?>
                <?php echo Form::open(['route' => 'settings.auth.2fa.enable', 'id' => 'auth-2fa-settings-form']); ?>

                <button type="submit" class="btn btn-primary" data-toggle="loader" data-loading-text="<?php echo app('translator')->getFromJson('app.enabling'); ?>">
                    <?php echo app('translator')->getFromJson('app.enable'); ?>
                </button>
                <?php echo Form::close(); ?>

            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>