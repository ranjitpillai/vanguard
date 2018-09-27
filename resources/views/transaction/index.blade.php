@extends('layouts.app')

@section('page-title', trans('app.transactions'))

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                @lang('app.transactions')
                <small>@lang('app.available_system_transactions')</small>
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                        <li class="active">@lang('app.transactions')</li>
                    </ol>
                </div>
            </h1>
        </div>
    </div>

    @include('partials.messages')
	
	<div class="row tab-search">
		
		<form method="GET" action="" accept-charset="UTF-8" id="users-form">
			<div class="col-md-3">
				{!! Form::select('transaction_type', $transaction_type, Input::get('transaction_type'), ['id' => 'transaction_type', 'class' => 'form-control']) !!}
			</div>
			<div class="col-md-2">
				{!! Form::select('device_number', $device_number, Input::get('device_number'), ['id' => 'device_number', 'class' => 'form-control']) !!}
			</div>
			<div class="col-md-3">
				<input type="text" class="form-control" name="search_date" value="{{ Input::get('search_date') }}" placeholder="@lang('app.search_for_registered_date')">
					
			</div>
			<div class="col-md-3">
				<input type="text" class="form-control" name="search_phone" value="{{ Input::get('search_phone') }}" placeholder="@lang('app.search_for_phone_number')">
					
			</div>
			<div class="col-md-1">
				 @if ((Input::has('search_phone') && Input::get('search_phone') != '') ||(Input::has('search_date') && Input::get('search_date') != '') ||(Input::has('device_number') && Input::get('device_number') != '') ||(Input::has('transaction_type') && Input::get('transaction_type') != ''))
					<a href="{{ route('transaction.index') }}" class="btn btn-danger" type="button" >
						<span class="glyphicon glyphicon-remove"></span>
					</a>
				@else 
				
				<button type="submit" class="btn btn-primary">
                <i class="fa fa-search"></i>
				@endif
            </button>
			</div>
		</form>
	</div>

    <div class="table-responsive table-hover" id="users-table-wrapper">
        <table class="table">
            <thead>
				<th>@lang('app.transaction_type')</th>
				<th>@lang('app.device_number')</th>
				<th>@lang('app.phone_number')</th>
				<th>@lang('app.charge')</th>
				<th>@lang('app.service_type')</th>
				<th>@lang('app.registration_date')</th>
				<th class="text-center">@lang('app.action')</th>
			</thead>
            <tbody>
            @if (count($transactions))
                @foreach ($transactions as $transaction)
                    <tr>
                       <td>{{ $transaction->transaction_type }}</td>
						<td>{{ $transaction->device_id }}</td>
						<td>{{ $transaction->phone_number }}</td>
						<td>{{ $transaction->charge }}</td>
						<td>{{ $transaction->service_type }}</td>
						<td>{{ $transaction->created_at }}</td>
                        
                        <td class="text-center">
                            <a href="{{ route('transaction.view', $transaction->id) }}" class="btn btn-primary btn-circle"
                               title="@lang('app.view_transaction')" data-toggle="tooltip" data-placement="top">
                                <i class="glyphicon glyphicon-eye-open"></i>
                            </a>
                           
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
					<td colspan="7"><em>@lang('app.no_records_found')</em></td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>

@stop
@section('styles')
	
    {!! HTML::style('assets/css/custom.css') !!}
@stop
