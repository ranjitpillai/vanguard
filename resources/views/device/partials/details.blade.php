<div class="panel panel-default">
    <div class="panel-heading">
		@lang('app.device_details')
		<a class="btn btn-{{ ($device->status == 'Active')?'success':'danger' }} btn-xs pull-right">{{ trans("app.{$device->status}") }}</a>
	</div>
    <div class="panel-body">
		<div class="col-sm-6">
			<table class="table user-activity">
				<tbody>
					<tr>
						<th>@lang('app.description')</th>
						<td>{{ $device->description }}</td>
					</tr>
					<tr>
						<th>@lang('app.IMEI')</th>
						<td>{{ $device->IMEI }}</td>
					</tr>
					<tr>
						<th>@lang('app.phone_number')</th>
						<td>{{ $device->phone_number }}</td>
					</tr>
					<tr>
						<th>@lang('app.country_code')</th>
						<td>{{ $device->country_code }}</td>
					</tr>
					<tr>
						<th>@lang('app.os_api_level')</th>
						<td>{{ $device->os_api_level }}</td>
					</tr>
					<tr>
						<th>@lang('app.device')</th>
						<td>{{ $device->device }}</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-sm-6">
			<table class="table user-activity">
				<tbody>
					<tr>
						<th>@lang('app.model')</th>
						<td>{{ $device->model }}</td>
					</tr>
					<tr>
						<th>@lang('app.manufacturer')</th>
						<td>{{ $device->manufacturer }}</td>
					</tr>
					<tr>
						<th>@lang('app.brand')</th>
						<td>{{ $device->brand }}</td>
					</tr>
					<tr>
						<th>@lang('app.display')</th>
						<td>{{ $device->display }}</td>
					</tr>
					<tr>
						<th>@lang('app.os_version')</th>
						<td>{{ $device->os_version }}</td>
					</tr>
					<tr>
						<th>@lang('app.registration_date')</th>
						<td>{{ $device->created_at }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>