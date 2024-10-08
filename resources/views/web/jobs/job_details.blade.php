@extends('web.layouts.app')
@section('title')
    {{ $job->job_title." Job" }}
@endsection
@section('description')
    {{ strip_tags($job->description) }}
@endsection
{{--<meta property="og:title" content="European Travel Destinations">--}}
{{--<meta property="og:description" content="{{ $job->description }}">--}}
{{--<meta property="og:image" content="http://euro-travel-example.com/thumbnail.jpg">
<meta property="og:url" content="http://euro-travel-example.com/index.htm">--}}
@section('content')
    <!-- ===== Start of Main Wrapper Job Section ===== -->
    <section class="ptb15 bg-gray" id="job-page">
        <div class="container mTop">
            @if($job->is_suspended || !$isActive)
                <div class="row">
                    <div class="alert alert-warning text-warning bg-transparent" role="alert">
                        {{ __('web.job_details.job_is') }} <strong> {{\App\Models\Job::STATUS[$job->status]}}.</strong>
                    </div>
                </div>
            @endif
            @if(Session::has('warning'))
                <div class="alert alert-warning" role="alert">
                    {{ Session::get('warning') }}
                    <a href="{{ route('candidate.profile',['section'=> 'resumes']) }}"
                       class="alert-link ml-2 ">{{ __('web.job_details.click_here') }}</a> {{ __('web.job_details.to_upload_resume') }}
                    .
                </div>
            @endif

        <!-- Start of Row -->
            <div class="row">

                <!-- ===== Start of Job Details ===== -->
                <div class="col-md-8 col-xs-12">

                    <!-- Start of Company Info -->
                    <div class="row company-info job-d-info container-shadow">

                        <!-- Jobjob-page Company Image -->
                        <div class="col-md-3">
                            <div class="job-company">
                                <a href="#">
                                    <img src="{{ $job->is_anonymous?asset('assets/img/infyom-logo.png'):$job->company->company_url }}" alt="">
                                </a>
                            </div>
                        </div>

                        <!-- Job Company Info -->
                        <div class="col-md-9">
                            <div class="job-company-info mt10">
                                <h3 class="capitalize">{{ Str::limit($job->job_title,50,'...') }}</h3>
                                @if($job->industry)
                                    <h5>{{ htmlspecialchars_decode($job->industry->name) }} Industry</h5>
                                @endif
                                @auth
                                    @role('Candidate')
                                    <ul class="social-btns list-inline mt5">
                                        <li class="">
                                            <button class="btn label label-info btn-primary"
                                                    data-toggle="modal"
                                                    data-target="#emailJobToFriendModal">{{ __('web.job_details.email_to_friend') }}
                                            </button>
                                        </li>
                                        <li class="">
                                            <button class="btn btn-danger reportJobAbuse {{ ($isJobReportedAsAbuse) ? 'disabled' : '' }}"
                                                    data-toggle="modal"
                                                    data-target="#reportJobAbuseModal">{{ __('web.job_details.report_abuse') }}
                                            </button>
                                        </li>
                                        @if(!$isJobApplicationRejected)
                                            <li class="">
                                                <button class="btn btn-orange btn-effect"
                                                        data-favorite-user-id="{{ (getLoggedInUserId() !== null) ? getLoggedInUserId() : null }}"
                                                        data-favorite-job-id="{{ $job->id }}" id="addToFavourite">
                                                    <span class="favouriteText"></span>
                                                </button>
                                            </li>
                                        @endif
                                    </ul>
                                    @endrole
                                @endauth


                            </div>
                        </div>
                        <div class="form-group pt10 col-md-12 pt-20 text-justify">
                            @if($job->summary)
                                <h5>Summary</h5>
                            <div class="form-group">
                                <p class="mt-2">
                                    {!! nl2br($job->summary) !!}
                                </p>
                            </div>
                            @endif

                            @if($job->description)
                                <h5>{{__('messages.job.responsibilities')}}</h5>
                                <div class="form-group">
                                <p class="mt-2">{!! nl2br($job->description) !!} </p>
                                </div>
                            @else
                                <p>N/A</p>
                            @endif
                                @if($job->qualifications)
                                    <h5>{{__('messages.job.qualifications')}}</h5>
                                <div class="form-group">
                                    <p class="mt-2">
                                        {!! nl2br($job->qualifications) !!}
                                    </p>
                                </div>
                                @endif
                                @if($job->additional_information)
                                    <h5>{{__('messages.job.additional_information')}}</h5>
                                    <div class="form-group">
                                        <p class="mt-2">
                                            {!! nl2br($job->additional_information) !!}
                                        </p>
                                    </div>
                                @endif
                                @if($job->benefits != '[]' && is_array(json_decode($job->benefits)) )
                                    @php
                                    $benefits = App\Models\Benefit::pluck('name', 'id');
                                    @endphp
                                    <h5>Benefits</h5>
                                    <ul>
                                        @foreach(json_decode($job->benefits) as $benefit)
                                            <li>{{$benefits[$benefit]}}</li>
                                        @endforeach
                                    </ul>
                                @endif
                        </div>

                    </div>
                    <div class="row mt15">
                        <div class="col-md-12">
                            <h4 class="font-weight-bold">{{ __('web.job_details.job_details') }}</h4>
                            <hr/>
                        </div>
                        <div class="col-md-8 mt5">

                            @if($job->industry)
                            <div class="row">
                                <div class="col-md-5">
                                    <h6>{{ Form::label('job_category_id', __('messages.industry.show_industry').':') }}</h6>
                                </div>
                                <div class="col-md-7"><h6>{{ $job->industry?$job->industry->name:'' }}</h6></div>
                            </div>
                            @endif

                            <div class="row">
                                <div class="col-md-5">
                                    <h6>{{ Form::label('job_category_id', __('messages.job_category.job_category').':') }}</h6>
                                </div>
                                <div class="col-md-7"><h6>{{ $job->jobCategory->name }}</h6></div>
                            </div>
                            @if($job->careerLevel)
                                <div class="row">
                                    <div class="col-md-5">
                                        <h6>{{ Form::label('career_level_id', __('messages.job.career_level').':') }}</h6>
                                    </div>
                                    <div class="col-md-7"><h6>{{ $job->careerLevel->level_name }}</h6></div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-5">
                                    <h6>{{ Form::label('job_shift_id', __('messages.job_tag.show_job_tag').':') }}</h6>
                                </div>
                                <div class="col-md-7">
                                    <h6>{{ ($job->jobsTag->isNotEmpty()) ? $job->jobsTag->pluck('name')->implode(', ') : __('messages.common.n/a') }}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <h6>{{ Form::label('job_type', __('messages.job.job_type').':') }}</h6>
                                </div>
                                <div class="col-md-7">
                                    <h6>{{ ($job->jobType) ? $job->jobType->name : __('messages.common.n/a') }}</h6>
                                </div>
                            </div>
                            @if($job->jobShift)
                                <div class="row">
                                    <div class="col-md-5">
                                        <h6>{{ Form::label('job_shift_id', __('messages.job.job_shift').':') }}</h6>
                                    </div>
                                    <div class="col-md-7"><h6>{{ $job->jobShift->shift }}</h6></div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-5">
                                    <h6>{{ Form::label('functional_area_id', __('messages.job.functional_area').'s:') }}</h6>
                                </div>
                                <div class="col-md-7">
                                    @foreach($job->functionalAreas as $functionalArea)
                                    <h6>{{$functionalArea->details->name}}</h6>
                                    @endforeach
                                </div>
                            </div>
                            @if($job->degreeLevel)
                                <div class="row">
                                    <div class="col-md-5">
                                        <h6>{{ Form::label('degree_level_id', __('messages.job.degree_level').':') }}</h6>
                                    </div>
                                    <div class="col-md-7"><h6>{{ $job->degreeLevel->name }}</h6></div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-5">
                                    <h6>{{ Form::label('position', __('messages.positions').':') }}</h6>
                                </div>
                                <div class="col-md-7"><h6>{{ isset($job->position)?$job->position:'0' }}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <h6>{{ Form::label('position', __('messages.job_experience.job_experience').':') }}</h6>
                                </div>
                                <div class="col-md-7"><h6>
                                        {{ isset($job->experience) ? $job->experience .' '. __('messages.candidate_profile.year') :'No experience' }}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <h6>{{ Form::label('salary_period_id', __('messages.job.salary_period').':') }}</h6>
                                </div>
                                <div class="col-md-7"><h6>{{ $job->salaryPeriod->period }}</h6></div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <h6>{{ Form::label('is_freelance', __('messages.job.is_freelance').':') }}</h6>
                                </div>
                                <div class="col-md-7">
                                    <h6>{{ $job->is_freelance == 1 ? __('messages.common.yes') : __('messages.common.no') }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Company Info -->

                </div>
                <!-- ===== End of Job Details ===== -->

                <!-- ===== Start of Job Sidebar ===== -->
                <div class="col-md-4 col-xs-12">

                    <!-- Start of Job Sidebar -->
                    <div class="job-sidebar">
                        <ul class="job-overview nopadding mt5 mb5">
                            <li>
                                <h5><i class="fa fa-calendar text-purple"></i>{{ __('web.job_details.date_posted') }}:</h5>
                                <span>{{ date('jS M, Y', strtotime($job->created_at)) }}</span>
                            </li>

                            <li>
                                <h5><i class="fa fa-map-marker text-purple"></i>{{ __('web.common.location') }}:</h5>
                                <span>
                                    @if (!empty($job->city_id))
                                        {{$job->city_name}} ,
                                    @endif

                                    @if (!empty($job->state_id))
                                        {{$job->state_name}},
                                    @endif

                                    @if (!empty($job->country_id))
                                        {{$job->country_name}}
                                    @endif

                                    @if(empty($job->country_id))
                                        Location Information not available.
                                    @endif
                                </span>
                            </li>
                            <li>
                                <h5><i class="fa fa-calendar text-purple"></i>{{ __('messages.job.expires_on') }}:</h5>
                                <span>{{ date('jS M, Y', strtotime($job->job_expiry_date)) }}</span>
                            </li>

                            <li>
                                <h5><i class="fa fa-cogs text-purple"></i> {{ __('web.job_details.job_skills') }}:</h5>
                                @if($job->jobsSkill->isNotEmpty())
                                    <span>{{$job->jobsSkill->pluck('name')->implode(', ') }}</span>
                                @else
                                    <p>N/A</p>
                                @endif
                            </li>

                            @if(!$job->hide_salary)
                                <li>
                                    <h5><i class="fa fa-money text-purple"></i> {{ __('web.job_details.salary') }}:</h5>
                                    <span>{{ number_format($job->salary_from) . ' - ' . number_format($job->salary_to) }}</span>
                                    <b>({{ $job->currency->currency_name }})</b>
                                    <p><small class="text-danger">This is a net figure</small></p>
                                </li>
                            @endif
                        </ul>
                        <h5>{{ __('web.apply_for_job.share_this_job') }}</h5>
                        <ul class="social-btns list-inline mt10">
                            <li>
                                <a href="{{ $url['facebook'] }}"
                                   class="social-btn-roll facebook transparent border-22px" target="_blank">
                                    <div class="social-btn-roll-icons">
                                        <i class="social-btn-roll-icon fa fa-facebook"></i>
                                        <i class="social-btn-roll-icon fa fa-facebook"></i>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $url['gmail'] }}"
                                   class="social-btn-roll google transparent border-22px" target="_blank">
                                    <div class="social-btn-roll-icons">
                                        <i class="social-btn-roll-icon fa fa-google"></i>
                                        <i class="social-btn-roll-icon fa fa-google"></i>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $url['pinterest'] }}"
                                   class="social-btn-roll pinterest transparent border-22px" target="_blank">
                                    <div class="social-btn-roll-icons">
                                        <i class="social-btn-roll-icon fa fa-pinterest"></i>
                                        <i class="social-btn-roll-icon fa fa-pinterest"></i>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $url['twitter'] }}" class="social-btn-roll twitter transparent border-22px"
                                   target="_blank">
                                    <div class="social-btn-roll-icons">
                                        <i class="social-btn-roll-icon fa fa-twitter"></i>
                                        <i class="social-btn-roll-icon fa fa-twitter"></i>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/shareArticle/?url={{ rawurlencode(URL::to('/job-details/'.$job->job_id ))}}"
                                   class="social-btn-roll linkedin transparent border-22px" target="_blank">
                                    <div class="social-btn-roll-icons">
                                        <i class="social-btn-roll-icon fa fa-linkedin"></i>
                                        <i class="social-btn-roll-icon fa fa-linkedin"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        @auth
                            @role('Candidate')
                                @if(!$isApplied && !$isJobApplicationRejected && ! $isJobApplicationCompleted)
                                    <div class="mt20">
                                        @if(isset($candidate->profile_completion) && $candidate->profile_completion<80)
                                            <button
                                                class="btn {{ $isJobDrafted ? 'btn-red' : 'btn-purple' }} btn-block btn-effect"
                                                onclick="profileIncomplete()">
                                                {{ $isJobDrafted ? __('web.job_details.edit_draft') : __('web.job_details.apply_for_job') }}
                                            </button>
                                        @elseif($isActive && !$job->is_suspended && \Carbon\Carbon::today()->toDateString() < $job->job_expiry_date->toDateString())
                                            @if($job->application_method == 0)
                                                <button
                                                    class="btn {{ $isJobDrafted ? 'btn-red' : 'btn-purple' }} btn-block btn-effect"
                                                    onclick="window.location='{{ route('show.apply-job-form', $job->job_id) }}'">
                                                    {{ $isJobDrafted ? __('web.job_details.edit_draft') : __('web.job_details.apply_for_job') }}
                                                </button>
                                            @elseif($job->application_method == 1)
                                            <button
                                                class="btn label label-info {{ $isJobDrafted ? 'btn-red' : 'btn-purple' }} btn-block btn-effect"
                                                onclick="window.open('{{ $job->url }}', '_blank')">
                                                {{ $isJobDrafted ? __('web.job_details.edit_draft') : __('web.job_details.apply_for_job') }}
                                            </button>
                                            @endif
                                        @endif
                                        @if(!$isApplied && \Carbon\Carbon::today()->toDateString() > $job->job_expiry_date->toDateString() || $job->is_suspended)
                                                {{--<div class="text-danger bg-danger py-4">
                                                    <span>This job no longer accepts applications</span>
                                                </div>--}}
                                                <div class="mt20">
                                                    <p>
                                                        <button class="btn btn-danger btn-block btn-effect">{{ __('web.job_details.applications_closed') }}</button>
                                                    </p>
                                                </div>
                                        @endif
                                    </div>
                                @else
                                    <div class="mt20">
                                        <p>
                                            <button class="btn btn-green btn-block btn-effect">{{ __('web.job_details.already_applied') }}</button>
                                        </p>
                                    </div>
                                @endif
                            @endrole
                        @else
                            @if($isActive && !$job->is_suspended && \Carbon\Carbon::today()->toDateString() < $job->job_expiry_date->toDateString())
                                <div class="mt20">
                                    <button class="btn btn-purple btn-block"
                                            onclick="window.location='{{ route('front.register') }}'">{{ __('web.job_details.register_to_apply') }}
                                    </button>
                                </div>
                            @else
                            @endif
                        @endauth
                    </div>
                    <!-- Start of Job Sidebar -->

                    <!-- ===== Start of Company Overview ===== -->
                    @if(!$job->is_anonymous)
                    <div>
                        <div class="job-sidebar mt20">
                            <h5>{{ __('web.job_details.company_overview') }}</h5>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <a href="{{ route('front.company.details', $job->company->unique_id) }}">
                                        <img src="{{ $job->company->company_url }}"
                                             class="c-company-image company-image"/>
                                    </a>

                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 mt10">
                                    <a href="{{ route('front.company.details', $job->company->unique_id) }}">
                                        <h5 class="text-primary">
                                            {{ htmlspecialchars_decode($job->company->user->first_name) }}
                                            @if($job->company->verification)
                                                <img src="{{asset('assets/images/002-check.svg')}}" title="{{__('messages.verification.verified_employer')}}" style="margin-left:5px; height: 15px; width: 15px" alt="">
                                            @endif
                                        </h5>

                                    </a>
                                    <div class="text-dark c-company-p pt10 pb10">
                                        <i class="fa fa-map-marker"></i>
                                        <span>
                                            @if (!empty($job->company->city_name))
                                                {{$job->company->city_name}} ,
                                            @endif

                                            @if (!empty($job->company->state_name))
                                                {{$job->company->state_name}},
                                            @endif

                                            @if (!empty($job->company->country_name))
                                                {{$job->company->country_name}}
                                            @endif

                                            @if(empty($job->company->country_name))
                                                {{ __('web.job_details.location_information_not_available') }}
                                            @endif
                                        </span>
                                    </div>
                                    <h6>
                                        <a href="{{ route('front.company.details', $job->company->unique_id) }}"><span
                                                    class="label label-info mt20">{{ $jobsCount }} {{ __('web.companies_menu.opened_jobs') }}</span></a>
                                    </h6>
                                    <hr/>
                                    <p>
                                        {!! nl2br($job->company->details) !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <!-- ===== End of Company Overview ===== -->
                </div>
            </div>
                <!-- End of Row -->

                @auth
                    @role('Candidate')
                    @include('web.jobs.email_to_friend')
                    @include('web.jobs.report_job_modal')
                    @endrole
                @endauth
                @if(!$job->is_anonymous)
                <div class="row mt40 mb30">
                    <div class="col-md-12 text-center">
                        <h3 class="pb5">{{ __('web.job_details.related_jobs') }}</h3>
                    </div>
                </div>
                <!-- Start of Row -->
                <div class="row nomargin job-post-wrapper mt10">
                    <!-- Start of Job Post Wrapper -->
                    @if(count($getRelatedJobs)>0)
                        @foreach($getRelatedJobs as $job)
                            @include('web.common.job_card')
                        @endforeach
                        <div class="row ">
                            <div class="col-md-12 text-center pt30">
                                <a href="{{ route('front.search.jobs') }}"
                                   class="btn btn-purple btn-effect">{{ __('web.common.show_all') }}</a>
                            </div>
                        </div>
                    @else
                        <div class="related-job-not-found">
                            <h5 class="text-center">{{ __('web.job_details.related_job_not_available') }}</h5>
                        </div>
                    @endif
                </div>
                    <!-- End of Job Post Wrapper -->
            <!-- End of Row -->
                @endif

        </div>
    </section>
@endsection
@section('scripts')
    <script>
        let addJobFavouriteUrl = "{{ route('save.favourite.job') }}";
        let reportAbuseUrl = "{{ route('report.job.abuse') }}";
        let emailJobToFriend = "{{ route('email.job') }}";
        let isJobAddedToFavourite = "{{ $isJobAddedToFavourite }}";
        let removeFromFavorite = "{{ __('web.job_details.remove_from_favorite') }}";
        let addToFavorites = "{{ __('web.job_details.add_to_favorite') }}";
        let profileCompletion = "{{ isset($candidate->profile_completion)?$candidate->profile_completion:null }}";
        let profileIncompleteMessage = "{{__('web.job_details.messages.profile_not_complete')}}";
        let candidateProfileUrl = "{{route('candidate.profile')}}";
    </script>
    <script src="{{ mix('assets/js/jobs/front/job_details.js') }}"></script>
@endsection
