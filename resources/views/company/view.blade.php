@extends('layouts.app')

@section('page-title', $company->company_name)

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            {{ $company->company_name }}
            <!--<small>@lang('app.company_details')</small> -->
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                    <li><a href="{{ route('company.profile.view') }}">@lang('app.company_profile')</a></li>
                    <li class="active">{{ $company->company_name }}</li>
                </ol>
            </div>

        </h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-md-5">
        <div id="edit-user-panel" class="panel panel-default">
            <div class="panel-heading">
                @lang('app.details')
            </div>
            <div class="panel-body panel-profile">
                <div class="image">
                    <img alt="image" class="img-circle avatar" src="{{ url('upload/companies/'.$company->avatar) }}">
                </div>
                <div class="name"><strong>{{ $company->company_name }}</strong></div>
			</div>
        </div>
    </div>
	<div class="col-lg-8 col-md-7">
        <div id="edit-user-panel" class="panel panel-default">
            <div class="panel-heading">
                @lang('app.details')
            </div>
            <div class="panel-body panel-profile">
                
                <table class="table table-hover table-details">
                    <thead>
                        <tr>
                            <th colspan="3">@lang('app.contact_informations')</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>@lang('app.company_code')</td>
                            <td><a>{{ $company->company_code }}</a></td>
                        </tr>
                        @if ($company->company_phone)
                            <tr>
                                <td>@lang('app.phone')</td>
                                <td><a href="telto:{{ $company->company_phone }}">{{ $company->company_phone }}</a></td>
                            </tr>
                        @endif

                    </tbody>
                </table>

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th colspan="3">@lang('app.additional_informations')</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>@lang('app.company_website')</td>
                        <td>{{ $company->company_website }}</td>
                    </tr>
					
					<tr>
                        <td>@lang('app.company_fax')</td>
                        <td>{{ $company->company_fax }}</td>
                    </tr>
                    <tr>
                        <td>@lang('app.address')</td>
                        <td>{{ $company->company_address }}</td>
                    </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
	
</div>

@stop