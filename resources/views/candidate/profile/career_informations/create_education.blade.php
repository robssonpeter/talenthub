{{ Form::open(['id'=>'addNewEducationForm']) }}
<div class="alert alert-danger d-none" id="validationErrorsBox"></div>
<div class="row">
    <div class="form-group col-sm-6">
        {{ Form::label('degree_level_id', __('messages.candidate_profile.degree_level').':') }}<span
                class="text-danger">*</span>
        {{ Form::select('degree_level_id', $data['degreeLevels'], null, ['class' => 'form-control','required','id' => 'degreeLevelId','placeholder'=>'Select Degree Level']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('degree_title', __('messages.candidate_profile.degree_title').':') }}<span
                class="text-danger">*</span>
        {{ Form::text('degree_title', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('country', __('messages.company.country').':') }}<span
                class="text-danger">*</span>
        {{ Form::select('country_id', $data['countries'], null, ['id'=>'educationCountryId','required','class' => 'form-control','placeholder' => 'Select Country', 'data-modal-type' => 'education']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('state', __('messages.company.state').':') }}
        {{ Form::select('state_id', [], null, ['id'=>'educationStateId','class' => 'form-control','placeholder' => 'Select State', 'data-modal-type' => 'education']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('city', __('messages.company.city').':') }}
        {{ Form::select('city_id', [], null, ['id'=>'educationCityId','class' => 'form-control','placeholder' => 'Select City']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('institute',__('messages.candidate_profile.institute').':') }}<span
                class="text-danger">*</span>
        {{ Form::text('institute', null, ['class' => 'form-control','required']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('start_year', __('messages.candidate_profile.start_year').':') }}<span
            class="text-danger">*</span>
        {{ Form::selectYear('start_year', date('Y'), 1950, null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('year', __('messages.candidate_profile.year').':') }}<span
            class="text-danger" id="newEducationEndYearRequired">*</span>
        {{ Form::selectYear('year', date('Y'), 1950, null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-sm-6 mb-0 pt-3">
        <label>{{ __('messages.candidate_profile.currently_studying') }}</label>
        <div class="col-6 pl-0">
            <label class="custom-switch pl-0">
                <input type="checkbox" name="currently_studying" class="custom-switch-input"
                       value="1" id="newCurrentlyStudying">
                <span class="custom-switch-indicator"></span>
            </label>
        </div>
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('result', __('messages.candidate_profile.result').':') }}<span
                class="text-danger" id="newEducationResultRequired">*</span>
        {{ Form::text('result', null, ['class' => 'form-control', 'required']) }}
    </div>
</div>
<div class="text-right">
    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnEducationSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
    <button type="button" id="btnEducationCancel" class="btn btn-light ml-1">{{ __('messages.common.cancel') }}</button>
</div>
{{ Form::close() }}
