<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label for="street1">@lang('app.street1')</label>
			<input type="text" class="form-control" id="street1" name="street1" placeholder="@lang('app.street1')" value="{{ $edit ? $user->street1 : '' }}">
		</div>
		<div class="form-group">
			<label for="city">@lang('app.city')</label>
			<input type="text" class="form-control" id="city" name="city" placeholder="@lang('app.city')" value="{{ $edit ? $user->city : '' }}">
		</div>
		<div class="form-group">
			<label for="state">@lang('app.state')</label>
			<input type="text" class="form-control" id="state" name="state" placeholder="@lang('app.state')" value="{{ $edit ? $user->state : '' }}">
		</div>
		
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="street2">@lang('app.street2')</label>
			<input type="text" class="form-control" id="street2" name="street2" placeholder="@lang('app.street2')" value="{{ $edit ? $user->street2 : '' }}">
		</div>
		<div class="form-group">
			<label for="postal_code">@lang('app.postal_code')</label>
			<input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="@lang('app.postal_code')" value="{{ $edit ? $user->postal_code : '' }}">
		</div>
		<div class="form-group">
			<label for="state_code">@lang('app.state_code')</label>
			<input type="text" class="form-control" id="state_code" name="state_code" placeholder="@lang('app.state_code')" value="{{ $edit ? $user->state_code : '' }}">
		</div>
		
	</div>
	@if ($edit)
        <div class="col-md-12 mt-2">
            <button type="submit" class="btn btn-primary" id="update-details-btn">
                <i class="fa fa-refresh"></i>
                @lang('app.update_address_details')
            </button>
        </div>
    @endif
</div>
