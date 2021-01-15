<div class="modal fade bd-example-modal-lg show" id="add-note" style="z-index: 2000000000" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__("messages.common.add_note")}}</h5>
                {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>--}}
            </div>
            <div id="notesViewContent" class="container mx-2 py-2">
                {{Form::open(['id' => 'add-note-form'])}}
                <div class="form-group col-sm-12">
                    {{Form::hidden('application_id', null, ['id' => 'note_application_id'])}}
                    {{ Form::text('description', null, ['class' => 'form-control','required','id' => 'note-description', "required" => true]) }}
                </div>
                {{Form::close()}}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary invisible" id="save-note">{{__("messages.common.save")}}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("messages.common.close")}}</button>
            </div>
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
