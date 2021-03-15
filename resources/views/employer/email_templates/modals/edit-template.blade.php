<div class="modal fade bd-example-modal-lg show" id="edit-template" style="z-index: 2000000000" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__("messages.common.edit_template")}}</h5>
                {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>--}}
            </div>
            <div id="templateContent" class="mx-2 py-2">
                <div id="loading-template">

                </div>
                {{Form::open(['id' => 'editTemplate'])}}
                {{Form::hidden('template_id', null, ['id' => 'edit_template_id'])}}
                <div class="form-group col-sm-12">
                    {{Form::label('name')}}
                    {{Form::text('name', null, ['id'=>'editTemplateName', 'class'=>'form-control', 'required'])}}
                </div>

                <div class="form-group col-sm-12">
                    {{Form::label(__('messages.common.template_type'))}}
                    {{Form::select('type', \App\Models\EmailTemplate::typesAssoc(), null, ['id'=>'editTemplateType', 'class'=>'form-control'])}}
                </div>

                <div class="form-group col-sm-12">
                    {{Form::label(__('messages.common.available_placeholders'), null, ['class' => 'w-100'])}}
                    <div id="edit-placeholder-columns">
                    @foreach(\App\Models\EmailTemplate::TYPES_TABLES[\App\Models\EmailTemplate::TYPES[0]]['columns'] as $column)
                        <small class=""><a class="btn btn-sm btn-primary mb-2 placeholder">{{$column}}</a></small>
                    @endforeach
                    </div>
                </div>
                <div class="form-group col-sm-12 mt-2">
                    <div id="editMessage" class="mb-3">
                        <p>Write your email template here!</p>
                    </div>
                    <input type="hidden" name="content" id="edit_email_template">
                </div>
                <button type="submit" class="invisible" style="height: 5px" id="submit-edit-template">submit</button>
                {{Form::close()}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary loading" id="save-template-edit" data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing...">{{__("messages.common.save_template")}}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("messages.common.close")}}</button>
            </div>
        </div>
    </div>
</div>
<script>
    /*function showLoader(){
        document.getElementById('notes-loader').classList.remove('d-none');
    }

    function hideLoader(){
        document.getElementById('notes-loader').classList.add('d-none');
    }*/

    function loadContent(content){
        document.getElementById('notesContent').innerHTML = content;
    }
</script>
