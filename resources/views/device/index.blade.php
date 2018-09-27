@extends('layouts.app')

@section('page-title', trans('app.devices'))

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                @lang('app.devices')
                <small>@lang('app.available_system_devices')</small>
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                        <li class="active">@lang('app.devices')</li>
                    </ol>
                </div>
            </h1>
        </div>
    </div>

    @include('partials.messages')

   <!-- <div class="row tab-search">
        <div class="col-md-2">
            <a href="{{ route('company.create') }}" class="btn btn-success">
                <i class="glyphicon glyphicon-plus"></i>
                @lang('app.add_company')
            </a>
        </div>
    </div>
-->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
        <a href="#active-devices" aria-controls="active-devices" role="tab" data-toggle="tab">
            <i class="glyphicon glyphicon-th"></i>
            @lang('app.active_devices')
        </a>
    </li>
	<li role="presentation">
        <a href="#deactive-devices" aria-controls="deactive-devices" role="tab" data-toggle="tab">
            <i class="glyphicon glyphicon-th"></i>
            @lang('app.deactive_devices')
        </a>
    </li>
    
</ul>

<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="active-devices">
        <div class="row">
            <div class="table-responsive table-hover" id="users-table-wrapper">
				<table class="table">
					<thead>
						<th>@lang('app.phone_number')</th>
						<th>@lang('app.device_number')</th>
						<th>@lang('app.registration_date')</th>
						<th>@lang('app.status')</th>
						<th class="text-center">@lang('app.action')</th>
					</thead>
					<tbody>
					@if (count($active_devices))
						@foreach ($active_devices as $device)
							<tr>
								<td>{{ $device->phone_number }}</td>
								<td>{{ $device->device_id }}</td>
								<td>{{ $device->created_at }}</td>
								<td><span class="label label-{{ ($device->status == 'Active')?'success':'danger' }}">{{ trans("app.{$device->status}") }}</span></td>
								<td class="text-center">
									<a href="{{ route('device.view', $device->id) }}" class="btn btn-primary btn-circle"
									   title="@lang('app.view_device')" data-toggle="tooltip" data-placement="top">
										<i class="glyphicon glyphicon-eye-open"></i>
									</a>
									@if($device->status == 'Active')
									<a href="{{ route('device.delete', $device->id) }}" class="btn btn-danger btn-circle"
									   title="@lang('app.disable_device')"
									   data-toggle="tooltip"
									   data-placement="top"
									   data-method="DELETE"
									   data-confirm-title="@lang('app.please_confirm')"
									   data-confirm-text="@lang('app.are_you_sure_disable_device')"
									   data-confirm-delete="@lang('app.yes_disable_it')">
										<i class="glyphicon glyphicon-remove"></i>
									</a>
									@else
									<a href="{{ route('device.activate', $device->id) }}" class="btn btn-success btn-circle"
									   title="@lang('app.activate_device')"
									   data-toggle="tooltip"
									   data-placement="top"
									   data-method="DELETE"
									   data-confirm-title="@lang('app.please_confirm')"
									   data-confirm-text="@lang('app.are_you_sure_activate_device')"
									   data-confirm-delete="@lang('app.yes_activate_it')">
										<i class="glyphicon glyphicon-ok"></i>
									</a>
									@endif
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
    <div role="tabpanel" class="tab-pane" id="deactive-devices">
        <div class="row">
            <div class="table-responsive table-hover" id="users-table-wrapper">
				<table class="table">
					<thead>
						<th>@lang('app.phone_number')</th>
						<th>@lang('app.device_number')</th>
						<th>@lang('app.registration_date')</th>
						<th>@lang('app.status')</th>
						<th class="text-center">@lang('app.action')</th>
					</thead>
					<tbody>
					@if (count($deactive_devices))
						@foreach ($deactive_devices as $device)
							<tr>
								<td>{{ $device->phone_number }}</td>
								<td>{{ $device->device_id }}</td>
								<td>{{ $device->created_at }}</td>
								<td><span class="label label-{{ ($device->status == 'Active')?'success':'danger' }}">{{ trans("app.{$device->status}") }}</span></td>
								<td class="text-center">
									<a href="{{ route('device.view', $device->id) }}" class="btn btn-primary btn-circle"
									   title="@lang('app.view_device')" data-toggle="tooltip" data-placement="top">
										<i class="glyphicon glyphicon-eye-open"></i>
									</a>
									@if($device->status == 'Active')
									<a href="{{ route('device.delete', $device->id) }}" class="btn btn-danger btn-circle"
									   title="@lang('app.disable_device')"
									   data-toggle="tooltip"
									   data-placement="top"
									   data-method="DELETE"
									   data-confirm-title="@lang('app.please_confirm')"
									   data-confirm-text="@lang('app.are_you_sure_disable_device')"
									   data-confirm-delete="@lang('app.yes_disable_it')">
										<i class="glyphicon glyphicon-remove"></i>
									</a>
									@else
									<a href="{{ route('device.activate', $device->id) }}" class="btn btn-success btn-circle"
									   title="@lang('app.activate_device')"
									   data-toggle="tooltip"
									   data-placement="top"
									   data-method="DELETE"
									   data-confirm-title="@lang('app.please_confirm')"
									   data-confirm-text="@lang('app.are_you_sure_activate_device')"
									   data-confirm-delete="@lang('app.yes_activate_it')">
										<i class="glyphicon glyphicon-ok"></i>
									</a>
									@endif
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
</div>


@stop
