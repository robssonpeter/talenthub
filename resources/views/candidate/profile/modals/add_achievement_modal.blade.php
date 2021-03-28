<div id="addAchievementModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.candidate_profile.add_achievement') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'addNewAchievementForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="validationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('title', __('messages.candidate_profile.what_achieved').':', ['class' => 'font-weight-bolder']) }}<span
                                class="text-danger">*</span>
                        {{ Form::text('title', null, ['class' => 'form-control', 'id' => 'addAchievementTitle', 'required']) }}
                    </div>

                    <div class="form-group col-sm-12">
                        {{ Form::label('description', __('messages.common.description').':', ['class' => 'font-weight-bolder']) }}
                        {{ Form::textarea('description', null, ['class' => 'form-control', 'id' => 'addAchievementDescription', 'placeholder' => __('messages.candidate_profile.messages.what_achieved'), 'required']) }}
                    </div>

                    <div class="form-group col-sm-12">
                        {{ Form::label('attachment_id', __('messages.attachment').':', ['class' => 'font-weight-bolder']) }}
                        <select name="attachment_id" id="addAchievementAttachment" class="form-control">
                            <option value="">Select Attachment</option>
                            @foreach(array_keys($data['certifications']) as $certification)
                                <option value="{{$certification}}">{{json_decode($data['certifications'][$certification])->title}}</option>
                            @endforeach
                        </select>
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
<script src="{{ asset('assets/js/inttel/js/intlTelInput.min.js') }}"></script>
<script src="{{ asset('assets/js/inttel/js/utils.min.js') }}"></script>
<script src="{{ mix('assets/js/custom/phone-number-country-code.js') }}"></script>
