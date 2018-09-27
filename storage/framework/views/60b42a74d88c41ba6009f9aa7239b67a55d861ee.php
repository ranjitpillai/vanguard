<?php $__env->startSection('page-title', trans('app.companies')); ?>

<?php $__env->startSection('content'); ?>

<?php /* ?><div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            {{ $edit ? $company->company_name : trans('app.create_new_company') }}
            <!--<small>{{ $edit ? trans('app.edit_role_details') : trans('app.role_details') }}</small> -->
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                    @if(!$profile)
                    <li><a href="{{ route('company.index') }}">@lang('app.companies')</a></li>
                    @endif
                    <li class="active">{{ $profile ? trans('app.company_profile') : trans('app.edit') }}</li>
                </ol>
            </div>
        </h1>
    </div>
</div> <?php */ ?>

<?php echo $__env->make('partials.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<!-- Nav tabs -->
<ul class="nav nav-pills mb-4 mt-2" role="tablist">
    <li class="nav-item">
        <a href="#details" aria-controls="details" role="tab" class="nav-link active show" data-toggle="tab">
            <i class="fas fa-info-circle"></i>
            <?php echo app('translator')->getFromJson('app.details'); ?>
        </a>
    </li>
	<li role="presentation">
        <a href="#address_details" aria-controls="address_details" class="nav-link" role="tab" data-toggle="tab">
            <i class="fas fa-address-book"></i>
            <?php echo app('translator')->getFromJson('app.address_details'); ?>
        </a>
    </li>
    <li role="presentation">
        <a href="#social-networks" aria-controls="social-networks" class="nav-link" role="tab" data-toggle="tab">
            <i class="fas fa-share-alt"></i>
            <?php echo app('translator')->getFromJson('app.social_networks'); ?>
        </a>
    </li>
	<li role="presentation">
        <a href="#company-users" aria-controls="company-users" class="nav-link" role="tab" data-toggle="tab">
            <i class="fa fa-users"></i>
            <?php echo app('translator')->getFromJson('app.users_with_this_company'); ?>
        </a>
    </li>
</ul>

<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="details">
        <div class="row">
            <div class="col-lg-8 col-md-7">
                <?php echo Form::open(['route' => ['company.update.details', $company->id], 'method' => 'PUT', 'id' => 'details-form']); ?>

                    <?php echo $__env->make('company.partials.details', ['profile' => $profile? true : false], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo Form::close(); ?>

            </div>
            <div class="col-lg-4 col-md-5">
                <?php echo Form::open(['route' => ['company.update.avatar', $company->id], 'files' => true, 'id' => 'avatar-form']); ?>

                    <?php echo $__env->make('company.partials.avatar', ['updateUrl' => route('company.update.avatar.external', $company->id),'profile' => $profile? true : false], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo Form::close(); ?>

            </div>
        </div>

    </div>

    <div role="tabpanel" class="tab-pane" id="address_details">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <?php echo Form::open(['route' => ['company.update.address_details', $company->id], 'method' => 'PUT', 'id' => 'address-details-form']); ?>

                    <?php echo $__env->make('company.partials.address_details', ['profile' => $profile? true : false], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="social-networks">
        <div class="row">
            <div class="col-md-12">
                <?php echo Form::open(['route' => ['company.update.socials', $company->id]]); ?>

                    <?php echo $__env->make('company.partials.social-networks', ['profile' => $profile? true : false], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="company-users">
        <div class="row">
            <div class="col-md-12">
                <?php echo $__env->make('company.partials.company_users', ['profile' => $profile? true : false, 'company_users' => $company_users], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>
    </div>

    
    
</div>

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

    <?php if($profile): ?>
    <?php echo JsValidator::formRequest('Vanguard\Http\Requests\Company\UpdateCompanyAdminRequest', '#company-form'); ?>

	<?php else: ?>
	<?php echo JsValidator::formRequest('Vanguard\Http\Requests\Company\UpdateCompanyRequest', '#company-form'); ?>	
	<?php echo JsValidator::formRequest('Vanguard\Http\Requests\Company\UpdateAddressDetailsRequest', '#address-details-form'); ?>	
	<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>