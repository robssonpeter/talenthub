{{ Form::open(['id'=>'editExperienceForm']) }}
<div class="alert alert-danger d-none" id="editValidationErrorsBox"></div>
<input type="hidden" id="experienceId">
<div class="row">
    <div class="form-group col-sm-6">
        {{ Form::label('experience_title',__('messages.candidate_profile.experience_title').':') }}<span
                class="text-danger">*</span>
        {{ Form::text('experience_title', null, ['class' => 'form-control','required', 'id' => 'editTitle']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('career_level_id', __('messages.job.career_level').':') }}<span
            class="text-danger"></span>
        {{ Form::select('career_level_id', $data['careerLevels'], null, ['id'=>'editExperienceCareerLevel', 'class' => 'form-control','placeholder' => 'Select Level']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('industry_id', __('messages.company.industry').':') }}<span
            class="text-danger"></span>
        {{ Form::select('industry_id', $data['industry'], null, ['id'=>'editExperienceIndustry', 'class' => 'form-control','placeholder' => 'Select Industry']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('job_category_id', __('messages.job_category.job_category').':') }}<span
            class="text-danger"></span>
        {{ Form::select('job_category_id', $data['jobCategories'], null, ['id'=>'editExperienceCategory', 'class' => 'form-control','placeholder' => 'Select Category']) }}
    </div>
    <div class="form-group col-12">
        {{ Form::label('functionAreas', __('messages.job.functional_areas').':') }}
        {{ Form::select('functional_areas[]', $data['functionalArea'], null, ['id'=>'editExperienceFunctionalAreasBuilder','class' => 'form-control', 'multiple']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('company',__('messages.candidate_profile.company').':') }}<span
                class="text-danger">*</span>
        {{ Form::text('company', null, ['class' => 'form-control','required', 'id' => 'editCompany']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('country', __('messages.company.country').':') }}<span
                class="text-danger">*</span>
        {{ Form::select('country_id', $data['countries'], null, ['id'=>'editCountry','class' => 'form-control','placeholder' => 'Select Country', 'data-modal-type' => 'experience', 'data-is-edit' => 'true']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('state', __('messages.company.state').':') }}
        {{ Form::select('state_id', [], null, ['id'=>'editState','class' => 'form-control','placeholder' => 'Select State', 'data-modal-type' => 'experience', 'data-is-edit' => 'true']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('city', __('messages.company.city').':') }}
        {{ Form::select('city_id', [], null, ['id'=>'editCity','class' => 'form-control','placeholder' => 'Select City', 'data-is-edit' => 'true']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('start_date', __('messages.candidate_profile.start_date').':') }}<span
                class="text-danger">*</span>
        {{ Form::text('start_date', null, ['class' => 'form-control','id' => 'editStartDate','autocomplete' => 'off', 'required']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('end_date', __('messages.candidate_profile.end_date').':') }}
        {{ Form::text('end_date', null, ['class' => 'form-control','id' => 'editEndDate','autocomplete' => 'off']) }}
    </div>
    <div class="form-group col-sm-6 mb-0 pt-3">
        <label>{{ __('messages.candidate_profile.currently_working') }}</label>
        <label class="custom-switch pl-0 col-12">
            <input type="checkbox" name="currently_working" class="custom-switch-input"
                   value="1" id="editWorking">
            <span class="custom-switch-indicator"></span>
        </label>
    </div>

    <div class="form-group col-sm-12">
        {{ Form::label('description', __('messages.candidate_profile.achievements').':') }}
        <div id="editExperienceAchievement" class="mb-3">

        </div>


    </div>
    <div class="form-group col-sm-12">
        {{ Form::hidden('description', null, ['class' => 'form-control textarea-sizing','rows'=>'5','id' => 'editDescriptionBuilder']) }}
        <textarea name="" class="invisible" id="" cols="30" rows="2"></textarea>
    </div>
</div>
<div class="text-right">
    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnEditExperienceSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
    <button type="button" id="btnEditCancel" class="btn btn-light ml-1">{{ __('messages.common.cancel') }}</button>
</div>
{{ Form::close() }}
<script>
    $(document).on('click', '#btnEditExperienceSave', function(){
        //let markdown = turndownService.turndown(qEditExperience.root.innerHTML);
        $('#editDescriptionBuilder').val(qEditExperience.root.innerHTML);
    });
</script>
