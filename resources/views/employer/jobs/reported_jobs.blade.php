@extends('layouts.app')
@section('title')
    {{ __('messages.reported_jobs') }}
@endsection
@push('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    @php
        if(Auth::user()->hasRole('Admin')){
            $type = 'admin';
        }else{
            $type = 'staff';
        }
    @endphp
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.reported_jobs') }}</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('employer.jobs.reported_jobs_table')
                </div>
            </div>
        </div>
        @include('employer.jobs.templates.templates')
        @include('employer.jobs.show_reported_job_modal')
    </section>
@endsection
@push('scripts')
    <script>
        let reportedJobsUrl = "{{ $type == 'admin' ? route('reported.jobs') : route('staff.reported.jobs') }}/";
        let frontJobDetail = "{{ route('front.job.details') }}";
        let frontCandidateDetail = "{{ url('candidate-details') }}";
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{mix('assets/js/jobs/reported_jobs.js')}}"></script>
@endpush

