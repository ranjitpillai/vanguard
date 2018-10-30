<div class="panel panel-default">
    <div class="panel-heading">@lang('app.company_details')</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
              
                <div class="form-group">
                    <label for="name">@lang('app.company_name')</label>
                    <input type="text" class="form-control" id="name"
                           name="company_name" placeholder="@lang('app.company_name')" value="{{ $edit ? $company->company_name : old('company_name') }}">
                </div>
                <div class="form-group">
                    <label for="name">@lang('app.company_details')</label>                  
                    <textarea name="company_details" class="form-control" placeholder="@lang('app.company_details')">{{ $edit ? $company->company_details : old('company_details') }}</textarea>
                    <input type="hidden" name="page" value="{{ $profile ? 'profile' : 'edit'}}">
                </div>
				 <div class="form-group">
                    <label for="address">@lang('app.company_code')</label>
                    <input type="text" class="form-control" id="company_code" disabled
                           name="company_code" placeholder="@lang('app.company_code')" value="{{ $edit ? $company->company_code : '' }}">
                </div>
                <?php
                    if(Auth::user()->hasRole('Admin')){    
                ?>
                <div class="form-group">
                    <label for="status">@lang('app.status')</label>
                    {!! Form::select('status', $statusCompany, $edit ? $company->status : '',
                        ['class' => 'form-control', 'id' => 'status', $profile ? 'disabled' : '']) !!}
                </div>
                <?php
                    }
                ?>
            </div>

            <div class="col-md-6">
                
                <div class="form-group">
                    <label for="company_phone">@lang('app.company_phone')</label>
                    <input type="text" class="form-control" id="company_phone"
                           name="company_phone" placeholder="@lang('app.company_phone')" value="{{ $edit ? $company->company_phone : '' }}">
                </div>
               

                <div class="form-group">
                    <label for="company_website">@lang('app.company_website')</label>
                    <input type="text" class="form-control" id="company_website"
                           name="company_website" placeholder="@lang('app.company_website')" value="{{ $edit ? $company->company_website : '' }}">
                </div>
               
                <div class="form-group">
                    <label for="company_fax">@lang('app.company_fax')</label>
                    <input type="text" class="form-control" id="company_fax"
                           name="company_fax" placeholder="@lang('app.company_fax')" value="{{ $edit ? $company->company_fax : '' }}">
                </div>

                <div class="form-group">
                    <label for="company_address">@lang('app.company_address')</label>
                    <input type="text" class="form-control" id="company_address"
                           name="company_address" placeholder="@lang('app.company_address')" value="{{ $edit ? $company->company_address : '' }}">
                </div>
               
            </div>

            @if ($edit)
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" id="update-details-btn">
                        <i class="fa fa-refresh"></i>
                        @lang('app.update_details')
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>