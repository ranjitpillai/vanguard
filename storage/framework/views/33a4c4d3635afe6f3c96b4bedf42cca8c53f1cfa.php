<?php $__env->startSection('page-title', trans('app.roles')); ?>
<?php $__env->startSection('page-heading', trans('app.roles')); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <li class="breadcrumb-item active">
        <?php echo app('translator')->getFromJson('app.roles'); ?>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('partials.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="card">
        <div class="card-body">
            <div class="row mb-3 pb-3 border-bottom-light">
                <div class="col-lg-12">
                    <div class="float-right">
                        <a href="<?php echo e(route('role.create')); ?>" class="btn btn-primary btn-rounded">
                            <i class="fas fa-plus mr-2"></i>
                            <?php echo app('translator')->getFromJson('app.add_role'); ?>
                        </a>
                    </div>
                </div>
            </div>

            <div class="table-responsive" id="users-table-wrapper">
                <table class="table table-striped table-borderless">
                    <thead>
                    <tr>
                        <th class="min-width-100"><?php echo app('translator')->getFromJson('app.name'); ?></th>
                        <th class="min-width-150"><?php echo app('translator')->getFromJson('app.display_name'); ?></th>
                        <th class="min-width-150"><?php echo app('translator')->getFromJson('app.users_with_this_role'); ?></th>
                        <th class="text-center"><?php echo app('translator')->getFromJson('app.action'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php if(count($roles)): ?>
                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($role->name); ?></td>
                                    <td><?php echo e($role->display_name); ?></td>
                                    <td><?php echo e($role->users_count); ?></td>
                                    <td class="text-center">
                                        <a href="<?php echo e(route('role.edit', $role->id)); ?>" class="btn btn-icon"
                                           title="<?php echo app('translator')->getFromJson('app.edit_role'); ?>" data-toggle="tooltip" data-placement="top">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <?php if($role->removable): ?>
                                            <a href="<?php echo e(route('role.delete', $role->id)); ?>" class="btn btn-icon"
                                               title="<?php echo app('translator')->getFromJson('app.delete_role'); ?>"
                                               data-toggle="tooltip"
                                               data-placement="top"
                                               data-method="DELETE"
                                               data-confirm-title="<?php echo app('translator')->getFromJson('app.please_confirm'); ?>"
                                               data-confirm-text="<?php echo app('translator')->getFromJson('app.are_you_sure_delete_role'); ?>"
                                               data-confirm-delete="<?php echo app('translator')->getFromJson('app.yes_delete_it'); ?>">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4"><em><?php echo app('translator')->getFromJson('app.no_records_found'); ?></em></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>