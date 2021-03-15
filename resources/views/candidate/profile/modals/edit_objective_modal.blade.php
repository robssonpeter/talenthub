<div id="editAchievementModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.candidate_profile.edit_referee') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'editAchievementForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="editValidationErrorsBox"></div>
                <input type="hidden" id="achievementId">
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('title', __('messages.candidate_profile.what_achieved').':', ['class' => 'font-weight-bolder']) }}<span
                            class="text-danger">*</span>
                        {{ Form::text('title', null, ['class' => 'form-control', 'id' => 'editAchievementTitle']) }}
                    </div>

                    <div class="form-group col-sm-12">
                        {{ Form::label('description', __('messages.common.description').':', ['class' => 'font-weight-bolder']) }}
                        {{ Form::textarea('description', null, ['class' => 'form-control', 'id' => 'editAchievementDescription', 'placeholder' => __('messages.candidate_profile.messages.what_achieved')]) }}
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnEditAchievementSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" id="btnEditEducationCancel" class="btn btn-light ml-1"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
