@extends('layouts.app')

@section('page-title', trans('app.companies'))
@section('breadcrumbs')
    @if (isset($user) && isset($adminView))
        <li class="breadcrumb-item">
            <a href="{{ route('company.index') }}">@lang('app.companies')</a>
        </li>
        <li class="breadcrumb-item active">
            {{ $user->present()->nameOrEmail }}
        </li>
    @else
        <li class="breadcrumb-item active">
            @lang('app.companies')
        </li>
    @endif
@stop
@section('content')
	<div class="card">
    <div class="card-body">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                @lang('app.companies')
                <small>@lang('app.available_system_companies')</small>
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                        <li class="active">@lang('app.companies')</li>
                    </ol>
                </div>

            </h1>
        </div>
    </div>

    @include('partials.messages')

    <div class="row tab-search">
        <div class="col-md-2">
            <a href="{{ route('company.create') }}" class="btn btn-success">
                <i class="glyphicon glyphicon-plus"></i>
                @lang('app.add_company')
            </a>
        </div>
    </div>


    <div class="table-responsive table-hover" id="users-table-wrapper">
        <table class="table">
            <thead>
                <th>@lang('app.company_name')</th>
                <th>@lang('app.company_code')</th>
                <th>@lang('app.company_phone')</th>
                <th>@lang('app.company_fax')</th>
                <th>@lang('app.users_with_this_company')</th>
                <th class="text-center">@lang('app.action')</th>
                </thead>
            <tbody>
            @if (count($companies))
                @foreach ($companies as $company)
                    <tr>
                        <td>{{ $company->company_name }}</td>
                        <td>{{ $company->company_code }}</td>
                        <td>{{ $company->company_phone }}</td>
                        <td>{{ $company->company_fax }}</td>
                        <td>
						@if($company->users_count > 0)
							<a href="{{URL('company/'.$company->id.'/users')}}">{{ $company->users_count }} user(s)</a>
						@else
							{{ $company->users_count }} user(s)
						@endif
						</td>
                        <td class="text-center">
                            <a href="{{ route('company.edit', $company->id) }}" class="btn btn-primary btn-circle"
                               title="@lang('app.edit_company')" data-toggle="tooltip" data-placement="top">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('company.delete', $company->id) }}" class="btn btn-danger btn-circle"
							   title="@lang('app.delete_company')"
							   data-toggle="tooltip"
							   data-placement="top"
							   data-method="DELETE"
							   data-confirm-title="@lang('app.please_confirm')"
							   data-confirm-text="@lang('app.are_you_sure_delete_company')"
							   data-confirm-delete="@lang('app.yes_delete_it')">
								<i class="fas fa-trash"></i>
							</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4"><em>@lang('app.no_records_found')</em></td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
	</div>
	</div>

@stop
