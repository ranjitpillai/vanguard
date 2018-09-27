<?php $__env->startSection('page-title', trans('app.authentication_settings')); ?>
<?php $__env->startSection('page-heading', trans('app.authentication')); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <li class="breadcrumb-item text-muted">
        <?php echo app('translator')->getFromJson('app.settings'); ?>
    </li>
    <li class="breadcrumb-item active">
        <?php echo app('translator')->getFromJson('app.authentication'); ?>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('partials.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<!-- Nav tabs -->
<ul class="nav nav-pills mb-4 mt-2" id="pills-tab" role="tablist">
    <li class="nav-item">
        <a href="#auth"
           class="nav-link active"
           id="pills-home-tab"
           data-toggle="pill"
           aria-controls="pills-home"
           aria-selected="true">
            <i class="fa fa-lock"></i>
            <?php echo app('translator')->getFromJson('app.authentication'); ?>
        </a>
    </li>
    <li class="nav-item">
        <a href="#registration"
           class="nav-link"
           id="pills-home-tab"
           data-toggle="pill"
           aria-controls="pills-home"
           aria-selected="true">
            <i class="fa fa-user-plus"></i>
            <?php echo app('translator')->getFromJson('app.registration'); ?>
        </a>
    </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="auth">
        <div class="row">
            <div class="col-md-6">
                <?php echo $__env->make('settings.partials.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->make('settings.partials.two-factor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="col-md-6">
                <?php echo $__env->make('settings.partials.throttling', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="registration">
        <div class="row">
            <div class="col-md-6">
                <?php echo $__env->make('settings.partials.registration', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="col-md-6">
                <?php echo $__env->make('settings.partials.recaptcha', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>