<?php $__env->startSection('page-title', trans('app.dashboard')); ?>
<?php $__env->startSection('page-heading', trans('app.dashboard')); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <li class="breadcrumb-item active">
        <?php echo app('translator')->getFromJson('app.dashboard'); ?>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">

    <div class="col-xl-3 col-md-6">
        <div class="card widget">
            <div class="card-body">
                <div class="row">
                    <div class="p-3 text-primary flex-1">
                        <i class="fa fa-users fa-3x"></i>
                    </div>

                    <div class="pr-3">
                        <h2 class="text-right"><?php echo e(number_format($stats['total'])); ?></h2>
                        <div class="text-muted"><?php echo app('translator')->getFromJson('app.total_users'); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card widget">
            <div class="card-body">
                <div class="row">
                    <div class="p-3 text-success flex-1">
                        <i class="fa fa-user-plus fa-3x"></i>
                    </div>

                    <div class="pr-3">
                        <h2 class="text-right"><?php echo e(number_format($stats['new'])); ?></h2>
                        <div class="text-muted"><?php echo app('translator')->getFromJson('app.new_users_this_month'); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card widget">
            <div class="card-body">
                <div class="row">
                    <div class="p-3 text-danger flex-1">
                        <i class="fa fa-user-slash fa-3x"></i>
                    </div>

                    <div class="pr-3">
                        <h2 class="text-right"><?php echo e(number_format($stats['banned'])); ?></h2>
                        <div class="text-muted"><?php echo app('translator')->getFromJson('app.banned_users'); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card widget">
            <div class="card-body">
                <div class="row">
                    <div class="p-3 text-info flex-1">
                        <i class="fa fa-user fa-3x"></i>
                    </div>

                    <div class="pr-3">
                        <h2 class="text-right"><?php echo e(number_format($stats['unconfirmed'])); ?></h2>
                        <div class="text-muted"><?php echo app('translator')->getFromJson('app.unconfirmed_users'); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-lg-8 col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo app('translator')->getFromJson('app.registration_history'); ?></h5>
                <div class="pt-4 px-3">
                    <canvas id="myChart" height="365"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <?php echo app('translator')->getFromJson('app.latest_registrations'); ?>

                    <?php if(count($latestRegistrations)): ?>
                        <small class="float-right">
                            <a href="<?php echo e(route('user.list')); ?>">View All</a>
                        </small>
                    <?php endif; ?>
                </h5>

                <?php if(count($latestRegistrations)): ?>
                    <ul class="list-group list-group-flush">
                        <?php $__currentLoopData = $latestRegistrations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item list-group-item-action">
                                <a href="<?php echo e(route('user.show', $user->id)); ?>" class="d-flex text-dark no-decoration">
                                    <img class="rounded-circle" width="40" height="40" src="<?php echo e($user->present()->avatar); ?>">
                                    <div class="ml-2" style="line-height: 1.2;">
                                        <span class="d-block p-0"><?php echo e($user->present()->nameOrEmail); ?></span>
                                        <small class="text-muted"><?php echo e($user->created_at->diffForHumans()); ?></small>
                                    </div>
                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php else: ?>
                    <p class="text-muted"><?php echo app('translator')->getFromJson('app.no_records_found'); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        var users = <?php echo json_encode(array_values($usersPerMonth)); ?>;
        var months = <?php echo json_encode(array_keys($usersPerMonth)); ?>;
        var trans = {
            chartLabel: "<?php echo e(trans('app.registration_history')); ?>",
            new: "<?php echo e(trans('app.new_sm')); ?>",
            user: "<?php echo e(trans('app.user_sm')); ?>",
            users: "<?php echo e(trans('app.users_sm')); ?>"
        };
    </script>
    <?php echo HTML::script('assets/js/chart.min.js'); ?>

    <?php echo HTML::script('assets/js/as/dashboard-admin.js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>