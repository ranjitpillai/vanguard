@extends('layouts.app')

@section('page-title', trans('app.transaction_details'))

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                @lang('app.transaction_details')
                <small>@lang('app.available_system_transactions')</small>
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                        <li class="active">@lang('app.transaction_details')</li>
                    </ol>
                </div>
            </h1>
        </div>
    </div>

    @include('partials.messages')

    <div class="table-responsive table-hover" id="users-table-wrapper">
        <table class="table">
            <tbody>
				<tr>
					<th>@lang('app.device_number')</th>
					<td>{{ $transaction->device_id }}</td>
				</tr>
				<tr>
					<th>@lang('app.transaction_type')</th>
					<td>{{ $transaction->transaction_type }}</td>
				</tr>
				<tr>
					<th>@lang('app.phone_number')</th>
					<td>{{ $transaction->phone_number }}</td>
				</tr>
				<tr>
					<th>@lang('app.charge')</th>
					<td>{{ $transaction->charge }}</td>
				</tr>
				<tr>
					<th>@lang('app.name')</th>
					<td>{{ $transaction->name }}</td>
				</tr>
				<tr>
					<th>@lang('app.note')</th>
					<td>{{ $transaction->note }}</td>
				</tr>
				<tr>
					<th>@lang('app.service_type')</th>
					<td>{{ $transaction->service_type }}</td>
				</tr>
				<tr>
					<th>@lang('app.latitude')</th>
					<td>{{ $transaction->latitude }}</td>
				</tr>
				<tr>
					<th>@lang('app.longitude')</th>
					<td>{{ $transaction->longitude }}</td>
				</tr>
				<tr>
					<th>@lang('app.registration_date')</th>
					<td>{{ $transaction->created_at }}</td>
				</tr>
				@if (count($transaction_details))
					@foreach ($transaction_details as $td)
						@if(!in_array($td->key_name,$transaction_key_array))
							<tr>
								<th>{{ ucwords(str_replace("_"," ",$td->key_name)) }}</th>
								<td>{{ $td->value }}</td>
							</tr>
						@endif
					@endforeach
				@endif
			</tbody>
        </table>
    </div>

@stop
