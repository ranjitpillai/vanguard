<?php $__env->startSection('page-title', trans('app.devices')); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?php echo app('translator')->getFromJson('app.devices'); ?>
                <small><?php echo app('translator')->getFromJson('app.available_system_devices'); ?></small>
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->getFromJson('app.home'); ?></a></li>
                        <li class="active"><?php echo app('translator')->getFromJson('app.devices'); ?></li>
                    </ol>
                </div>
            </h1>
        </div>
    </div>

    <?php echo $__env->make('partials.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

   <!-- <div class="row tab-search">
        <div class="col-md-2">
            <a href="<?php echo e(route('company.create')); ?>" class="btn btn-success">
                <i class="glyphicon glyphicon-plus"></i>
                <?php echo app('translator')->getFromJson('app.add_company'); ?>
            </a>
        </div>
    </div>
-->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
        <a href="#active-devices" aria-controls="active-devices" role="tab" data-toggle="tab">
            <i class="glyphicon glyphicon-th"></i>
            <?php echo app('translator')->getFromJson('app.active_devices'); ?>
        </a>
    </li>
	<li role="presentation">
        <a href="#deactive-devices" aria-controls="deactive-devices" role="tab" data-toggle="tab">
            <i class="glyphicon glyphicon-th"></i>
            <?php echo app('translator')->getFromJson('app.deactive_devices'); ?>
        </a>
    </li>
    
</ul>

<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="active-devices">
        <div class="row">
            <div class="table-responsive table-hover" id="users-table-wrapper">
				<table class="table">
					<thead>
						<th><?php echo app('translator')->getFromJson('app.phone_number'); ?></th>
						<th><?php echo app('translator')->getFromJson('app.device_number'); ?></th>
						<th><?php echo app('translator')->getFromJson('app.registration_date'); ?></th>
						<th><?php echo app('translator')->getFromJson('app.status'); ?></th>
						<th class="text-center"><?php echo app('translator')->getFromJson('app.action'); ?></th>
					</thead>
					<tbody>
					<?php if(count($active_devices)): ?>
						<?php $__currentLoopData = $active_devices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $device): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td><?php echo e($device->phone_number); ?></td>
								<td><?php echo e($device->device_id); ?></td>
								<td><?php echo e($device->created_at); ?></td>
								<td><span class="label label-<?php echo e(($device->status == 'Active')?'success':'danger'); ?>"><?php echo e(trans("app.{$device->status}")); ?></span></td>
								<td class="text-center">
									<a href="<?php echo e(route('device.view', $device->id)); ?>" class="btn btn-primary btn-circle"
									   title="<?php echo app('translator')->getFromJson('app.view_device'); ?>" data-toggle="tooltip" data-placement="top">
										<i class="glyphicon glyphicon-eye-open"></i>
									</a>
									<?php if($device->status == 'Active'): ?>
									<a href="<?php echo e(route('device.delete', $device->id)); ?>" class="btn btn-danger btn-circle"
									   title="<?php echo app('translator')->getFromJson('app.disable_device'); ?>"
									   data-toggle="tooltip"
									   data-placement="top"
									   data-method="DELETE"
									   data-confirm-title="<?php echo app('translator')->getFromJson('app.please_confirm'); ?>"
									   data-confirm-text="<?php echo app('translator')->getFromJson('app.are_you_sure_disable_device'); ?>"
									   data-confirm-delete="<?php echo app('translator')->getFromJson('app.yes_disable_it'); ?>">
										<i class="glyphicon glyphicon-remove"></i>
									</a>
									<?php else: ?>
									<a href="<?php echo e(route('device.activate', $device->id)); ?>" class="btn btn-success btn-circle"
									   title="<?php echo app('translator')->getFromJson('app.activate_device'); ?>"
									   data-toggle="tooltip"
									   data-placement="top"
									   data-method="DELETE"
									   data-confirm-title="<?php echo app('translator')->getFromJson('app.please_confirm'); ?>"
									   data-confirm-text="<?php echo app('translator')->getFromJson('app.are_you_sure_activate_device'); ?>"
									   data-confirm-delete="<?php echo app('translator')->getFromJson('app.yes_activate_it'); ?>">
										<i class="glyphicon glyphicon-ok"></i>
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
    <div role="tabpanel" class="tab-pane" id="deactive-devices">
        <div class="row">
            <div class="table-responsive table-hover" id="users-table-wrapper">
				<table class="table">
					<thead>
						<th><?php echo app('translator')->getFromJson('app.phone_number'); ?></th>
						<th><?php echo app('translator')->getFromJson('app.device_number'); ?></th>
						<th><?php echo app('translator')->getFromJson('app.registration_date'); ?></th>
						<th><?php echo app('translator')->getFromJson('app.status'); ?></th>
						<th class="text-center"><?php echo app('translator')->getFromJson('app.action'); ?></th>
					</thead>
					<tbody>
					<?php if(count($deactive_devices)): ?>
						<?php $__currentLoopData = $deactive_devices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $device): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td><?php echo e($device->phone_number); ?></td>
								<td><?php echo e($device->device_id); ?></td>
								<td><?php echo e($device->created_at); ?></td>
								<td><span class="label label-<?php echo e(($device->status == 'Active')?'success':'danger'); ?>"><?php echo e(trans("app.{$device->status}")); ?></span></td>
								<td class="text-center">
									<a href="<?php echo e(route('device.view', $device->id)); ?>" class="btn btn-primary btn-circle"
									   title="<?php echo app('translator')->getFromJson('app.view_device'); ?>" data-toggle="tooltip" data-placement="top">
										<i class="glyphicon glyphicon-eye-open"></i>
									</a>
									<?php if($device->status == 'Active'): ?>
									<a href="<?php echo e(route('device.delete', $device->id)); ?>" class="btn btn-danger btn-circle"
									   title="<?php echo app('translator')->getFromJson('app.disable_device'); ?>"
									   data-toggle="tooltip"
									   data-placement="top"
									   data-method="DELETE"
									   data-confirm-title="<?php echo app('translator')->getFromJson('app.please_confirm'); ?>"
									   data-confirm-text="<?php echo app('translator')->getFromJson('app.are_you_sure_disable_device'); ?>"
									   data-confirm-delete="<?php echo app('translator')->getFromJson('app.yes_disable_it'); ?>">
										<i class="glyphicon glyphicon-remove"></i>
									</a>
									<?php else: ?>
									<a href="<?php echo e(route('device.activate', $device->id)); ?>" class="btn btn-success btn-circle"
									   title="<?php echo app('translator')->getFromJson('app.activate_device'); ?>"
									   data-toggle="tooltip"
									   data-placement="top"
									   data-method="DELETE"
									   data-confirm-title="<?php echo app('translator')->getFromJson('app.please_confirm'); ?>"
									   data-confirm-text="<?php echo app('translator')->getFromJson('app.are_you_sure_activate_device'); ?>"
									   data-confirm-delete="<?php echo app('translator')->getFromJson('app.yes_activate_it'); ?>">
										<i class="glyphicon glyphicon-ok"></i>
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
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>