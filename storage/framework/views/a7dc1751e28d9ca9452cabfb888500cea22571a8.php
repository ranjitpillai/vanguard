<?php $__env->startSection('page-title', trans('app.permissions')); ?>
<?php $__env->startSection('page-heading', trans('app.permissions')); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <li class="breadcrumb-item active">
        <?php echo app('translator')->getFromJson('app.permissions'); ?>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('partials.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo Form::open(['route' => 'permission.save', 'class' => 'mb-4']); ?>


<div class="card">
    <div class="card-body">

        <div class="row mb-3 pb-3 border-bottom-light">
            <div class="col-lg-12">
                <div class="float-right">
                    <a href="<?php echo e(route('permission.create')); ?>" class="btn btn-primary btn-rounded">
                        <i class="fas fa-plus mr-2"></i>
                        <?php echo app('translator')->getFromJson('app.add_permission'); ?>
                    </a>
                </div>
            </div>
        </div>

        <div class="table-responsive" id="users-table-wrapper">
            <table class="table table-striped table-borderless">
                <thead>
                    <tr>
                        <th class="min-width-200"><?php echo app('translator')->getFromJson('app.name'); ?></th>
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th class="text-center"><?php echo e($role->display_name); ?></th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <th class="text-center min-width-100"><?php echo app('translator')->getFromJson('app.action'); ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php if(count($permissions)): ?>
                    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($permission->display_name ?: $permission->name); ?></td>

                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <td class="text-center">
                                    <div class="custom-control custom-checkbox">
                                        <?php echo Form::checkbox(
                                                "roles[{$role->id}][]",
                                                $permission->id,
                                                $role->hasPermission($permission->name),
                                                [
                                                    'class' => 'custom-control-input',
                                                    'id' => "cb-{$role->id}-{$permission->id}"
                                                ]
                                            ); ?>

                                        <label class="custom-control-label d-inline"
                                               for="cb-<?php echo e($role->id); ?>-<?php echo e($permission->id); ?>"></label>
                                    </div>
                                </td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <td class="text-center">
                                <a href="<?php echo e(route('permission.edit', $permission->id)); ?>" class="btn btn-icon"
                                   title="<?php echo app('translator')->getFromJson('app.edit_permission'); ?>" data-toggle="tooltip" data-placement="top">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <?php if($permission->removable): ?>
                                    <a href="<?php echo e(route('permission.destroy', $permission->id)); ?>" class="btn btn-icon"
                                       title="<?php echo app('translator')->getFromJson('app.delete_permission'); ?>"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       data-method="DELETE"
                                       data-confirm-title="<?php echo app('translator')->getFromJson('app.please_confirm'); ?>"
                                       data-confirm-text="<?php echo app('translator')->getFromJson('app.are_you_sure_delete_permission'); ?>"
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

<?php if(count($permissions)): ?>
    <div class="row">
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary"><?php echo app('translator')->getFromJson('app.save_permissions'); ?></button>
        </div>
    </div>
<?php endif; ?>

<?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>