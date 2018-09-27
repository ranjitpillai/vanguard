@extends('layouts.app')

@section('page-title', trans('app.companies'))

@section('content')

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

@include('partials.messages')

<!-- Nav tabs -->
<ul class="nav nav-pills mb-4 mt-2" role="tablist">
    <li class="nav-item">
        <a href="#details" aria-controls="details" role="tab" class="nav-link active show" data-toggle="tab">
            <i class="fas fa-info-circle"></i>
            @lang('app.details')
        </a>
    </li>
	<li role="presentation">
        <a href="#address_details" aria-controls="address_details" class="nav-link" role="tab" data-toggle="tab">
            <i class="fas fa-address-book"></i>
            @lang('app.address_details')
        </a>
    </li>
    <li role="presentation">
        <a href="#social-networks" aria-controls="social-networks" class="nav-link" role="tab" data-toggle="tab">
            <i class="fas fa-share-alt"></i>
            @lang('app.social_networks')
        </a>
    </li>
	<li role="presentation">
        <a href="#company-users" aria-controls="company-users" class="nav-link" role="tab" data-toggle="tab">
            <i class="fa fa-users"></i>
            @lang('app.users_with_this_company')
        </a>
    </li>
</ul>

<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="details">
        <div class="row">
            <div class="col-lg-8 col-md-7">
                {!! Form::open(['route' => ['company.update.details', $company->id], 'method' => 'PUT', 'id' => 'details-form']) !!}
                    @include('company.partials.details', ['profile' => $profile? true : false])
                {!! Form::close() !!}
            </div>
            <div class="col-lg-4 col-md-5">
                {!! Form::open(['route' => ['company.update.avatar', $company->id], 'files' => true, 'id' => 'avatar-form']) !!}
                    @include('company.partials.avatar', ['updateUrl' => route('company.update.avatar.external', $company->id),'profile' => $profile? true : false])
                {!! Form::close() !!}
            </div>
        </div>

    </div>

    <div role="tabpanel" class="tab-pane" id="address_details">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                {!! Form::open(['route' => ['company.update.address_details', $company->id], 'method' => 'PUT', 'id' => 'address-details-form']) !!}
                    @include('company.partials.address_details', ['profile' => $profile? true : false])
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="social-networks">
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['route' => ['company.update.socials', $company->id]]) !!}
                    @include('company.partials.social-networks', ['profile' => $profile? true : false])
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="company-users">
        <div class="row">
            <div class="col-md-12">
                @include('company.partials.company_users', ['profile' => $profile? true : false, 'company_users' => $company_users])
            </div>
        </div>
    </div>

    
    
</div>

@stop

@section('styles')
	
    {!! HTML::style('assets/css/bootstrap-datetimepicker.min.css') !!}
    {!! HTML::style('assets/plugins/croppie/croppie.css') !!}
@stop


@section('scripts')
	{!! HTML::script('assets/plugins/croppie/croppie.js') !!}
    {!! HTML::script('assets/js/moment.min.js') !!}
    {!! HTML::script('assets/js/bootstrap-datetimepicker.min.js') !!}
    {!! HTML::script('assets/js/as/btn.js') !!}
    {!! HTML::script('assets/js/as/profile.js') !!}
    @if($profile)
    {!! JsValidator::formRequest('Vanguard\Http\Requests\Company\UpdateCompanyAdminRequest', '#company-form') !!}
	@else
	{!! JsValidator::formRequest('Vanguard\Http\Requests\Company\UpdateCompanyRequest', '#company-form') !!}	
	{!! JsValidator::formRequest('Vanguard\Http\Requests\Company\UpdateAddressDetailsRequest', '#address-details-form') !!}	
	@endif
@stop