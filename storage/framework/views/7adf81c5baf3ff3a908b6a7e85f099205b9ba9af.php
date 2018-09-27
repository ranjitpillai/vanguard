<?php $__env->startSection('page-title', trans('app.users')); ?>
<?php $__env->startSection('page-heading', trans('app.users')); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <li class="breadcrumb-item active">
        <?php echo app('translator')->getFromJson('app.users'); ?>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('partials.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="card">
    <div class="card-body">

        <form action="" method="GET" id="users-form" class="pb-2 mb-3 border-bottom-light">
            <div class="row my-3 flex-md-row flex-column-reverse">
                <div class="col-md-4 mt-md-0 mt-2">
                    <div class="input-group custom-search-form">
                        <input type="text"
                               class="form-control input-solid"
                               name="search"
                               value="<?php echo e(Input::get('search')); ?>"
                               placeholder="<?php echo app('translator')->getFromJson('app.search_for_users'); ?>">

                            <span class="input-group-append">
                                <?php if(Input::has('search') && Input::get('search') != ''): ?>
                                    <a href="<?php echo e(route('user.list')); ?>"
                                           class="btn btn-light d-flex align-items-center text-muted"
                                           role="button">
                                        <i class="fas fa-times"></i>
                                    </a>
                                <?php endif; ?>
                                <button class="btn btn-light" type="submit" id="search-users-btn">
                                    <i class="fas fa-search text-muted"></i>
                                </button>
                            </span>
                    </div>
                </div>

                <div class="col-md-2 mt-2 mt-md-0">
                    <?php echo Form::select('status', $statuses, Input::get('status'), ['id' => 'status', 'class' => 'form-control input-solid']); ?>

                </div>

                <div class="col-md-6">
                    <a href="<?php echo e(route('user.create')); ?>" class="btn btn-primary btn-rounded float-right">
                        <i class="fas fa-plus mr-2"></i>
                        <?php echo app('translator')->getFromJson('app.add_user'); ?>
                    </a>
                </div>
            </div>
        </form>

        <div class="table-responsive" id="users-table-wrapper">
            <table class="table table-borderless table-striped">
                <thead>
                <tr>
                    <th></th>
                    <th class="min-width-80"><?php echo app('translator')->getFromJson('app.username'); ?></th>
                    <th class="min-width-150"><?php echo app('translator')->getFromJson('app.full_name'); ?></th>
                    <th class="min-width-100"><?php echo app('translator')->getFromJson('app.email'); ?></th>
                    <th class="min-width-80"><?php echo app('translator')->getFromJson('app.registration_date'); ?></th>
                    <th class="min-width-80"><?php echo app('translator')->getFromJson('app.status'); ?></th>
                    <th class="text-center min-width-150"><?php echo app('translator')->getFromJson('app.action'); ?></th>
                </tr>
                </thead>
                <tbody>
                    <?php if(count($users)): ?>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('user.partials.row', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7"><em><?php echo app('translator')->getFromJson('app.no_records_found'); ?></em></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php echo $users->render(); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        $("#status").change(function () {
            $("#users-form").submit();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>