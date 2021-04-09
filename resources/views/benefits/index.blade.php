@extends('layouts.app')
@section('title')
    {{ __('messages.marital_statuses') }}
@endsection
@push('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/summernote.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.benefits.benefit') }}</h1>
            <div class="section-header-breadcrumb">
                <a href="#"
                   class="btn btn-primary form-btn addBenefitModal">{{ __('messages.marital_status.add') }}
                    <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('benefits.table')
                </div>
            </div>
        </div>
        @include('benefits.templates.templates')
        @include('benefits.add_modal')
        @include('benefits.edit_modal')
        @include('benefits.show_modal')
    </section>
@endsection
@push('scripts')
    <script>
        let benefitUrl = "{{ route('benefit.index') }}/";
        let benefitSaveUrl = "{{ route('benefit.store') }}";
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{asset('assets/js/benefits/benefits.js')}}"></script>
@endpush
