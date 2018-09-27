<div class="panel panel-default">
    <div class="panel-heading"><?php echo app('translator')->getFromJson('app.address_details'); ?></div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
				<div class="form-group">
                    <label for="street1"><?php echo app('translator')->getFromJson('app.street1'); ?></label>
                    <input type="text" class="form-control" id="street1"
                           name="street1" placeholder="<?php echo app('translator')->getFromJson('app.street1'); ?>" value="<?php echo e($edit ? $company->street1 : ''); ?>">
                    <input type="hidden" name="page" value="<?php echo e($profile ? 'profile' : 'edit'); ?>">
                </div>
				<div class="form-group">
                    <label for="city"><?php echo app('translator')->getFromJson('app.city'); ?></label>
                    <input type="text" class="form-control" id="city"
                           name="city" placeholder="<?php echo app('translator')->getFromJson('app.city'); ?>" value="<?php echo e($edit ? $company->city : ''); ?>">
                </div>
				<div class="form-group">
                    <label for="state"><?php echo app('translator')->getFromJson('app.state'); ?></label>
                    <input type="text" class="form-control" id="state"
                           name="state" placeholder="<?php echo app('translator')->getFromJson('app.state'); ?>" value="<?php echo e($edit ? $company->state : ''); ?>">
                </div>
				<div class="form-group">
                    <label for="address"><?php echo app('translator')->getFromJson('app.address'); ?></label>
                    <input type="text" class="form-control" id="address"
                           name="address" placeholder="<?php echo app('translator')->getFromJson('app.address'); ?>" value="<?php echo e($edit ? $company->address : ''); ?>">
                </div>
              
            </div>
            <div class="col-md-6">
				<div class="form-group">
                    <label for="street2"><?php echo app('translator')->getFromJson('app.street2'); ?></label>
                    <input type="text" class="form-control" id="street2"
                           name="street2" placeholder="<?php echo app('translator')->getFromJson('app.street2'); ?>" value="<?php echo e($edit ? $company->street2 : ''); ?>">
                </div>
				<div class="form-group">
                    <label for="postal_code"><?php echo app('translator')->getFromJson('app.postal_code'); ?></label>
                    <input type="text" class="form-control" id="postal_code"
                           name="postal_code" placeholder="<?php echo app('translator')->getFromJson('app.postal_code'); ?>" value="<?php echo e($edit ? $company->postal_code : ''); ?>">
                </div>
				<div class="form-group">
                    <label for="state_code"><?php echo app('translator')->getFromJson('app.state_code'); ?></label>
                    <input type="text" class="form-control" id="state_code"
                           name="state_code" placeholder="<?php echo app('translator')->getFromJson('app.state_code'); ?>" value="<?php echo e($edit ? $company->state_code : ''); ?>">
                </div>
                <div class="form-group">
                    <label for="address"><?php echo app('translator')->getFromJson('app.country'); ?></label>
                    <?php echo Form::select('country_id', $countries, $edit ? $company->country_id : '', ['class' => 'form-control']); ?>

                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-refresh"></i>
            <?php echo app('translator')->getFromJson('app.update_address_details'); ?>
        </button>
    </div>
</div>