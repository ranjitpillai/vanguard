<div class="card">
    <div class="card-body">
        <h5 class="card-title"><?php echo app('translator')->getFromJson('app.general'); ?></h5>

        <?php echo Form::open(['route' => 'settings.auth.update', 'id' => 'registration-settings-form']); ?>


        <div class="form-group my-4">
            <div class="d-flex align-items-center">
                <div class="switch">
                    <input type="hidden" value="0" name="reg_enabled">

                    <input
                        type="checkbox" name="reg_enabled"
                        id="switch-reg-enabled"
                        class="switch" value="1"
                        <?php echo e(settings('reg_enabled') ? 'checked' : ''); ?>>

                    <label for="switch-reg-enabled"></label>
                </div>
                <div class="ml-3 d-flex flex-column">
                    <label class="mb-0"><?php echo app('translator')->getFromJson('app.allow_registration'); ?></label>
                </div>
            </div>
        </div>

        <div class="form-group my-4">
            <div class="d-flex align-items-center">
                <div class="switch">
                    <input type="hidden" value="0" name="tos">
                    <?php echo Form::checkbox('tos', 1, settings('tos'), ['class' => 'switch', 'id' => 'switch-tos']); ?>

                    <label for="switch-tos"></label>
                </div>
                <div class="ml-3 d-flex flex-column">
                    <label class="mb-0"><?php echo app('translator')->getFromJson('app.terms_and_conditions'); ?></label>
                    <small class="pt-0 text-muted">
                        <?php echo app('translator')->getFromJson('app.the_user_has_to_confirm'); ?>
                    </small>
                </div>
            </div>
        </div>

        <div class="form-group my-4">
            <div class="d-flex align-items-center">
                <div class="switch">
                    <input type="hidden" value="0" name="reg_email_confirmation">
                    <?php echo Form::checkbox('reg_email_confirmation', 1, settings('reg_email_confirmation'), ['class' => 'switch', 'id' => 'switch-reg-email-confirm']); ?>

                    <label for="switch-reg-email-confirm"></label>
                </div>
                <div class="ml-3 d-flex flex-column">
                    <label class="mb-0"><?php echo app('translator')->getFromJson('app.email_confirmation'); ?></label>
                    <small class="text-muted">
                        <?php echo app('translator')->getFromJson('app.require_email_confirmation'); ?>
                    </small>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">
            <?php echo app('translator')->getFromJson('app.update_settings'); ?>
        </button>
        <?php echo Form::close(); ?>

    </div>
</div>