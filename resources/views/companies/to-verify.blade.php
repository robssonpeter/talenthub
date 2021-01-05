@extends('layouts.app')
@section('title')
    {{ __('messages.employers') }}
@endsection
@push('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/summernote.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.company.employer_to_verify') }}</h1>
        </div>
        <div class="section-body">
            @include('flash::message')
            <div class="card">
                <div class="card-body overflow-hidden">
                    @include('companies.table-to-verify')
                </div>
            </div>
        </div>
        @include('companies.templates.templates')
    </section>
@endsection
@push('scripts')
    <script>
        let companiesUrl = "{{ route('admin.company.verify') }}";
        let viewAttachment = "{{__('messages.verification.view_attachment')}}";
        let attachment = "{{__('messages.verification.attachment')}}";
        let attachmentDir = "{{asset('***')}}";
        let markVerified = "{{__('messages.verification.mark_verified')}}";
        let deleteAct = "{{__('messages.verification.delete')}}";
        let actions = "{{__('messages.verification.actions')}}";
        let verificationUrl = "{{route('admin.company.verify.save', '***')}}";
        let verifySuccess = "{{ __('messages.verification.verified_success') }}"
    </script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{asset('assets/js/companies/companies-to-verify.js')}}"></script>
@endpush

