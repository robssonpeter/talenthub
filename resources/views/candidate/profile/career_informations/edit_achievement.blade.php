{{ Form::open(['id'=>'editAchievementForm']) }}
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
    <button type="button" id="btnEditAchievementCancel" class="btn btn-light ml-1"
            data-dismiss="modal">{{ __('messages.common.cancel') }}</button>
</div>
{{ Form::close() }}
