@extends('employer.layouts.app')
@section('title')
    {{ __('messages.job_applications') }}
@endsection
@push('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
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
                    @include('employer.job_applications.table')
                </div>
            </div>
        </div>
        @include('employer.job_applications.templates.templates')

        {{--<div id="dialog" title="Basic dialog">
            <p>This is the default dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the &apos;x&apos; icon.</p>
        </div>--}}
    </section>
    <div class="modal fade bd-example-modal-lg show" id="coverLetter" style="z-index: 2000000000" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cover Letter</h5>
                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>--}}
                </div>
                <div id="coverLetterContent" class="container mx-2 py-2">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        let jobApplicationsUrl = "{{  route('job-applications', ['jobId' => $jobId]) }}";
        let view = "{{  __('messages.common.view') }}";
        let jobApplicationStatusUrl = "{{  url('employer/job-applications') }}/";
        let jobApplicationDeleteUrl = "{{  url('employer/job-applications') }}";
        let jobDetailsUrl = "{{  route('front.job.details') }}";
        let statusArray = JSON.parse('@json($statusArray)');
        let downloadDocumentUrl = "{{ url('employer/resume-download') }}";
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ asset('assets/js/custom/currency.js') }}"></script>
    <script src="{{mix('assets/js/job_applications/job_applications.js')}}"></script>
    <script>
        function viewCoverLetter(content){
            document.getElementById('coverLetterContent').innerHTML = content;
        }
        /*$(document).on('click', '.coverLetter', function (){
            $('#dialog').dialog();
        });*/
    </script>
@endpush

