<div class="modal fade bd-example-modal-lg show" id="add-interview" style="z-index: 2000000000" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="interviewModalLabel">{{__("messages.apply_job.schedule_interview")}}</h5>
                {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>--}}
            </div>
            {{Form::open(['id' => 'add-interview-form'])}}
            <div id="notesViewContent" class="mx-2 py-2">
                {{Form::hidden('application_id', null, ['id' => 'application_id'])}}
                <div class="form-group col-sm-12">
                    {{Form::label('interview_type', 'Interview Type')}}
                    {{Form::select('type', array_values(\App\Models\Interview::TYPE), null,['class' => 'form-control', 'required'])}}
                </div>
                <div class="form-group col-sm-12">
                    {{Form::label('date_and_time', 'Date and Time')}}
                    <div class="input-group">
                        {{Form::date('date', null, ['id' => 'interview_date', 'class' => 'form-control', 'required'])}}
                        <div class="input-group-prepend">
                            {{Form::time('time', null, ['id' => 'interview_time', 'class' => 'form-control', 'required'])}}
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-12">
                    {{Form::label('venue', 'Venue')}}
                    {{Form::text('venue', '', ['id'=>'interview_venue', 'class'=>'form-control', 'required'])}}
                </div>
                <div class="form-group col-sm-12">
                    {{Form::checkbox('email_notification', false, false, ['id' => 'email_notification'])}}
                    {{Form::label('email_notification_label', 'Send an email notification to candidate')}}
                </div>
                <div class="form-group col-sm-12" id="template-type-div">

                </div>


            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="save-interview" data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing...">{{__("messages.common.save")}}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("messages.common.close")}}</button>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>
<script>
    var currentApp;
    function showSaveButton(){
        let saveNoteButton = document.getElementById('save-note');
        let noteText = document.getElementById('note-description').value;
        if(noteText.length){
            saveNoteButton.classList.remove('invisible');
        }else{
            saveNoteButton.classList.add('invisible');
        }
    }

    function clearNote(){
        let noteText = document.getElementById('note-description');
        let applicationId = document.getElementById('note_application_id');
        noteText.value = '';
        applicationId.value = '';
    }

    function closeModal(){
        $('#add-note').modal('hide');
    }

    function currentApplication(app_id){
        let noteText = document.getElementById('note-description');
        let applicationId = document.getElementById('note_application_id');
        noteText.value = "";
        applicationId.value = app_id;
        /*if(currentApp != app_id){
            noteText.value = "";
        }
        currentApp = app_id;*/
    }

</script>
