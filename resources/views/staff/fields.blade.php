<div class="row">
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('name', __('messages.staff.name').':') }}<span class="text-danger">*</span>
        {{ Form::text('name', null, ['class' => 'form-control','required']) }}
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('email', __('messages.company.email').':') }}<span class="text-danger">*</span>
        {{ Form::email('email', null, ['class' => 'form-control', 'required']) }}
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('phone', __('messages.user.phone').':') }}<br>
        {{ Form::tel('phone', null, ['class' => 'form-control', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','id'=>'phoneNumber']) }}
        {{ Form::hidden('region_code',null,['id'=>'prefix_code']) }}
        <br>
        <span id="valid-msg" class="hide">✓ Valid</span>
        <span id="error-msg" class="hide"></span>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('role', __('messages.staff.role').':') }}<span class="text-danger">*</span>
        {{ Form::select('role', $data['roles'], null,['class' => 'form-control','required']) }}
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('password', __('messages.company.password').':') }}<span class="text-danger">*</span>
        <input name="password" type="password" id="password"
               class="form-control" required>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('password_confirmation', __('messages.company.confirm_password').':') }}<span
                class="text-danger">*</span>
        <input name="password_confirmation" type="password" id="confirmPassword"
               class="form-control" required>
    </div>

    <div class="form-group col-xl-2 col-md-2 col-sm-12">
        <label>{{ __('messages.common.status') }}</label><br>
        <label class="custom-switch pl-0">
            <input type="checkbox" name="is_active" class="custom-switch-input isActive"
                   value="1" id="active" {{  isset($company)?($company->is_active == 1 ?'checked':''):'checked' }}>
            <span class="custom-switch-indicator"></span>
        </label>
    </div>


    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary', 'id' => 'btnSave']) }}
        <a href="{{ route('company.index') }}" class="btn btn-secondary text-dark">{{__('messages.common.cancel')}}</a>
    </div>

</div>
