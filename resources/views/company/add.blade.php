@extends('layouts.app')

@section('page-title', trans('app.companies'))

@section('content')
<div class="card">
    <div class="card-body">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            {{ $edit ? $company->company_name : trans('app.create_new_company') }}
            <!--<small>{{ $edit ? trans('app.edit_role_details') : trans('app.role_details') }}</small> -->
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                    <li><a href="{{ route('company.index') }}">@lang('app.companies')</a></li>
                    <li class="active">{{ $edit ? trans('app.edit') : trans('app.create') }}</li>
                </ol>
            </div>
        </h1>
    </div>
</div>

@include('partials.messages')

<div class="row">
    <div class="col-lg-8 col-md-12 col-sm-12">
		@if ($edit)
			{!! Form::open(['route' => ['company.update', $company->id], 'method' => 'PUT', 'id' => 'company-form']) !!}
		@else
			{!! Form::open(['route' => 'company.store', 'id' => 'company-form']) !!}
		@endif

		<div class="panel panel-default">
			<div class="panel-heading">@lang('app.company_details_big')</div>
			<div class="panel-body">
				<div class="form-group">
					<label for="name">@lang('app.company_name')</label>
					<input type="text" class="form-control" id="name"
						   name="company_name" placeholder="@lang('app.company_name')" value="{{ $edit ? $company->company_name : old('company_name') }}">
				</div>
				
				<div class="form-group">
					<label for="name">@lang('app.company_details')</label>					
					<textarea name="company_details" class="form-control" placeholder="@lang('app.company_details')">{{ $edit ? $company->company_details : old('company_details') }}</textarea>
				</div>
				
			</div>
		</div>
				
				
		<div class="row">
			<div class="col-md-4">
				<button type="submit" class="btn btn-primary btn-block">
					<i class="fa fa-save"></i>
					{{ $edit ? trans('app.update_company') : trans('app.create_company') }}
				</button>
			</div>
		</div>
		{!! Form::close() !!}
	</div>
	@if ($profile)
	<div class="col-lg-4 col-md-12 col-sm-12">
		{!! Form::open(['route' => ['company.update.avatar', $company->id], 'files' => true, 'id' => 'avatar-form']) !!}
		@include('company.avatar')
		{!! Form::close() !!}
	</div>
	@endif
</div>

</div></div>
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
    {!! JsValidator::formRequest('Vanguard\Http\Requests\Company\CreateCompanyRequest', '#company-form') !!}
@stop