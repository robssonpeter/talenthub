@extends('candidate.profile.index')
@push('page-css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.css') }}">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush
@section('section')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <a href="#cvModal" role="button" class="btn btn-primary cv-preview"
                               data-toggle="modal">{{ __('messages.common.preview') }}</a>
                        </div>
                        <div class="col-md-12 mt-5 shadow-lg p-md-5 p-3">
                            {{-- General Section --}}
                            <div id="candidateGeneralDiv">
                                @include('candidate.profile.career_informations.show_general')
                            </div>
                            <div class="d-none" id="editGeneralDiv">
                                @include('candidate.profile.career_informations.edit_general')
                            </div>
                            {{-- Education Section --}}
                            <div class="border-bottom my-3 d-flex justify-content-between ">
                                <h5 class="mt-2">{{ __('messages.candidate_profile.education') }}</h5>
                                <a href="javascript:void(0)" class="addEducationBtn">
                                    <i class="fas fa-plus-circle text-25px"></i>
                                </a>
                            </div>
                            <div class="section-body">
                                <div class="row candidate-education-container" id="candidateEducationsDiv">
                                    @include('candidate.profile.career_informations.show_education')
                                </div>
                                <div class="d-none" id="createEducationsDiv">
                                    @include('candidate.profile.career_informations.create_education')
                                </div>
                                <div class="d-none" id="editEducationsDiv">
                                    @include('candidate.profile.career_informations.edit_education')
                                </div>
                            </div>
                            {{-- Experience Section --}}
                            <div class="border-bottom my-3 d-flex justify-content-between">
                                <h5 class="mt-2">{{ __('messages.candidate_profile.experience') }}</h5>
                                <a href="javascript:void(0)" class="addExperienceBtn">
                                    <i class="fas fa-plus-circle text-25px"></i>
                                </a>
                            </div>
                            <div class="section-body">
                                <div class="row candidate-experience-container" id="candidateExperienceDiv">
                                    @include('candidate.profile.career_informations.show_experience')
                                </div>
                                <div class="d-none" id="createExperienceDiv">
                                    @include('candidate.profile.career_informations.create_experience')
                                </div>
                                <div class="d-none" id="editExperienceDiv">
                                    @include('candidate.profile.career_informations.edit_experience')
                                </div>
                            </div>
                            {{-- Achievement Section --}}
                            <div class="border-bottom my-3 d-flex justify-content-between">
                                <h5 class="mt-2">{{ __('messages.candidate_profile.career_achievements') }}</h5>
                                <a href="javascript:void(0)" class="addAchievementBtn">
                                    <i class="fas fa-plus-circle text-25px"></i>
                                </a>
                            </div>
                            <div class="section-body">
                                <div class="row candidate-achievement-container" id="candidateAchievementDiv">
                                    @include('candidate.profile.career_informations.show_achievement')
                                </div>
                                <div class="d-none" id="createAchievementDiv">
                                    @include('candidate.profile.career_informations.create_achievement')
                                </div>
                                <div class="d-none" id="editAchievementDiv">
                                    @include('candidate.profile.career_informations.edit_achievement')
                                </div>
                            </div>
                            {{-- Online Profile Section --}}
                            <div class="border-bottom my-3 d-flex justify-content-between">
                                <h5 class="mt-2">{{ __('messages.candidate_profile.online_profile') }}</h5>
                                <a href="javascript:void(0)" class="addOnlineProfileBtn">
                                    <i class="fas fa-plus-circle text-25px"></i>
                                </a>
                            </div>
                            <div class="section-body">
                                <div class="row" id="candidateOnlineProfileDiv">
                                    @include('candidate.profile.career_informations.show_online_profile')
                                </div>
                                <div class="d-none" id="addOnlineProfileDiv">
                                    @include('candidate.profile.career_informations.edit_online_profile')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('candidate.profile.modals.cv_preview_model')
    @include('candidate.profile.templates.templates')
@endsection
@push('page-scripts')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="https://unpkg.com/showdown/dist/showdown.min.js"></script>
    <script src="https://unpkg.com/turndown/dist/turndown.js"></script>
    <script>
        var qNewExperience = new Quill('#addExperienceAchievement', {
            placeholder: 'Type your achievements here',
            theme: 'snow'
        });
        var qEditExperience = new Quill('#editExperienceAchievement', {
            placeholder: 'Type your achievements here',
            theme: 'snow'
        });
        let candidateProfileUrl = "{{ route('candidate.edit.profile') }}";
        let candidateProgressUrl = "{{route('candidate.profile.completion')}}";
        let updateCandidateUrl = "{{ route('candidate.general.profile.update') }}";
        let updateonlineProfileUrl = "{{ route('candidate.online.profile.update') }}";
        let addExperienceUrl = "{{ route('candidate.create-experience') }}";
        let experienceUrl = "{{ url('candidate/candidate-experience') }}/";
        let addEducationUrl = "{{ route('candidate.create-education') }}";
        let addAchievementUrl = "{{ route('candidate.create-achievement') }}";
        let candidateUrl = "{{ url('candidate') }}/";
        let educationUrl = "{{ url('candidate/candidate-education') }}/";
        let achievementUrl = "{{ url('candidate/candidate-achievement') }}/";
        let present = "{{ __('messages.candidate_profile.present') }}";
        let countryId = '{{$user->country_id}}';
        let stateId = '{{$user->state_id}}';
        let cityId = '{{$user->city_id}}';
        let isEditProfile = true;
        let isEdit = false;
        let bootstarpUrl = "{{ asset('assets/css/bootstrap.min.css') }}";
        let customCssUrl = "{{ asset('assets/css/custom.css') }}";
        let styleCssUrl = "{{ asset('assets/web/css/style.css') }}";
        let fontCssUrl = "{{ asset('assets/css/font-awesome.min.css') }}";
        let cvTemplateUrl = "{{ route('candidate.cv.template') }}";
        let userId = "{{auth()->user()->id}}";
    </script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>
    <script src="{{mix('assets/js/candidate-profile/candidate-education-experience.js')}}"></script>
    <script src="{{mix('assets/js/candidate-profile/cv-builder.js')}}"></script>
@endpush
