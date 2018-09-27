<div class="panel panel-default">
    <div class="panel-heading">@lang('app.users_with_this_company')</div>
    <div class="panel-body">
        <div class="row">
			<div class="table-responsive table-hover" id="users-table-wrapper">
				<table class="table">
					<thead>
						<th>@lang('app.full_name')</th>
						<th>@lang('app.registration_date')</th>
						<th>@lang('app.email')</th>
						<th>@lang('app.status')</th>
						<th class="text-center">@lang('app.action')</th>
						</thead>
					<tbody>
					@if (count($company_users))
						@foreach ($company_users as $user)
							<tr>
								<td>{{ $user->first_name }} {{ $user->last_name }}</td>
								<td>{{ $user->created_at->format('Y-m-d') }}</td>
								<td>{{ $user->email }}</td>
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
								<span class="label label-{{$class}}">{{ trans("app.{$user->status}") }}</span>
								</td>
								
								<td class="text-center">
									 <a href="{{ route('user.show', $user->id) }}" class="btn btn-success btn-circle" title="@lang('app.view_user')" data-toggle="tooltip" data-placement="top">
										<i class="glyphicon glyphicon-eye-open"></i>
									</a>
									<a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-circle"
									   title="@lang('app.edit_user')" data-toggle="tooltip" data-placement="top">
										<i class="glyphicon glyphicon-edit"></i>
									</a>
									<a href="{{ route('user.delete', $user->id) }}" class="btn btn-danger btn-circle"
									   title="@lang('app.delete_user')"
									   data-toggle="tooltip"
									   data-placement="top"
									   data-method="DELETE"
									   data-confirm-title="@lang('app.please_confirm')"
									   data-confirm-text="@lang('app.are_you_sure_delete_user')"
									   data-confirm-delete="@lang('app.yes_delete_it')">
										<i class="glyphicon glyphicon-trash"></i>
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
</div>