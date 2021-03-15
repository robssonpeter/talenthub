<div id="addObjectiveModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.candidate.add_objective') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'addNewObjectiveForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="validationErrorsBox"></div>
                <div class="form-group">
                    {{ Form::label('objective',__('messages.candidate.career_objective').':') }}
                    {{ Form::textarea('objective', $user->candidate->objective?$user->candidate->objective->description:'', ['class' => 'form-control', 'onkeyup' => 'document.getElementById(\'objective-characters\').innerText = event.target.value.length','id'=>'candidate_objective', 'maxLength' => \App\Models\CandidateObjective::MAX_CHARACTERS, 'placeholder' => 'Max '.\App\Models\CandidateObjective::MAX_CHARACTERS.' characters']) }}
                    <small><strong>Characters: </strong></small><small id="objective-characters">{{$user->candidate->objective?strlen($user->candidate->objective->description):0}}</small>
                </div>
                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnObjectiveSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
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
