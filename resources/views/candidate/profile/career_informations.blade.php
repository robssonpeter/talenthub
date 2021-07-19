@extends('candidate.profile.index')
@push('page-css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/inttel/css/intlTelInput.css') }}">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush
@section('section')
    <section class="section">
        <div class="section-header candidate-experience-header">
            <h1>{{ __('messages.candidate.career_objective') }}</h1>
            <div class="section-header-breadcrumb">
                <a href="#"
                   class="btn btn-primary form-btn addObjectiveModal" data-toggle="modal"
                   data-target="#addObjectiveModal">
                    @if(!$data['candidateObjective'])
                    {{ __('messages.candidate.add_objective') }}
                    <i class="fas fa-plus"></i>
                    @else
                        {{ __('messages.candidate.edit_objective') }}
                        <i class="fas fa-edit"></i>
                    @endif
                </a>
            </div>
        </div>
        <div class="section-body">
            <div class="row candidate-achievements-container">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 candidate-achievement"
                     data-id="{{ isset($data['candidateObjective']->id)?$data['candidateObjective']->id:'' }}">
                    <article class="article article-style-b">
                        <div class="article-details">
                            <p id="candidate-objective">
                                {{isset($data['candidateObjective']->description)?$data['candidateObjective']->description:''}}
                            </p>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section><br>
    <section class="section">
        <div class="section-header candidate-experience-header">
            <h1>{{ __('messages.candidate_profile.experience') }}</h1>
            <div class="section-header-breadcrumb">
                <a href="#"
                   class="btn btn-primary form-btn addExperienceModal" data-toggle="modal"
                   data-target="#addExperienceModal">{{ __('messages.candidate_profile.add_experience') }}
                    <i class="fas fa-plus"></i></a>
            </div>

        </div>
        <div class="section-body">
            <div class="row candidate-experience-container">
                @if($experience['T']['years'] || $experience['T']['months'])
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 candidate-experience">
                    <article class="article article-style-b">
                        <div class="article-details">
                            <span>Total Experience: {{$experience['T']['years']."Y ".$experience['T']['months']."M"}}</span>
                            <span class="float-right">(Y - Years, M - Months)</span>
                            <div class="py-1">
                                @foreach($expKeys as $key)
                                    @if(isset($industries[$key]))
                                    <span class="bg-secondary p-1 mt-1 text-nowrap rounded-pill">{{$industries[$key]." - ".$experience[$key]['years'].'Y '.$experience[$key]['months'].'M'}}</span>
                                    @elseif(is_numeric($key))
                                        <span class="bg-secondary p-1 mt-1 text-nowrap rounded-pill">{{"Unspecified Industry - ".$experience[$key]['years'].'Y '.$experience[$key]['months'].'M'}}</span>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </article>
                </div>
                @endif
                @forelse($data['candidateExperiences'] as $candidateExperience)
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 candidate-experience"
                         data-experience-id="{{ $loop->index }}" data-id="{{ $candidateExperience->id }}">
                        <article class="article article-style-b">
                            <div class="article-details">
                                <div class="article-title">
                                    <h5 class="text-primary">{{ $candidateExperience->experience_title }}</h5>
                                    <h6 class="text-muted">{{ htmlspecialchars_decode($candidateExperience->company) }}</h6>
                                </div>
                                <span class="text-muted">{{ \Carbon\Carbon::parse($candidateExperience->start_date)->format('jS M, Y')}} - </span>

                                @if($candidateExperience->currently_working)
                                    <span class="text-muted">{{ __('messages.candidate_profile.present') }}</span>
                                @else
                                    <span class="text-muted"> {{\Carbon\Carbon::parse($candidateExperience->end_date)->format('jS M, Y')}} </span>
                                @endif
                                <span> | {{ $candidateExperience->country }}</span>
                                @if(!empty($candidateExperience->description))
                                    <p class="mb-0">{!! Str::limit($candidateExperience->description,225,'...') !!}</p>
                                @endif

                                <div class="article-cta candidate-experience-edit-delete">
                                    <a href="javascript:void(0)" class="btn btn-warning action-btn edit-experience"
                                       data-id="{{ $candidateExperience->id }}"><i class="fa fa-edit p-1"></i></a>
                                    <a href="javascript:void(0)" class="btn btn-danger action-btn delete-experience"
                                       data-id="{{ $candidateExperience->id }}"><i class="fa fa-trash p-1"></i></a>
                                </div>
                                @if($candidateExperience->currently_working)
                                    <div class="d-flex ">
                                        <span class="text-success flex-fill"><strong>Currently works here</strong></span>
                                        <span class="btn-sm"><strong>{{$candidateExperience->duration}}</strong></span>
                                    </div>
                                @else
                                    <div class="d-flex ">
                                        <span class="text-success flex-fill"></span>
                                        <span class="btn-sm"><strong>{{$candidateExperience->duration}}</strong></span>
                                    </div>
                                @endif
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12" id="notfoundExperience">
                        <h4 class="product-item pb-5 d-flex justify-content-center">
                            Experience Not Available
                        </h4>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <br>
    <section class="section">
        <div class="section-header candidate-experience-header">
            <h1>{{ __('messages.candidate_profile.education') }}</h1>
            <div class="section-header-breadcrumb">
                <a href="#"
                   class="btn btn-primary form-btn addEducationModal" data-toggle="modal"
                   data-target="#addEducationModal">{{ __('messages.candidate_profile.add_education') }}
                    <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="row candidate-education-container">
                @forelse($data['candidateEducations'] as $candidateEducation)
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 candidate-education"
                         data-education-id="{{ $loop->index }}" data-id="{{ $candidateEducation->id }}">
                        <article class="article article-style-b">
                            <div class="article-details">
                                <div class="article-title">
                                    <h5 class="text-primary education-degree-level">{{ htmlspecialchars_decode($candidateEducation->institute) }}</h5>
                                    <h6 class="text-muted">{{ $candidateEducation->degree_title }}</h6>
                                </div>
                                <span class="text-muted">{{ $candidateEducation->currently_studying?'Current':$candidateEducation->year }} | {{ $candidateEducation->country }}</span>
                                <p class="mb-0">{{ $candidateEducation->degreeLevel->name }}</p>
                                <div class="article-cta candidate-education-edit-delete">
                                    <a href="javascript:void(0)" class="btn btn-warning action-btn edit-education"
                                       data-id="{{ $candidateEducation->id }}"><i class="fa fa-edit p-1"></i></a>
                                    <a href="javascript:void(0)" class="btn btn-danger action-btn delete-education"
                                       data-id="{{ $candidateEducation->id }}"><i class="fa fa-trash p-1"></i></a>
                                </div>
                                @if($candidateEducation->currently_studying)
                                    <span class="text-success"><strong>Currently studying</strong></span>
                                @endif
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12" id="notfoundEducation">
                        <h4 class="product-item pb-5 d-flex justify-content-center">
                            Education Not Available
                        </h4>
                    </div>
                @endforelse
            </div>
        </div>
    </section><br>
    <section class="section">
        <div class="section-header candidate-experience-header">
            <h1>{{ __('messages.candidate_profile.awards_and_certificates') }}</h1>
            <div class="section-header-breadcrumb">
                <a href="#"
                   class="btn btn-primary form-btn addAchievementModal" data-toggle="modal"
                   data-target="#addAchievementModal">{{ __('messages.candidate_profile.add') }}
                    <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="row candidate-achievements-container">
                @forelse($data['candidateAchievements'] as $candidateAchievement)
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 candidate-achievement"
                         data-referee-id="{{ $loop->index }}" data-id="{{ $candidateAchievement->id }}">
                        <article class="article article-style-b">
                            <div class="article-details">
                                <div class="article-title">
                                    <h6 class="text-muted">{{ $candidateAchievement->title }}</h6>
                                </div>
                                @if($candidateAchievement->institution)
                                    <p class="mb-0">{{ $candidateAchievement->institution?$candidateAchievement->institution->name:"" }} - <span class="{{$candidateAchievement->ongoing?'text-success':''}}">{{(int) $candidateAchievement->ongoing?"On Going":date('M, d Y', strtotime($candidateAchievement->completion_date))}}</span></p>
                                @endif
                                @if($candidateAchievement->valid_until)
                                    <span><strong>Valid Until: </strong>{{date_create($candidateAchievement->valid_until)->format('F jS Y')}}</span>
                                @endif
                                <div class="article-cta candidate-achievement-edit-delete">
                                    @if($candidateAchievement->attachment_id)
                                    <a href="javascript:void(0)" id="{{ \Spatie\MediaLibrary\Models\Media::find($candidateAchievement->attachment_id)->getFullUrl() }}" class="btn document btn-success action-btn view-achievement-attachment"
                                       data-id="{{ $candidateAchievement->id }}" data-toggle="modal" data-target="#document" title="view attachment"><i class="fa fa-paperclip p-1"></i></a>
                                    @endif
                                    <a href="javascript:void(0)" class="btn btn-warning action-btn edit-achievement"
                                       data-id="{{ $candidateAchievement->id }}"><i class="fa fa-edit p-1"></i></a>
                                    <a href="javascript:void(0)" class="btn btn-danger action-btn delete-achievement"
                                       data-id="{{ $candidateAchievement->id }}"><i class="fa fa-trash p-1"></i></a>
                                </div>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12" id="notfoundAchievement">
                        <h4 class="product-item pb-5 d-flex justify-content-center">
                            Awards Not Available
                        </h4>
                    </div>
                @endforelse
            </div>
        </div>
    </section><br>
    <section class="section">
        <div class="section-header candidate-experience-header">
            <h1>{{ __('messages.candidate_profile.reference') }}</h1>
            <div class="section-header-breadcrumb">
                <a href="#"
                   class="btn btn-primary form-btn addRefereeModal" data-toggle="modal"
                   data-target="#addRefereeModal">{{ __('messages.candidate_profile.add_referee') }}
                    <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="row candidate-referees-container">
                @forelse($data['candidateReferees'] as $candidateReferee)
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 candidate-referee"
                         data-referee-id="{{ $loop->index }}" data-id="{{ $candidateReferee->id }}">
                        <article class="article article-style-b">
                            <div class="article-details">
                                <div class="article-title">
                                    <h4 class="text-primary education-degree-level">{{ $candidateReferee->name }}</h4>
                                    <h6 class="text-muted">{{ $candidateReferee->position }}</h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted"><i class="fas fa-phone"></i> {{ $candidateReferee->region_code.$candidateReferee->phone }}</span>
                                    <span class="text-muted"><i class="fas fa-at"></i> {{ $candidateReferee->email }}</span>
                                    @if($candidateReferee->postal_address)
                                    <span class="text-muted"><i class="fas fa-envelope-open"></i> {{ $candidateReferee->postal_address }}</span>
                                    @endif
                                </div>

                                <p class="mb-0">{{ $candidateReferee->company }}</p>
                                <div class="article-cta candidate-education-edit-delete">
                                    <a href="javascript:void(0)" class="btn btn-warning action-btn edit-referee"
                                       data-id="{{ $candidateReferee->id }}"><i class="fa fa-edit p-1"></i></a>
                                    <a href="javascript:void(0)" class="btn btn-danger action-btn delete-referee"
                                       data-id="{{ $candidateReferee->id }}"><i class="fa fa-trash p-1"></i></a>
                                </div>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12" id="notfoundReferee">
                        <h4 class="product-item pb-5 d-flex justify-content-center">
                            Reference Not Available
                        </h4>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    @include('candidate.profile.modals.add_experience_modal')
    @include('candidate.profile.modals.add_education_modal')
    @include('candidate.profile.modals.add_referee_modal')
    @include('candidate.profile.modals.add_achievement_modal')
    @include('candidate.profile.modals.add_objective_modal')
    @include('candidate.profile.modals.edit_referee_modal')
    @include('candidate.profile.modals.edit_achievement_modal')
    {{--@include('candidate.profile.modals.edit_objective_modal')--}}
    @include('candidate.profile.modals.edit_experience_modal')
    @include('candidate.profile.modals.edit_education_modal')
    @include('candidate.profile.templates.templates')
@endsection
@push('page-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
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
        var turndownService = new TurndownService();
        var converter = new showdown.Converter();
        /*function toMarkown(html){
            let markdown = turndownService.turndown(html);
            return markdown;
        }
        alert(toMarkown('<h1>hellow there</h1>'));*/
    </script>
    <script>
        let addExperienceUrl = "{{ route('candidate.create-experience') }}";
        let experienceUrl = "{{ url('candidate/candidate-experience') }}/";
        let addEducationUrl = "{{ route('candidate.create-education') }}";
        let addRefereeUrl = "{{ route('candidate.create-referee') }}";
        let addAchievementUrl = "{{ route('candidate.create-achievement') }}";
        let addObjectiveUrl = "{{ route('candidate.create-objective') }}";
        let candidateUrl = "{{ url('candidate') }}/";
        let educationUrl = "{{ url('candidate/candidate-education') }}/";
        let refereeUrl = "{{ url('candidate/candidate-referee') }}/";
        let achievementUrl = "{{ url('candidate/candidate-achievement') }}/";
        let present = "{{ __('messages.candidate_profile.present') }}";
        let isEdit = false;
        let userId = "{{auth()->user()->id}}";
        let candidateProgressUrl = "{{route('candidate.profile.completion')}}";
        let utilsScript = "{{asset('assets/js/inttel/js/utils.min.js')}}";
        let newExperienceAchievement = document.getElementById('addExperienceAchievement');
        let attachmentUploadUrl = "{{ route('candidate.certificates') }}";
    </script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{mix('assets/js/candidate-profile/candidate_career_informations.js')}}"></script>
    <script src="{{ mix('assets/js/custom/phone-number-country-code.js') }}"></script>
    <script src="{{ asset('assets/js/inttel/js/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('assets/js/inttel/js/utils.min.js') }}"></script>
@endpush
