<?php $__env->startSection('page-title', 'Active Users'); ?>
<?php $__env->startSection('page-heading', 'Active Users'); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <li class="breadcrumb-item active">
        Active Users
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="user media d-flex align-items-center">
            <div>
                <a href="#">
                    <img width="64" height="64"
                        class="media-object mr-3 rounded-circle img-thumbnail img-responsive"
                        src="<?php echo e($user->present()->avatar); ?>">
                </a>
            </div>
            <div class="d-flex justify-content-center flex-column">
                <h5 class="mb-0"><?php echo e($user->present()->name); ?></h5>
                <small class="text-muted"><?php echo e($user->email); ?></small>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    <style>
        .user.media {
            float: left;
            border: 1px solid #dfdfdf;
            background-color: #fff;
            padding: 15px 20px;
            border-radius: 4px;
            margin-right: 15px;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>