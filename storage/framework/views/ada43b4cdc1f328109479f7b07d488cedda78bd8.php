<?php $__env->startSection('page-title', trans('app.transactions')); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?php echo app('translator')->getFromJson('app.transactions'); ?>
                <small><?php echo app('translator')->getFromJson('app.available_system_transactions'); ?></small>
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->getFromJson('app.home'); ?></a></li>
                        <li class="active"><?php echo app('translator')->getFromJson('app.transactions'); ?></li>
                    </ol>
                </div>
            </h1>
        </div>
    </div>

    <?php echo $__env->make('partials.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
	<div class="row tab-search">
		
		<form method="GET" action="" accept-charset="UTF-8" id="users-form">
			<div class="col-md-3">
				<?php echo Form::select('transaction_type', $transaction_type, Input::get('transaction_type'), ['id' => 'transaction_type', 'class' => 'form-control']); ?>

			</div>
			<div class="col-md-2">
				<?php echo Form::select('device_number', $device_number, Input::get('device_number'), ['id' => 'device_number', 'class' => 'form-control']); ?>

			</div>
			<div class="col-md-3">
				<input type="text" class="form-control" name="search_date" value="<?php echo e(Input::get('search_date')); ?>" placeholder="<?php echo app('translator')->getFromJson('app.search_for_registered_date'); ?>">
					
			</div>
			<div class="col-md-3">
				<input type="text" class="form-control" name="search_phone" value="<?php echo e(Input::get('search_phone')); ?>" placeholder="<?php echo app('translator')->getFromJson('app.search_for_phone_number'); ?>">
					
			</div>
			<div class="col-md-1">
				 <?php if((Input::has('search_phone') && Input::get('search_phone') != '') ||(Input::has('search_date') && Input::get('search_date') != '') ||(Input::has('device_number') && Input::get('device_number') != '') ||(Input::has('transaction_type') && Input::get('transaction_type') != '')): ?>
					<a href="<?php echo e(route('transaction.index')); ?>" class="btn btn-danger" type="button" >
						<span class="glyphicon glyphicon-remove"></span>
					</a>
				<?php else: ?> 
				
				<button type="submit" class="btn btn-primary">
                <i class="fa fa-search"></i>
				<?php endif; ?>
            </button>
			</div>
		</form>
	</div>

    <div class="table-responsive table-hover" id="users-table-wrapper">
        <table class="table">
            <thead>
				<th><?php echo app('translator')->getFromJson('app.transaction_type'); ?></th>
				<th><?php echo app('translator')->getFromJson('app.device_number'); ?></th>
				<th><?php echo app('translator')->getFromJson('app.phone_number'); ?></th>
				<th><?php echo app('translator')->getFromJson('app.charge'); ?></th>
				<th><?php echo app('translator')->getFromJson('app.service_type'); ?></th>
				<th><?php echo app('translator')->getFromJson('app.registration_date'); ?></th>
				<th class="text-center"><?php echo app('translator')->getFromJson('app.action'); ?></th>
			</thead>
            <tbody>
            <?php if(count($transactions)): ?>
                <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                       <td><?php echo e($transaction->transaction_type); ?></td>
						<td><?php echo e($transaction->device_id); ?></td>
						<td><?php echo e($transaction->phone_number); ?></td>
						<td><?php echo e($transaction->charge); ?></td>
						<td><?php echo e($transaction->service_type); ?></td>
						<td><?php echo e($transaction->created_at); ?></td>
                        
                        <td class="text-center">
                            <a href="<?php echo e(route('transaction.view', $transaction->id)); ?>" class="btn btn-primary btn-circle"
                               title="<?php echo app('translator')->getFromJson('app.view_transaction'); ?>" data-toggle="tooltip" data-placement="top">
                                <i class="glyphicon glyphicon-eye-open"></i>
                            </a>
                           
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <tr>
					<td colspan="7"><em><?php echo app('translator')->getFromJson('app.no_records_found'); ?></em></td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
	
    <?php echo HTML::style('assets/css/custom.css'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>