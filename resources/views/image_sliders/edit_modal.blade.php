<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imagesliderHeaders">{{__('messages.image_slider.edit_image_slider')}}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'editForm','files'=>true]) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="validationErrorsBox"></div>
                {{ Form::hidden('imageSliderId',null,['id'=>'imageSliderId']) }}
                <div class="row">
                    <div class="form-group col-sm-12">
                        <div class="row">
                            <div class="col-6">
                                {{ Form::label('image_slider', __('messages.image_slider.image').':') }}<span
                                        class="text-danger">*</span>
                                <span><i class="fas fa-question-circle ml-1"
                                         data-toggle="tooltip"
                                         data-placement="top"
                                         title="{{ __('messages.image_slider.image_title_text') }}"></i></span>
                                <label class="image__file-upload"> {{ __('messages.setting.choose') }}
                                    {{ Form::file('image_slider',['id'=>'editImageSlider','class' => 'd-none']) }}
                                </label>
                            </div>
                            <div class="col-6 col-xl-6 pl-0 mt-1">
                                <img id='editPreviewImage' class="img-thumbnail thumbnail-preview"
                                     src="{{ asset('assets/img/infyom-logo.png') }}">
                            </div>
                        </div>
                        <a href="#" target="_blank" id="imageSliderUrl"></a>
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('description', __('messages.image_slider.description').':') }}
                        {{ Form::textarea('description', null, ['class' => 'form-control', 'id' => 'editDescription']) }}
                    </div>
                </div>
                <div class="text-right mt-2 pt-2">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnEditSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" id="btnCancel" class="btn btn-light ml-1"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
