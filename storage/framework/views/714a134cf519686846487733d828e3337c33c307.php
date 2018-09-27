<div class="panel panel-default">
    <div class="panel-heading"><?php echo app('translator')->getFromJson('app.company_details'); ?></div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
              
                <div class="form-group">
                    <label for="name"><?php echo app('translator')->getFromJson('app.company_name'); ?></label>
                    <input type="text" class="form-control" id="name"
                           name="company_name" placeholder="<?php echo app('translator')->getFromJson('app.company_name'); ?>" value="<?php echo e($edit ? $company->company_name : old('company_name')); ?>">
                </div>
                <div class="form-group">
                    <label for="name"><?php echo app('translator')->getFromJson('app.company_details'); ?></label>                  
                    <textarea name="company_details" class="form-control" placeholder="<?php echo app('translator')->getFromJson('app.company_details'); ?>"><?php echo e($edit ? $company->company_details : old('company_details')); ?></textarea>
                    <input type="hidden" name="page" value="<?php echo e($profile ? 'profile' : 'edit'); ?>">
                </div>
				 <div class="form-group">
                    <label for="address"><?php echo app('translator')->getFromJson('app.company_code'); ?></label>
                    <input type="text" class="form-control" id="company_code"
                           name="company_code" placeholder="<?php echo app('translator')->getFromJson('app.company_code'); ?>" value="<?php echo e($edit ? $company->company_code : ''); ?>">
                </div>
            </div>

            <div class="col-md-6">
                
                <div class="form-group">
                    <label for="company_phone"><?php echo app('translator')->getFromJson('app.company_phone'); ?></label>
                    <input type="text" class="form-control" id="company_phone"
                           name="company_phone" placeholder="<?php echo app('translator')->getFromJson('app.company_phone'); ?>" value="<?php echo e($edit ? $company->company_phone : ''); ?>">
                </div>
               

                <div class="form-group">
                    <label for="company_website"><?php echo app('translator')->getFromJson('app.company_website'); ?></label>
                    <input type="text" class="form-control" id="company_website"
                           name="company_website" placeholder="<?php echo app('translator')->getFromJson('app.company_website'); ?>" value="<?php echo e($edit ? $company->company_website : ''); ?>">
                </div>
               
                <div class="form-group">
                    <label for="company_fax"><?php echo app('translator')->getFromJson('app.company_fax'); ?></label>
                    <input type="text" class="form-control" id="company_fax"
                           name="company_fax" placeholder="<?php echo app('translator')->getFromJson('app.company_fax'); ?>" value="<?php echo e($edit ? $company->company_fax : ''); ?>">
                </div>

                <div class="form-group">
                    <label for="company_address"><?php echo app('translator')->getFromJson('app.company_address'); ?></label>
                    <input type="text" class="form-control" id="company_address"
                           name="company_address" placeholder="<?php echo app('translator')->getFromJson('app.company_address'); ?>" value="<?php echo e($edit ? $company->company_address : ''); ?>">
                </div>
               
            </div>

            <?php if($edit): ?>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" id="update-details-btn">
                        <i class="fa fa-refresh"></i>
                        <?php echo app('translator')->getFromJson('app.update_details'); ?>
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>