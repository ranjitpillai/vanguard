@extends('layouts.app')

@section('page-title', trans('app.view_device'))

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            {{ $device->phone_number }}
            <!--<small>@lang('app.edit_user_details')</small> -->
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li><a href="javascript:;">@lang('app.home')</a></li>
                    <li><a href="{{ route('device.index') }}">@lang('app.devices')</a></li>
                    <li><a href="{{ route('device.edit', $device->id) }}">{{ $device->phone_number }}</a></li>
                    <li class="active">@lang('app.view_device')</li>
                </ol>
            </div>
        </h1>
    </div>
</div>

@include('partials.messages')

<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
        <a href="#details" aria-controls="details" role="tab" data-toggle="tab">
            <i class="glyphicon glyphicon-th"></i>
            @lang('app.details')
        </a>
    </li>
	<li role="presentation">
        <a href="#transactions" aria-controls="transactions" role="tab" data-toggle="tab">
            <i class="fa fa-exchange"></i>
            @lang('app.transactions')
        </a>
    </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="details">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                @include('device.partials.details')
            </div>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="transactions">
        <div class="row">
            <div class="col-md-12">
                @include('device.partials.transactions')
            </div>
        </div>
    </div>
</div>

@stop

@section('styles')
    {!! HTML::style('assets/css/bootstrap-datetimepicker.min.css') !!}
    {!! HTML::style('assets/plugins/croppie/croppie.css') !!}
@stop