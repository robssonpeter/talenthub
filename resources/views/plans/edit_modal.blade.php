<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.plan.edit_subscription_plan') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['id' => 'editForm']) !!}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="editValidationErrorsBox"></div>
                {!! Form::hidden('planId',null,['id'=>'planId']) !!}
                <div class="row">
                    <div class="form-group col-sm-12">
                        {!! Form::label('name', __('messages.inquiry.name').':') !!}<span class="text-danger">*</span>
                        {!! Form::text('name', null, ['id'=>'editName','class' => 'form-control','required']) !!}
                    </div>

                    <div class="form-group col-sm-12">
                        {!! Form::label('period', __('messages.plan.subscription_period').':') !!}<span class="text-danger">*</span>
                        {!! Form::select('period', array_keys(\App\Models\Plan::PERIODS), array_search('Monthly', array_keys(\App\Models\Plan::PERIODS)), ['class' => 'form-control', 'id' => 'editSubscriptionPeriod', 'required']) !!}
                    </div>
                    {{--<div class="form-group col-sm-12">
                        {!! Form::label('subscription_duration', __('messages.plan.subscription_duration').' (in days)'.':') !!}<span class="text-danger">*</span>
                        {!! Form::number('subscription_duration', null, ['id'=>'editSubscriptionDuration', 'class' => 'form-control subscription-duration', 'required', 'min' => '1']) !!}
                    </div>--}}
                    <div class="form-group col-sm-12">
                        {!! Form::label('allowed_jobs', __('messages.plan.allowed_jobs').':') !!}<span class="text-danger">*</span>
                        {!! Form::number('allowed_jobs', null, ['id'=>'editAllowedJobs', 'class' => 'form-control allowed-jobs', 'required', 'min' => '1']) !!}
                    </div>
                    <div class="form-group col-sm-12">
                        {!! Form::label('currency', __('messages.plan.currency').':') !!}<span class="text-danger">*</span>
                        {{--{!! Form::select('currency', ['1'=>'English', '2'=>'Swahili'], [ 'id' => 'currency', 'class' => 'form-control currency', 'required']) !!}--}}
                        <select name="currency_id" class="form-control" id="currency_edit" required>
                            @foreach($currencies as $currency)
                                <option value="{{ $currency->id }}" >{{ $currency->currency_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-12">
                        {!! Form::label('amount', __('messages.plan.amount').':') !!}<span class="text-danger">*</span>
                        {!! Form::text('amount', null, ['id'=>'editAmount','class' => 'form-control amount','required','min' => '1']) !!}
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnEditSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" id="btnEditCancel" class="btn btn-light ml-1"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
