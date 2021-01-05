@extends('candidate.layouts.app')
@section('title')
    {{ __('messages.applied_job.applied_jobs') }}
@endsection
@push('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header d-md-flex flex-md-row">
            <h1 class="flex-md-fill">{{ __('messages.applied_job.applied_jobs') }}</h1>
            <a href="{{ route('front.search.jobs') }}" class="btn btn-primary">{{ __('messages.front_home.browse_jobs') }}</a>
        </div>
        <div class="section-body">
            @include('flash::message')
            <div class="card">
                <div class="card-body">
                    @include('candidate.applied_job.table')
                </div>
            </div>
        </div>
        @include('candidate.applied_job.templates.templates')
        @include('candidate.applied_job.show_applied_jobs_modal')

    </section>
@endsection
@push('scripts')
    <script>
        let candidateAppliedJobUrl = "{{ route('candidate.applied.job') }}";
        let JobTitleUrl = "{{ route('front.job.details') }}";
        let statusArray = JSON.parse('@json($statusArray)');
        let jobDetailsUrl = "{{ route('front.job.details') }}";
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/candidate/applied-jobs.js')}}"></script>
@endpush
