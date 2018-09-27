<div class="panel panel-default">
    <div class="panel-heading">@lang('app.address_details')</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
				<div class="form-group">
                    <label for="street1">@lang('app.street1')</label>
                    <input type="text" class="form-control" id="street1"
                           name="street1" placeholder="@lang('app.street1')" value="{{ $edit ? $company->street1 : '' }}">
                    <input type="hidden" name="page" value="{{ $profile ? 'profile' : 'edit'}}">
                </div>
				<div class="form-group">
                    <label for="city">@lang('app.city')</label>
                    <input type="text" class="form-control" id="city"
                           name="city" placeholder="@lang('app.city')" value="{{ $edit ? $company->city : '' }}">
                </div>
				<div class="form-group">
                    <label for="state">@lang('app.state')</label>
                    <input type="text" class="form-control" id="state"
                           name="state" placeholder="@lang('app.state')" value="{{ $edit ? $company->state : '' }}">
                </div>
				<div class="form-group">
                    <label for="address">@lang('app.address')</label>
                    <input type="text" class="form-control" id="address"
                           name="address" placeholder="@lang('app.address')" value="{{ $edit ? $company->address : '' }}">
                </div>
              
            </div>
            <div class="col-md-6">
				<div class="form-group">
                    <label for="street2">@lang('app.street2')</label>
                    <input type="text" class="form-control" id="street2"
                           name="street2" placeholder="@lang('app.street2')" value="{{ $edit ? $company->street2 : '' }}">
                </div>
				<div class="form-group">
                    <label for="postal_code">@lang('app.postal_code')</label>
                    <input type="text" class="form-control" id="postal_code"
                           name="postal_code" placeholder="@lang('app.postal_code')" value="{{ $edit ? $company->postal_code : '' }}">
                </div>
				<div class="form-group">
                    <label for="state_code">@lang('app.state_code')</label>
                    <input type="text" class="form-control" id="state_code"
                           name="state_code" placeholder="@lang('app.state_code')" value="{{ $edit ? $company->state_code : '' }}">
                </div>
                <div class="form-group">
                    <label for="address">@lang('app.country')</label>
                    {!! Form::select('country_id', $countries, $edit ? $company->country_id : '', ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-refresh"></i>
            @lang('app.update_address_details')
        </button>
    </div>
</div>