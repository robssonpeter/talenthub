<div id="addAchievementModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.candidate_profile.awards_and_certificates') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'addNewAchievementForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="validationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-md-6">
                        {{ Form::label('title', __('messages.candidate_profile.title').':', ['class' => 'font-weight-bolder']) }}<span
                                class="text-danger">*</span>
                        {{ Form::text('title', null, ['class' => 'form-control', 'id' => 'addAchievementTitle', 'required']) }}
                    </div>

                    <div class="form-group col-md-6">
                        {{ Form::label('category_id', __('messages.candidate_profile.certificate_category').':', ['class' => 'font-weight-bolder']) }}<span
                                class="text-danger">*</span>
                        {{ Form::select('category_id', $data['certificateCategories'], null, ['id'=>'certificateCategory','class' => 'form-control', 'data-modal-type' => 'education']) }}
                    </div>

                    <div class="form-group col-md-6">
                        {{ Form::label('country_id', __('messages.candidate_profile.country_of_institution').':', ['class' => 'font-weight-bolder']) }}<span
                                class="text-danger">*</span>
                        {{ Form::select('country_id', $data['countries'], null, ['id'=>'countryOfInstitution','class' => 'form-control','placeholder' => 'Select Country', 'data-modal-type' => 'education']) }}
                    </div>

                    <div class="form-group col-md-6">
                        {{ Form::label('institution_id', __('messages.candidate_profile.institution').':', ['class' => 'font-weight-bolder']) }}<span
                                class="text-danger">*</span>
                        {{ Form::select('institution_id', [], null, ['id'=>'idOfInstitution','class' => 'form-control','placeholder' => 'Select Institution', 'data-modal-type' => 'education']) }}
                    </div>

                    <div class="form-group col-md-6">
                        {{ Form::label('completion_date', __('messages.candidate_profile.completion_date').':', ['class' => 'font-weight-bolder']) }}<span
                                class="text-danger"></span>
                        {{ Form::date('completion_date', null, ['class' => 'form-control', 'id' => 'addAchievementCompletionDate']) }}
                    </div>

                    <div class="form-group col-md-6">
                        {{ Form::label('valid_until', __('messages.common.valid_until').':', ['class' => 'font-weight-bolder']) }}<span
                                class="text-danger"></span>
                        {{ Form::date('valid_until', null, ['class' => 'form-control', 'id' => 'addAchievementValidUntil',]) }}
                    </div>

                    <div class="form-group col-12">
                        <div id="currentStatus" class="custom-control custom-checkbox">
                            <input type="checkbox" {{--id="addAchievementIsOngoing"--}} class="custom-control-input" id="is_ongoing" name="ongoing">
                            <label class="custom-control-label control-label" for="is_ongoing">Currently On-going</label>
                        </div>
                    </div>

                    <div class="">
                        {{--{{ Form::label('description', __('messages.common.description').':', ['class' => 'font-weight-bolder']) }}--}}
                        {{ Form::hidden('description', 'none', ['class' => 'form-control', 'id' => 'addAchievementDescription', 'placeholder' => __('messages.candidate_profile.messages.what_achieved'), 'required']) }}
                    </div>

                    <div class="form-group col-sm-12">
                        {{ Form::label('attachment_id', __('messages.attachment').':', ['class' => 'font-weight-bolder']) }}
                        <select name="attachment_id" id="addAchievementAttachment" class="form-control">
                            <option value="">Select Attachment</option>
                            <option value="new">Add New</option>
                            @foreach(array_keys($data['certifications']) as $certification)
                                <option value="{{$certification}}">{{json_decode($data['certifications'][$certification])->title}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group col-sm-12" style="display: none;" id="new-attachment-section">
                        <span><strong>{{ Form::label('attachment:', 'New Attachment') }}</strong></span>
                        {{Form::file('attachment', ['class' => 'form-control  form-control-file attachment', 'id' => 'attachment-new'])}}
                        <div class="progress mt-2" style="height: 5px">
                            <div class="progress-bar" id="resume-progress-new" role="progressbar" style="width: 0%; height: 5px" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="form-group col-sm-12">
                            {{ Form::hidden('file[]', null, ['class' => 'form-control', 'id' => 'uploaded_file_new' ]) }}
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnAchievementSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" id="btnEducationCancel" class="btn btn-light ml-1"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<script>
    $(document).on('change', '#addAchievementAttachment', function(){
        let value = $(this).val();
        if(value === 'new'){
            $("#new-attachment-section").slideDown('slow');
        }else{
            $("#new-attachment-section").slideUp('slow');
        }
    })
    $(document).on('change', '#attachment-new', function(e){
        let title = $('#addAchievementTitle').val();
        let type = e.target.name;
        let id = 'attachment-new';
        let index = 'new';
        if(!title.length){
            swal('Error', 'Please add the title of this award first', 'error');
            $('#attachment-'+index).val('');
            return;
        }
        let file = e.target.files || e.dataTransfer.files;
        console.log(file[0]);
        if(file.length){
            let formData = new FormData();
            formData.append('file', file[0]);
            formData.append('return', '1');
            formData.append('title', title);
            axios.post(attachmentUploadUrl, formData, {
                headers: {
                    'Content-type' : 'multipart/form-data'
                },
                onUploadProgress: function(progressEvent) {
                    let progress = document.getElementById('resume-progress-'+index);
                    var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total)
                    progress.style.width = percentCompleted+"%";
                    console.log(percentCompleted)
                }
            }).then(function(response){
                let progress = document.getElementById('resume-progress-'+index);
                //progress.style.width = '0%';
                $('#addAchievementAttachment').append($('<option></option>').attr('value', response.data.data.id).text(title));
                $('#attachment-'+index).val('');
                progress.style.width = '0%';
                $("#new-attachment-section").slideUp('slow');
                $('#addAchievementAttachment').val(response.data.data.id);
                //$('#uploaded_file_'+index).val(response.data.saved);
                //displaySuccessMessage(response.data.message);
                console.log(response.data);
            }).catch(error => {
                //console.log(error.response.data)
                let progress = document.getElementById('resume-progress-'+index);
                progress.style.width = '0%';
                $('#attachment-'+index).val('');
                displayErrorMessage(error.response.data.message);

                //console.log(error.response.data.errors.attachment);
            })
        }
    });
</script>
<script src="{{ asset('assets/js/inttel/js/intlTelInput.min.js') }}"></script>
<script src="{{ asset('assets/js/inttel/js/utils.min.js') }}"></script>
<script src="{{ mix('assets/js/custom/phone-number-country-code.js') }}"></script>
