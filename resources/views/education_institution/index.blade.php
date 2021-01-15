@extends('layouts.app')
@section('title')
    {{ __('messages.salary_currencies') }}
@endsection
@push('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.education_institutions') }}</h1>
            <div class="section-header-breadcrumb">
                <a href="#" class="btn btn-primary form-btn addSalaryCurrencyModal">{{ __('messages.common.add') }}
                    <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('education_institution.table')
                </div>
            </div>
        </div>
        @include('education_institution.templates.templates')
        @include('education_institution.add_modal')
        @include('education_institution.edit_modal')
    </section>
@endsection
@push('scripts')
    <script>
        let educationInstitutionUrl = "{{ route('educationInstitution.index') }}/";
        let educationInstitutionSaveUrl = "{{ route('educationInstitution.store') }}";
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    {{--<script src="{{mix('assets/js/salary_currencies/education_institutions.js')}}"></script>
    <script src="{{mix('assets/js/salary_currencies/education_institutions.js')}}"></script>--}}
    <script src="{{ asset('assets/js/education_institutions/education_institutions.js') }}"></script>
@endpush
