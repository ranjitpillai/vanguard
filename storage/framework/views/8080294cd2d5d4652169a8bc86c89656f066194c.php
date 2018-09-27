<div class="card">
    <div class="card-body">
        <h5 class="card-title mb-1">
            Google reCAPTCHA
        </h5>

        <small class="text-muted d-block mb-4">
            <?php echo app('translator')->getFromJson('app.enable_disable_captcha_during_registration'); ?>
        </small>

        <?php if(! (config('captcha.secret') && config('captcha.sitekey'))): ?>
            <div class="alert alert-info">
                <?php echo app('translator')->getFromJson('app.to_utilize_recaptcha_please_get'); ?> <code><?php echo app('translator')->getFromJson('app.site_key'); ?></code> and <code><?php echo app('translator')->getFromJson('app.secret_key'); ?></code>
                <?php echo app('translator')->getFromJson('app.from'); ?> <a href="https://www.google.com/recaptcha/intro/index.html" target="_blank"><strong><?php echo app('translator')->getFromJson('app.recaptcha_website'); ?></strong></a>,
                <?php echo app('translator')->getFromJson('app.and_update_your'); ?> <code>RECAPTCHA_SITEKEY</code> <?php echo app('translator')->getFromJson('app.and'); ?> <code>RECAPTCHA_SECRETKEY</code> <?php echo app('translator')->getFromJson('app.environment_variables_inside'); ?> <code>.env</code> <?php echo app('translator')->getFromJson('app.file'); ?>.
            </div>
        <?php else: ?>
            <?php if(settings('registration.captcha.enabled')): ?>
                <?php echo Form::open(['route' => 'settings.registration.captcha.disable', 'id' => 'captcha-settings-form']); ?>

                <button type="submit" class="btn btn-danger">
                    <?php echo app('translator')->getFromJson('app.disable'); ?>
                </button>
                <?php echo Form::close(); ?>

            <?php else: ?>
                <?php echo Form::open(['route' => 'settings.registration.captcha.enable', 'id' => 'captcha-settings-form']); ?>

                <button type="submit" class="btn btn-primary">
                    <?php echo app('translator')->getFromJson('app.enable'); ?>
                </button>
                <?php echo Form::close(); ?>

            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>