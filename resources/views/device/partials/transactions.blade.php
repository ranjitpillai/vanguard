<div class="panel panel-default">
    <div class="panel-heading">
		@lang('app.transactions')
	</div>
    <div class="panel-body">
		<div class="col-sm-12">
			<table class="table user-activity">
				<thead>
					<th>@lang('app.transaction_type')</th>
					<th>@lang('app.phone_number')</th>
					<th>@lang('app.charge')</th>
					<th>@lang('app.registration_date')</th>
				</thead>
				<tbody>
				@if (count($transactions))
					@foreach ($transactions as $transaction)
						<tr>
							<td>{{ $transaction->transaction_type }}</td>
							<td>{{ $transaction->phone_number }}</td>
							<td>{{ $transaction->charge }}</td>
							<td>{{ $transaction->created_at }}</td>
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