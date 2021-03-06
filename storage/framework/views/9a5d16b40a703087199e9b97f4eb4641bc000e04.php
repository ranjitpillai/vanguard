<div class="panel panel-default">
    <div class="panel-heading"><?php echo app('translator')->getFromJson('app.social_networks'); ?></div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="facebook">Facebook</label>
                    <div class="input-icon">
                        <i class="fas fa-address-book"></i>
                        <input type="text" class="form-control" id="facebook"
                               name="facebook" placeholder="Facebook"
                               value="<?php echo e($edit ? $company->facebook : ''); ?>">
                        <input type="hidden" name="page" value="<?php echo e($profile ? 'profile' : 'edit'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="twitter">Twitter</label>
                    <div class="input-icon">
                        <i class="fab fa-twitter"></i>
                        <input type="text" class="form-control" id="twitter"
                               name="twitter" placeholder="Twitter"
                               value="<?php echo e($edit ? $company->twitter : ''); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="google_plus">Google+</label>
                    <div class="input-icon">
                        <i class="fab fa-google-plus-g"></i>
                        <input type="text" class="form-control" id="google_plus"
                               name="google_plus" placeholder="Google+"
                               value="<?php echo e($edit ? $company->google_plus : ''); ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="linkedin">LinkedIn</label>
                    <div class="input-icon">
                        <i class="fab fa-linkedin-in"></i>
                        <input type="text" class="form-control" id="linkedin"
                               name="linked_in" placeholder="LinkedIn"
                               value="<?php echo e($edit ? $company->linked_in : ''); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="dribbble">Dribbble</label>
                    <div class="input-icon">
                        <i class="fab fa-dribbble"></i>
                        <input type="text" class="form-control" id="dribbble"
                               name="dribbble" placeholder="Dribbble"
                               value="<?php echo e($edit ? $company->dribbble : ''); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Skype">Skype</label>
                    <div class="input-icon">
                        <i class="fab fa-skype"></i>
                        <input type="text" class="form-control" id="skype"
                               name="skype" placeholder="Skype ID"
                               value="<?php echo e($edit ? $company->skype : ''); ?>">
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-refresh"></i>
            <?php echo app('translator')->getFromJson('app.update_social_networks'); ?>
        </button>
    </div>
</div>