<?php $__env->startSection('page-title', trans('app.companies')); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <?php if(isset($user) && isset($adminView)): ?>
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('company.index')); ?>"><?php echo app('translator')->getFromJson('app.companies'); ?></a>
        </li>
        <li class="breadcrumb-item active">
            <?php echo e($user->present()->nameOrEmail); ?>

        </li>
    <?php else: ?>
        <li class="breadcrumb-item active">
            <?php echo app('translator')->getFromJson('app.companies'); ?>
        </li>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
	<div class="card">
    <div class="card-body">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?php echo app('translator')->getFromJson('app.companies'); ?>
                <small><?php echo app('translator')->getFromJson('app.available_system_companies'); ?></small>
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->getFromJson('app.home'); ?></a></li>
                        <li class="active"><?php echo app('translator')->getFromJson('app.companies'); ?></li>
                    </ol>
                </div>

            </h1>
        </div>
    </div>

    <?php echo $__env->make('partials.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="row tab-search">
        <div class="col-md-2">
            <a href="<?php echo e(route('company.create')); ?>" class="btn btn-success">
                <i class="glyphicon glyphicon-plus"></i>
                <?php echo app('translator')->getFromJson('app.add_company'); ?>
            </a>
        </div>
    </div>


    <div class="table-responsive table-hover" id="users-table-wrapper">
        <table class="table">
            <thead>
                <th><?php echo app('translator')->getFromJson('app.company_name'); ?></th>
                <th><?php echo app('translator')->getFromJson('app.company_code'); ?></th>
                <th><?php echo app('translator')->getFromJson('app.company_phone'); ?></th>
                <th><?php echo app('translator')->getFromJson('app.company_fax'); ?></th>
                <th><?php echo app('translator')->getFromJson('app.users_with_this_company'); ?></th>
                <th class="text-center"><?php echo app('translator')->getFromJson('app.action'); ?></th>
                </thead>
            <tbody>
            <?php if(count($companies)): ?>
                <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($company->company_name); ?></td>
                        <td><?php echo e($company->company_code); ?></td>
                        <td><?php echo e($company->company_phone); ?></td>
                        <td><?php echo e($company->company_fax); ?></td>
                        <td>
						<?php if($company->users_count > 0): ?>
							<a href="<?php echo e(URL('company/'.$company->id.'/users')); ?>"><?php echo e($company->users_count); ?> user(s)</a>
						<?php else: ?>
							<?php echo e($company->users_count); ?> user(s)
						<?php endif; ?>
						</td>
                        <td class="text-center">
                            <a href="<?php echo e(route('company.edit', $company->id)); ?>" class="btn btn-primary btn-circle"
                               title="<?php echo app('translator')->getFromJson('app.edit_company'); ?>" data-toggle="tooltip" data-placement="top">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?php echo e(route('company.delete', $company->id)); ?>" class="btn btn-danger btn-circle"
							   title="<?php echo app('translator')->getFromJson('app.delete_company'); ?>"
							   data-toggle="tooltip"
							   data-placement="top"
							   data-method="DELETE"
							   data-confirm-title="<?php echo app('translator')->getFromJson('app.please_confirm'); ?>"
							   data-confirm-text="<?php echo app('translator')->getFromJson('app.are_you_sure_delete_company'); ?>"
							   data-confirm-delete="<?php echo app('translator')->getFromJson('app.yes_delete_it'); ?>">
								<i class="fas fa-trash"></i>
							</a>
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