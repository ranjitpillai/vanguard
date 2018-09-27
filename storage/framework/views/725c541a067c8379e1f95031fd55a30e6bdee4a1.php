<?php $__env->startSection('page-title', trans('app.companies')); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-body">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?php echo e($edit ? $company->company_name : trans('app.create_new_company')); ?>

            <!--<small><?php echo e($edit ? trans('app.edit_role_details') : trans('app.role_details')); ?></small> -->
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li><a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->getFromJson('app.home'); ?></a></li>
                    <li><a href="<?php echo e(route('company.index')); ?>"><?php echo app('translator')->getFromJson('app.companies'); ?></a></li>
                    <li class="active"><?php echo e($edit ? trans('app.edit') : trans('app.create')); ?></li>
                </ol>
            </div>
        </h1>
    </div>
</div>

<?php echo $__env->make('partials.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="row">
    <div class="col-lg-8 col-md-12 col-sm-12">
		<?php if($edit): ?>
			<?php echo Form::open(['route' => ['company.update', $company->id], 'method' => 'PUT', 'id' => 'company-form']); ?>

		<?php else: ?>
			<?php echo Form::open(['route' => 'company.store', 'id' => 'company-form']); ?>

		<?php endif; ?>

		<div class="panel panel-default">
			<div class="panel-heading"><?php echo app('translator')->getFromJson('app.company_details_big'); ?></div>
			<div class="panel-body">
				<div class="form-group">
					<label for="name"><?php echo app('translator')->getFromJson('app.company_name'); ?></label>
					<input type="text" class="form-control" id="name"
						   name="company_name" placeholder="<?php echo app('translator')->getFromJson('app.company_name'); ?>" value="<?php echo e($edit ? $company->company_name : old('company_name')); ?>">
				</div>
				
				<div class="form-group">
					<label for="name"><?php echo app('translator')->getFromJson('app.company_details'); ?></label>					
					<textarea name="company_details" class="form-control" placeholder="<?php echo app('translator')->getFromJson('app.company_details'); ?>"><?php echo e($edit ? $company->company_details : old('company_details')); ?></textarea>
				</div>
				
			</div>
		</div>
				
				
		<div class="row">
			<div class="col-md-4">
				<button type="submit" class="btn btn-primary btn-block">
					<i class="fa fa-save"></i>
					<?php echo e($edit ? trans('app.update_company') : trans('app.create_company')); ?>

				</button>
			</div>
		</div>
		<?php echo Form::close(); ?>

	</div>
	<?php if($profile): ?>
	<div class="col-lg-4 col-md-12 col-sm-12">
		<?php echo Form::open(['route' => ['company.update.avatar', $company->id], 'files' => true, 'id' => 'avatar-form']); ?>

		<?php echo $__env->make('company.avatar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo Form::close(); ?>

	</div>
	<?php endif; ?>
</div>

</div></div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    <?php echo HTML::style('assets/css/bootstrap-datetimepicker.min.css'); ?>

    <?php echo HTML::style('assets/plugins/croppie/croppie.css'); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
	<?php echo HTML::script('assets/plugins/croppie/croppie.js'); ?>

    <?php echo HTML::script('assets/js/moment.min.js'); ?>

    <?php echo HTML::script('assets/js/bootstrap-datetimepicker.min.js'); ?>

    <?php echo HTML::script('assets/js/as/btn.js'); ?>

    <?php echo HTML::script('assets/js/as/profile.js'); ?>

    <?php echo JsValidator::formRequest('Vanguard\Http\Requests\Company\CreateCompanyRequest', '#company-form'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>