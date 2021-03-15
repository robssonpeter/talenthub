{{ Form::open(['id'=>'addNewObjectiveForm']) }}
<div class="alert alert-danger d-none" id="validationErrorsBox"></div>
<div class="row">
    <div class="form-group col-sm-6">
        {{ Form::label('description', __('messages.candidate.objective').':') }}<span
                class="text-danger">*</span>
        {{ Form::textarea('description', null, ['class' => 'form-control','required','id' => 'objective']) }}
    </div>
</div>
<div class="text-right">
    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnObjectiveSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
    <button type="button" id="btnObjectiveCancel" class="btn btn-light ml-1">{{ __('messages.common.cancel') }}</button>
</div>
{{ Form::close() }}
