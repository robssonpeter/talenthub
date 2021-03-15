@extends('employer.layouts.app')
@section('title')
    {{ __('messages.job_applications') }}
@endsection
@push('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush
@section('content')
    <section class="section ">
        <div class="section-header">
            <h1>
                <a href="{{  route('front.job.details',$job->job_id) }}"
                   class="font-weight-bold">{{$job->job_title}}</a> {{ __('messages.job_applications') }}
            </h1>
            <div class="section-header-breadcrumb">
                <a href="{{  route('job.edit',$job->id) }}"
                   class="btn btn-warning form-btn mr-2">{{ __('messages.job.edit_job') }}
                </a>
                <a href="{{ route('job.index') }}" class="btn btn-primary form-btn">{{ __('messages.common.back') }}
                </a>
            </div>
        </div>
        <div class="section-body">
            @include('flash::message')
            <div class="card">
                <div class="card-body">
                    @php
                        $types = \App\Models\JobApplication::STATUS;
                        $draftedIndex = array_search('Drafted', $types);
                        $appliedIndex = array_search('Applied', $types);
                        unset($types[$draftedIndex]);
                        unset($types[$appliedIndex]);
                        $types = array_values($types);
                    @endphp
                    <div class="w-25 float-right pb-2 d-none" id="bulk-action-div">
                        <select class="form-control" id="bulk-action-select">
                            <option value="">Bulk Action</option>
                            <option value="shortlisted">Shortlisted</option>
                            <option value="schedule_interview">Schedule Interview</option>
                            <option value="interviewed">Interviewed</option>
                            <option value="selected">Selected</option>
                            <option value="delete">Delete</option>
                        </select>
                    </div>
                    @include('employer.job_applications.table')
                </div>
            </div>
        </div>
        @include('employer.job_applications.templates.templates')

        {{--<div id="dialog" title="Basic dialog">
            <p>This is the default dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the &apos;x&apos; icon.</p>
        </div>--}}
    </section>
    @include('employer.job_applications.modals.add-note')
    @include('employer.job_applications.modals.notes')
    @include('employer.job_applications.modals.schedule-interview')
    <div class="modal fade bd-example-modal-lg show" id="coverLetter" style="z-index: 2000000000" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__("messages.applied_job.cover_letter")}}</h5>
                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>--}}
                </div>
                <div id="coverLetterContent" class="container mx-2 py-2">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("messages.common.close")}}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        let jobId = "{{$jobId}}";
        let jobApplicationsUrl = "{{  route('job-applications', ['jobId' => $jobId]) }}";
        let view = "{{  __('messages.common.view') }}";
        let jobApplicationStatusUrl = "{{  url('employer/job-applications') }}/";
        let jobApplicationDeleteUrl = "{{  url('employer/job-applications') }}";
        let jobDetailsUrl = "{{  route('front.job.details') }}";
        let statusArray = JSON.parse('@json($statusArray)');
        let downloadDocumentUrl = "{{ url('employer/resume-download') }}";
        let addNoteUrl = "{{route('note.save', '**appid**')}}";
        let noteSavedMessage = "{{__('messages.apply_job.note_saved')}}";
        let notesUrl = "{{route('notes.fetch', "**appid**")}}";
        let currentUser = "{{auth()->user()->id}}";
        let transApplicationNote = "{{__('messages.apply_job.application_note')}}";
        let interviewScheduleUrl = "{{route('interview.schedule')}}";
        let availableTemplatesUrl = "{{route('templates.available', '**type**')}}";
        let selectedApplications = [];
        let statuses = "{{json_encode(\App\Models\JobApplication::STATUS)}}";
        let parser = new DOMParser();
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ asset('assets/js/custom/currency.js') }}"></script>
    <script src="{{mix('assets/js/job_applications/job_applications.js')}}"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="https://unpkg.com/turndown/dist/turndown.js"></script>
    <script src="https://unpkg.com/showdown/dist/showdown.min.js"></script>
    <script>
        var toolbarOptions = [
            'bold', 'italic', 'underline',
            { 'list': 'ordered'},
            { 'list': 'bullet' },
            {'align': 'center'},
            {'align': 'right'},
            {'align': 'justify'}];
        /*var quill = new Quill('#coverLetterContent', {
            modules: {
                toolbar: toolbarOptions
            },
            placeholder: 'Type your cover letter here',
            theme: 'snow',
        });*/
    </script>
    {{--<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
    <script>
        let vue =  new Vue({
            el: "#coverLetterContent",
            data: {
                coverLetter: 'hellow',
            }
        })
    </script>--}}
    <script>
        function viewCoverLetter(content){
            let markdown = new showdown.Converter();
            let html = markdown.makeHtml(content);
            $('#coverLetterContent').html(html);
        }
        $(document).on('click', '.coverLetter', function(){
            let content = $(this).attr('data-content');
            viewCoverLetter(content);
        })
    </script>
@endpush

