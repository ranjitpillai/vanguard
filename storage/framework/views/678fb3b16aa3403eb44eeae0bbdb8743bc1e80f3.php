<?php $__env->startSection('page-title', trans('app.activity_log')); ?>
<?php $__env->startSection('page-heading', isset($user) ? $user->present()->nameOrEmail : trans('app.activity_log')); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <?php if(isset($user) && isset($adminView)): ?>
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('activity.index')); ?>"><?php echo app('translator')->getFromJson('app.activity_log'); ?></a>
        </li>
        <li class="breadcrumb-item active">
            <?php echo e($user->present()->nameOrEmail); ?>

        </li>
    <?php else: ?>
        <li class="breadcrumb-item active">
            <?php echo app('translator')->getFromJson('app.activity_log'); ?>
        </li>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="card">
    <div class="card-body">
        <form action="" method="GET" id="users-form" class="border-bottom-light mb-3">
            <div class="row justify-content-between mt-3 mb-4">
                <div class="col-lg-5 col-md-6">
                    <div class="input-group custom-search-form">
                        <input type="text"
                               class="form-control input-solid"
                               name="search"
                               value="<?php echo e(Input::get('search')); ?>"
                               placeholder="<?php echo app('translator')->getFromJson('app.search_for_action'); ?>">

                        <span class="input-group-append">
                            <?php if(Input::has('search') && Input::get('search') != ''): ?>
                                <a href="<?php echo e(isset($adminView) ? route('activity.index') : route('profile.activity')); ?>"
                                   class="btn btn-light d-flex align-items-center"
                                   role="button">
                                    <i class="fas fa-times text-muted"></i>
                                </a>
                            <?php endif; ?>
                            <button class="btn btn-light" type="submit" id="search-activities-btn">
                                <i class="fas fa-search text-muted"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-borderless table-striped">
                <thead>
                    <?php if(isset($adminView)): ?>
                        <th class="min-width-150"><?php echo app('translator')->getFromJson('app.user'); ?></th>
                    <?php endif; ?>
                    <th><?php echo app('translator')->getFromJson('app.ip_address'); ?></th>
                    <th class="min-width-200"><?php echo app('translator')->getFromJson('app.message'); ?></th>
                    <th class="min-width-200"><?php echo app('translator')->getFromJson('app.log_time'); ?></th>
                    <th class="text-center"><?php echo app('translator')->getFromJson('app.more_info'); ?></th>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <?php if(isset($adminView)): ?>
                                <td>
                                    <?php if(isset($user)): ?>
                                        <?php echo e($activity->user->present()->nameOrEmail); ?>

                                    <?php else: ?>
                                        <a href="<?php echo e(route('activity.user', $activity->user_id)); ?>"
                                           data-toggle="tooltip" title="<?php echo app('translator')->getFromJson('app.view_activity_log'); ?>">
                                            <?php echo e($activity->user->present()->nameOrEmail); ?>

                                        </a>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                            <td><?php echo e($activity->ip_address); ?></td>
                            <td><?php echo e($activity->description); ?></td>
                            <td><?php echo e($activity->created_at->format(config('app.date_time_format'))); ?></td>
                            <td class="text-center">
                                <a tabindex="0" role="button" class="btn btn-icon"
                                   data-trigger="focus"
                                   data-placement="left"
                                   data-toggle="popover"
                                   title="<?php echo app('translator')->getFromJson('app.user_agent'); ?>"
                                   data-content="<?php echo e($activity->user_agent); ?>">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php echo $activities->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>