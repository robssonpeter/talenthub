<div class="row">
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('company_id', __('messages.company.company_name').':') }}<span class="text-danger">*</span>
        {{ Form::select('company_id', $data['companies'],null, ['id'=>'companyId','class' => 'form-control','placeholder' => 'Select Company','required']) }}
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('job_title', __('messages.job.job_title').':') }}<span class="text-danger">*</span>
        {{ Form::text('job_title', null, ['class' => 'form-control','required']) }}
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('job_type_id', __('messages.job.job_family').':') }}<span class="text-danger">*</span>
        {{ Form::select('job_type_id', $data['jobType'],null, ['id'=>'jobTypeId','class' => 'form-control','placeholder' => 'Select Job Type','required']) }}
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('industry_id', __('messages.job.industry').':') }}<span class="text-danger">*</span>
        {{ Form::select('industry_id', $data['industries'],null, ['id'=>'industries','class' => 'form-control','placeholder' => 'Select Industry','required']) }}
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('job_category_id', __('messages.job_category.job_function').':') }}<span
                class="text-danger">*</span>
        {{ Form::select('job_category_id', $data['jobCategory'],null, ['id'=>'jobCategoryId','class' => 'form-control','placeholder' => 'Select Job Category','required']) }}
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('skill_id', __('messages.job.job_skill').':') }} <span class="text-danger">*</span>
        {{Form::select('jobsSkill[]',$data['jobSkill'], null, ['class' => 'form-control','id'=>'SkillId','multiple'=>true,'required'])}}
    </div>
{{--    <div class="form-group col-xl-4 col-md-4 col-sm-12">--}}
{{--        {{ Form::label('no_preference', __('messages.candidate.gender').':') }}--}}
{{--        {{ Form::select('no_preference', $data['preference'], null, ['id'=>'preferenceId','class' => 'form-control','placeholder' => 'Select Gender']) }}--}}
{{--    </div>--}}
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('job_expiry_date', __('messages.job.job_expiry_date').':') }} <span class="text-danger">*</span>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>
            {{ Form::text('job_expiry_date', isset($job->job_expiry_date) ? $job->job_expiry_date : null, ['class' => 'form-control expiryDatepicker', 'required', 'autocomplete' => 'off']) }}
        </div>
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('salary_from', __('messages.job.salary_from').':') }}<span class="text-danger">*</span>
        {{ Form::text('salary_from', null, ['class' => 'form-control salary', 'id' => 'fromSalary', 'required', 'placeholder' => __('messages.job.net_amount')]) }}
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('salary_to', __('messages.job.salary_to').':') }}<span class="text-danger">*</span>
        {{ Form::text('salary_to', null, ['class' => 'form-control salary', 'id' => 'toSalary', 'required', 'placeholder' => __('messages.job.net_amount')]) }}
        <span id="salaryToErrorMsg" class="text-danger"></span>
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('currency_id', __('messages.job.currency').':') }}<span class="text-danger">*</span>
        {{ Form::select('currency_id', $data['currencies'], null, ['id'=>'currencyId','class' => 'form-control','placeholder' => 'Select Currency','required']) }}
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('salary_period_id', __('messages.job.salary_period').':') }}<span class="text-danger">*</span>
        {{ Form::select('salary_period_id', $data['salaryPeriods'], null, ['id'=>'salaryPeriodsId','class' => 'form-control','placeholder' => 'Select Salary Period','required']) }}
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('country', __('messages.company.country').':') }}<span class="text-danger">*</span>
        {{ Form::select('country_id', $data['countries'], null, ['id'=>'countryId','class' => 'form-control','placeholder' => 'Select Country','required']) }}
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('state', __('messages.company.region').':') }}<span class="text-danger">*</span>
        {{ Form::select('state_id', [], null, ['id'=>'stateId','class' => 'form-control','placeholder' => 'Select Region','required']) }}
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('city', __('messages.company.district').':') }}<span class="text-danger">*</span>
        {{ Form::select('city_id', [], null, ['id'=>'cityId','class' => 'form-control','placeholder' => 'Select City','required']) }}
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('career_level_id', __('messages.job.career_level').':') }}
        {{ Form::select('career_level_id', $data['careerLevels'],null, ['id'=>'careerLevelsId','class' => 'form-control','placeholder' => 'Select Career Level']) }}
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('job_shift_id', __('messages.job.job_shift').':') }}
        {{ Form::select('job_shift_id', $data['jobShift'], null, ['id'=>'jobShiftId','class' => 'form-control','placeholder' => 'Select Job Shift']) }}
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('tagId', __('messages.job_tag.show_job_tag').':') }}
        {{Form::select('jobTag[]',$data['jobTag'], null, ['class' => 'form-control','id'=>'tagId','multiple'=>true])}}
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('degree_level_id', __('messages.job.degree_level').':') }}
        {{ Form::select('degree_level_id', $data['requiredDegreeLevel'], null, ['id'=>'requiredDegreeLevelId','class' => 'form-control','placeholder' => 'Select Degree Level']) }}
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('functional_areas', __('messages.job.functional_area').':') }}<span
                class="text-danger">*</span>
        {{ Form::select('functional_areas[]', $data['functionalArea'], null, ['id'=>'functionalAreaId','class' => 'form-control', 'multiple','required']) }}
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('position', __('messages.job.number_of_positions').':') }}<span class="text-danger">*</span>
        {{ Form::number('position',  null, ['id'=>'positionId','class' => 'form-control','placeholder' => 'Select Position','required', 'min' => 0]) }}
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('experience', __('messages.job_experience.job_experience').':') }}<span
                class="text-danger">*</span>
        {{ Form::number('experience',  null, ['id'=>'experienceId','class' => 'form-control','placeholder' => 'Enter experience In Year','required', 'min' => 0]) }}
    </div>
    <div class="form-group col-xl-12 col-md-12 col-sm-12">
        {{ Form::label('description', __('messages.job.responsibilities').':') }}<span class="text-danger">*</span>
        {{ Form::textarea('description', null, ['class' => 'form-control' , 'id' => 'details', 'rows' => '5']) }}
    </div>
    <div class="form-group col-xl-12 col-md-12 col-sm-12">
        {{ Form::label('qualifications', __('messages.job.qualifications').':') }}<span class="text-danger">*</span>
        {{ Form::textarea('qualifications', null, ['class' => 'form-control' , 'id' => 'qualifications', 'rows' => '5']) }}
    </div>
    <div class="form-group col-xl-12 col-md-12 col-sm-12">
        {{ Form::label('additional_information', __('messages.job.additional_information').':') }}<span class="text-danger">*</span>
        {{ Form::textarea('additional_information', null, ['class' => 'form-control' , 'id' => 'additional_information', 'rows' => '5']) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('benefits', __('messages.benefits.benefits').':') }}<span class="text-danger">*</span>
        {{ Form::select('benefits[]', $data['benefits'], 0, ['id'=>'benefits','class' => 'form-control','placeholder' => 'Select Benefits','required','multiple']) }}
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('reports_to', __('messages.job.reports_to').':') }}
        {{ Form::text('reports_to', null, ['id'=>'reports_to','class' => 'form-control']) }}
    </div>
    @if(!Auth::user()->hasRole('Employer'))
    <div class="form-group col-xl-3 col-md-3 col-sm-12">
        <label>{{ __('messages.job.application_method') }}</label>
        {{Form::select('application_method', \App\Models\Job::APPLY_METHODS, 0, ['class' => 'form-control', 'id' => 'application_method'] )}}
    </div>
    <div class="form-group col-xl-9 col-md-9 col-sm-12">
        <div id="url-enclose" style="display: none;">
            <label>{{ __('messages.job.application_url') }}</label>
            {{Form::url('url', '', ['class' => 'form-control', 'id' => 'url-input', 'placeholder' => 'Paste the link to the application portal'])}}
        </div>
    </div>
    @endif
    <div class="form-group col-xl-3 col-md-3 col-sm-12">
        <label>{{ __('messages.job.hide_salary') }}</label>
        <label class="custom-switch pl-0 col-12">
            <input type="checkbox" name="hide_salary" class="custom-switch-input"
                   id="salary">
            <span class="custom-switch-indicator"></span>
        </label>
    </div>
    <div class="form-group col-xl-3 col-md-3 col-sm-12">
        <label>{{ __('messages.job.is_freelance') }}</label>
        <label class="custom-switch pl-0 col-12">
            <input type="checkbox" name="is_freelance" class="custom-switch-input"
                   id="freelance">
            <span class="custom-switch-indicator"></span>
        </label>
    </div>

    <div class="form-group col-xl-3 col-md-3 col-sm-12">
        <label>{{ __('messages.job.hide_employer') }}</label>
        <label class="custom-switch pl-0 col-12">
            <input type="checkbox" name="is_anonymous" class="custom-switch-input"
                   id="salary">
            <span class="custom-switch-indicator"></span>
        </label>
    </div>

    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary','name' => 'save', 'id' => 'saveJob']) }}
        <a href="{{ route('admin.jobs.index') }}"
           class="btn btn-secondary text-dark">{{__('messages.common.cancel')}}</a>
    </div>

</div>
<script>
    $(document).on('change', '#application_method', function(){
        let value = $(this).val();
        if(Number(value) === 1){
            /*alert('things have changed');*/
            $('#url-enclose').fadeIn('fast');
            $('#url-input').prop('required',true);
        }else{
            $('#url-enclose').fadeOut('fast');
            $('#url-input').prop('required',false);
        }
    })
</script>
