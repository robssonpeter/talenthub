@extends('candidate.profile.index')
@section('section')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-end">
                    <div class="section-header-breadcrumb mb-3">
                        <a href="#"
                           class="btn btn-primary form-btn uploadResumeModal">{{ __('messages.upload_attachment') }}
                            <i class="fas fa-plus"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="owl-carousel owl-theme" id="products-carousel">
                        <div class="row">
                        @if($data['certifications']->isNotEmpty())
                            @foreach($data['certifications'] as $resume)
                                    <div class="product-item pb-5 px-4">
                                        <div class="product-image image-type">
                                            <img alt="image"
                                                 src="{{ $resume->mime_type == 'application/pdf' ? asset('assets/img/pdf.png') : asset('assets/img/document.png')}}"
                                                 class="img-fluid">
                                        </div>
                                        <div class="product-details">
                                            <div class="product-name {{ ($resume->getCustomProperty('is_default') == true) ? 'text-primary' : '' }}">{{ ($resume->getCustomProperty('is_default') == true) ? $resume->getCustomProperty('title').'(Default)' : $resume->getCustomProperty('title') }}</div>
                                            <div class="text-muted text-small">{{ $resume->created_at->diffForHumans() }}</div>
                                            <div class="product-cta">
                                                <a href="{{ route('download.resume', ['media' => $resume->id]) }}"
                                                   class="btn btn-primary">
                                                    <i class="fas fa-file-download"></i></a>
                                                <a href="#" class="btn btn-danger delete-resume"
                                                   data-id="{{ $resume->id }}"><i class="fas fa-trash"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-12">
                                    <h4 class="product-item pb-5 d-flex justify-content-center">
                                        {{ __('messages.candidate.certification_not_found') }}
                                    </h4>
                                </div>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('candidate.profile.modals.upload_certificate_modal')
    </div>
@endsection
@push('page-scripts')
    <script>
        let resumeUploadUrl = "{{ route('candidate.certificates') }}";
    </script>
    <script src="{{mix('assets/js/candidate-profile/candidate-resume.js')}}"></script>
@endpush
