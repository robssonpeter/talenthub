<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.salary_currency.edit_salary_currency') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{ Form::open(['id' => 'editForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="editValidationErrorsBox"></div>
                {{ Form::hidden('salaryCurrencyId',null,['id'=>'salaryCurrencyId']) }}
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('currency_name',__('messages.salary_currency.currency_name').':') }}<span
                                class="text-danger">*</span>
                        {{ Form::text('currency_name', null, ['class' => 'form-control','required','id' => 'editCurrencyName' ]) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('currency_icon',__('messages.salary_currency.currency_icon').':') }}<span
                                class="text-danger">*</span>
                        {{ Form::text('currency_icon', null, ['class' => 'form-control','required','id' => 'editCurrencyIcon']) }}
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnEditSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" id="btnEditCancel" class="btn btn-light ml-1"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}
                    </button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
