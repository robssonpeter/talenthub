<div id="addRefereeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.candidate_profile.add_referee') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'addNewRefereeForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="validationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        {{ Form::label('referee_name', __('messages.common.name').':', ['class' => 'font-weight-bolder']) }}<span
                                class="text-danger">*</span>
                        {{ Form::text('name', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('position', __('messages.position.position').':', ['class' => 'font-weight-bolder']) }}<span
                                class="text-danger">*</span>
                        {{ Form::text('position', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('company', __('messages.company.company_name').':', ['class' => 'font-weight-bolder']) }}<span
                                class="text-danger">*</span>
                        {{ Form::text('company', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('email', __('messages.common.email').':', ['class' => 'font-weight-bolder']) }}<span
                            class="text-danger">*</span>
                        {{ Form::email('email', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('phone', __('messages.candidate.phone').':', ['class' => 'font-weight-bolder']) }}</br>
                        {{ Form::tel('phone', null, ['class' => 'form-control', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','id'=>'phoneNumber']) }}
                        {{ Form::hidden('region_code',null,['id'=>'prefix_code']) }}
                        <br>
                        <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
                        <span id="error-msg" class="hide"></span>
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('postal_address', __('messages.company.postal_address').':', ['class' => 'font-weight-bolder']) }}
                        {{ Form::text('postal_address', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnRefereeSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
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
