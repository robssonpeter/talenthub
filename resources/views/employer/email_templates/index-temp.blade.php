@extends('employer.layouts.app')
@section('title')
    {{ __('messages.common.email_templates') }}
@endsection
@push('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush
@section('content')
    <section class="section">
        <div class="section-header d-flex">
            <h1 class="flex-fill">{{ __('messages.common.email_templates') }}</h1>
            <a class="btn btn-primary" data-toggle="modal" id="add-template-button" data-target="#add-template"><i class="fas fa-plus"></i> {{ __('messages.common.create_template') }}</a>
        </div>
        <div class="section-body">
            @include('flash::message')
            <div class="card">
                <div class="card-body">
                    @include('employer.email_templates.table')
                </div>
            </div>
        </div>
    </section>
    @include('employer.email_templates.modals.view-template')
    @include('employer.email_templates.modals.add-template')
    @include('employer.email_templates.modals.edit-template')
@endsection
@push('scripts')
    <script>
        let followersUrl = "{{  route('followers.index') }}";
        let templatesUrl = "{{route('email.templates.get')}}";
        let templateShowUrl = "{{route('email.template.get', '**id**')}}";;
        let candidateShowUrl = "{{  url('candidate-details') }}/";
        let placeholdersRetrieveUrl = "{{  route('email.template-placeholder.get', '**placeholder**') }}/";
        let templateSaveUrl = "{{  route('email.template.save') }}/";
        let templateDeleteUrl = "{{  route('email.template.delete', '**temp_id**') }}";
    </script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        var quill = new Quill('#message', {
            theme: 'snow'
        });
        var quillEdit = new Quill('#editMessage', {
            theme: 'snow'
        });
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{asset('assets/js/email_templates/templates.js')}}"></script>
@endpush

