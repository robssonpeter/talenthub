<div id="addExperienceModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.candidate_profile.add_experience') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'addNewExperienceForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="validationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        {{ Form::label('experience_title',__('messages.candidate_profile.experience_title').':') }}<span
                                class="text-danger">*</span>
                        {{ Form::text('experience_title', null, ['class' => 'form-control','required']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('career_level_id', __('messages.job.career_level').':') }}<span
                            class="text-danger"></span>
                        {{ Form::select('career_level_id', $data['careerLevels'], null, ['class' => 'form-control','placeholder' => 'Select Level']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('industry_id', __('messages.company.industry').':') }}<span
                            class="text-danger"></span>
                        {{ Form::select('industry_id', $data['industry'], null, ['class' => 'form-control','placeholder' => 'Select Industry']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('job_category_id', __('messages.job_category.job_category').':') }}<span
                            class="text-danger"></span>
                        {{ Form::select('job_category_id', $data['jobCategories'], null, ['class' => 'form-control','placeholder' => 'Select Category']) }}
                    </div>
                    <div class="form-group col-12">
                        {{ Form::label('functionAreas', __('messages.job.functional_areas').':') }}
                        {{ Form::select('functional_areas[]', $data['functionalArea'], null, ['id'=>'addModalFunctionalAreas','class' => 'form-control', 'multiple']) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('company',__('messages.candidate_profile.company').':') }}<span
                                class="text-danger">*</span>
                        {{ Form::text('company', null, ['class' => 'form-control','required']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('country', __('messages.company.country').':') }}<span
                                class="text-danger">*</span>
                        {{ Form::select('country_id', $data['countries'], null, ['id'=>'countryId','class' => 'form-control','placeholder' => 'Select Country', 'data-modal-type' => 'experience']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('state', __('messages.company.region').':') }}
                        {{ Form::select('state_id', [], null, ['id'=>'stateId','class' => 'form-control','placeholder' => 'Select Region', 'data-modal-type' => 'experience']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('city', __('messages.company.city').':') }}
                        {{ Form::select('city_id', [], null, ['id'=>'cityId','class' => 'form-control','placeholder' => 'Select City']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('start_date', __('messages.candidate_profile.start_date').':') }}<span
                                class="text-danger">*</span>
                        {{ Form::text('start_date', null, ['class' => 'form-control','id' => 'startDate','autocomplete' => 'off', 'required']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('end_date', __('messages.candidate_profile.end_date').':') }}
                        {{ Form::text('end_date', null, ['class' => 'form-control','id' => 'endDate','autocomplete' => 'off']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-0 pt-3">
                        <label>{{ __('messages.candidate_profile.currently_working') }}</label>
                        <div class="col-6 pl-0">
                            <label class="custom-switch pl-0">
                                <input type="checkbox" name="currently_working" class="custom-switch-input"
                                       value="1" id="default">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="notes">{{ __('messages.candidate_profile.achievements').':' }}</label>
                        <div id="addExperienceAchievement" class="mb-3">

                        </div>
                        {{--<input type="hidden" rows="5" id="cover_letter" name="cover_letter"
                               placeholder="{{$job->require_cover_letter?'Required':'Optional'}}"
                               class="form-control" value="{{ ($isJobDrafted) ? $draftJobDetails->cover_letter : '' }}">--}}
                    </div>
                    <div class="form-group col-sm-12">
                        {{--{{ Form::label('description', __('messages.candidate_profile.achievements').':') }}--}}
                        {{ Form::hidden('description', null, ['id' => 'addExperienceAchievementOriginal', 'class' => 'form-control textarea-sizing','rows'=>'5']) }}
                        <textarea name="" class="invisible" id="" cols="30" rows="2"></textarea>
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnExperienceSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" id="btnCancel" class="btn btn-light ml-1"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<script>
    $(document).on('click', '#btnExperienceSave', function(){
        let markdown = turndownService.turndown(qNewExperience.root.innerHTML);
        $('#addExperienceAchievementOriginal').val(qNewExperience.root.innerHTML);
    });
</script>
