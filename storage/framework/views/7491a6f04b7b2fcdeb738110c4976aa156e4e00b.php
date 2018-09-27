<?php $__env->startSection('page-title', trans('app.general_settings')); ?>
<?php $__env->startSection('page-heading', trans('app.general_settings')); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <li class="breadcrumb-item text-muted">
        <?php echo app('translator')->getFromJson('app.settings'); ?>
    </li>
    <li class="breadcrumb-item active">
        <?php echo app('translator')->getFromJson('app.general'); ?>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('partials.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo Form::open(['route' => 'settings.general.update', 'id' => 'general-settings-form']); ?>


<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="name"><?php echo app('translator')->getFromJson('app.name'); ?></label>
                    <input type="text" class="form-control" id="app_name"
                           name="app_name" value="<?php echo e(settings('app_name')); ?>">
                </div>
            </div>
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary">
    <?php echo app('translator')->getFromJson('app.update_settings'); ?>
</button>

<?php echo e(Form::close()); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>