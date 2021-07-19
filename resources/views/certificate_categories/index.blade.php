@extends('layouts.app')
@section('title')
    {{ __('messages.industries') }}
@endsection
@push('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/summernote.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.candidate_profile.certificate_categories') }}</h1>
            <div class="section-header-breadcrumb">
                <a href="#" class="btn btn-primary form-btn addIndustryModal">{{ __('messages.certificate_category.add') }}
                    <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('certificate_categories.table')
                </div>
            </div>
        </div>
        @include('certificate_categories.templates.templates')
        @include('certificate_categories.add_modal')
        @include('certificate_categories.edit_modal')
        @include('certificate_categories.show_modal')
    </section>
@endsection
@push('scripts')
    <script>
        let industryUrl = "{{ route('cert-category.index') }}/";
        let industrySaveUrl = "{{ route('cert-category.store') }}";
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{asset('assets/js/certificate_categories/categories.js')}}"></script>
@endpush
