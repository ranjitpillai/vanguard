<div class="panel panel-default">
    <div class="panel-heading"><?php echo app('translator')->getFromJson('app.users_with_this_company'); ?></div>
    <div class="panel-body">
        <div class="row">
			<div class="table-responsive table-hover" id="users-table-wrapper">
				<table class="table">
					<thead>
						<th><?php echo app('translator')->getFromJson('app.full_name'); ?></th>
						<th><?php echo app('translator')->getFromJson('app.registration_date'); ?></th>
						<th><?php echo app('translator')->getFromJson('app.email'); ?></th>
						<th><?php echo app('translator')->getFromJson('app.status'); ?></th>
						<th class="text-center"><?php echo app('translator')->getFromJson('app.action'); ?></th>
						</thead>
					<tbody>
					<?php if(count($company_users)): ?>
						<?php $__currentLoopData = $company_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></td>
								<td><?php echo e($user->created_at->format('Y-m-d')); ?></td>
								<td><?php echo e($user->email); ?></td>
								<td> 
								<?php 
									$class = "success";
									if($user->status == "Banned"){
										$class="danger";
									}
									if($user->status == "Unconfirmed"){
										$class="warning";
									}
								?>
								<span class="label label-<?php echo e($class); ?>"><?php echo e(trans("app.{$user->status}")); ?></span>
								</td>
								
								<td class="text-center">
									 <a href="<?php echo e(route('user.show', $user->id)); ?>" class="btn btn-success btn-circle" title="<?php echo app('translator')->getFromJson('app.view_user'); ?>" data-toggle="tooltip" data-placement="top">
										<i class="glyphicon glyphicon-eye-open"></i>
									</a>
									<a href="<?php echo e(route('user.edit', $user->id)); ?>" class="btn btn-primary btn-circle"
									   title="<?php echo app('translator')->getFromJson('app.edit_user'); ?>" data-toggle="tooltip" data-placement="top">
										<i class="glyphicon glyphicon-edit"></i>
									</a>
									<a href="<?php echo e(route('user.delete', $user->id)); ?>" class="btn btn-danger btn-circle"
									   title="<?php echo app('translator')->getFromJson('app.delete_user'); ?>"
									   data-toggle="tooltip"
									   data-placement="top"
									   data-method="DELETE"
									   data-confirm-title="<?php echo app('translator')->getFromJson('app.please_confirm'); ?>"
									   data-confirm-text="<?php echo app('translator')->getFromJson('app.are_you_sure_delete_user'); ?>"
									   data-confirm-delete="<?php echo app('translator')->getFromJson('app.yes_delete_it'); ?>">
										<i class="glyphicon glyphicon-trash"></i>
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
</div>