@extends('candidate.layouts.app')
@section('title')
    {{ __('messages.candidate.dashboard') }}
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/candidate-dashboard.css') }}">
    <style>

    </style>
@endpush
@section('content')
    <section class="section">
        <div class="section-header d-flex flex-md-row">
            <h1 class="flex-fill">{{ __('messages.candidate.dashboard') }}</h1>
            <a href="{{ route('front.search.jobs') }}" class="btn btn-primary hover-orange">{{ __('messages.front_home.browse_jobs') }}</a>
        </div>
        <div class="section-body">
            <div class="tickets dashboard">
                <div class="ticket-content w-100">
                    <div class="row col-12">
                        <div class="ticket-sender-picture  user-profile col-md-2 col-xl-2 col-sm-12 p-0">
                            <img class="profile-image"
                                 src="{{ getCompanyLogo() }}"
                                 alt="company logo">
                        </div>
                        <div class="ticket-detail col-md-7 col-xl-7 col-sm-12 ">
                            <div class="ticket-title">
                                <h2 class="text-primary">{{ $user->full_name }}</h2>
                            </div>
                            <div class="ticket-info">
                                <h6 class="location"><i
                                            class="fa fa-map-marker text-warning"></i>&nbsp;{{ !empty($candidate->city_name) ?  $candidate->city_name. ', '. $candidate->state_name . ', ' . $candidate->country_name : (!empty($candidate->country_id) ? $candidate->country_name : __('messages.candidate_dashboard.location_information')) }}
                                </h6>
                            </div>
                            <div class="font-weight-600 cell-phone">
                                <p class="mb-0"><i
                                            class="fa fa-phone text-warning"></i>&nbsp;{{ !empty($user->phone) ?  $user->phone : __('messages.candidate_dashboard.no_not_available') }}
                                </p>
                                <p class="text-red"><i class="fa fa-envelope text-warning"></i>&nbsp;{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="ml-auto col-md-3 col-xl-2 col-sm-12 edit-profile candidate-edit-profile">
                            <a href="{{ route('candidate.profile') }}" class="btn btn-outline-primary ml-5">
                                {{ __('messages.user.edit_profile') }}
                            </a>
                            <br><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1 shadow-success">
                        <div class="card-icon bg-success">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('messages.candidate_dashboard.profile_views') }}</h4>
                            </div>
                            <div class="card-body employer-dashboard-card">
                                {{ $user->profile_views }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <a href="{{route('favourite.companies')}}">
                    <div class="card card-statistic-1 shadow-primary">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('messages.candidate_dashboard.followings') }}</h4>
                            </div>
                            <div class="card-body employer-dashboard-card">
                                {{ $followings }}
                            </div>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <a href="{{route('candidate.profile')."?section=resumes"}}">
                    <div class="card card-statistic-1 shadow-dark">
                        <div class="card-icon bg-dark">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('messages.apply_job.resume') }}</h4>
                            </div>
                            <div class="card-body employer-dashboard-card">
                                {{ $resumes }}
                            </div>
                        </div>
                    </div>
                    </a>
                </div>

                {{--<div class="col-12 col-md-4 col-lg-4">
                    <div class="pricing">
                        <div class="pricing-padding">
                            <h3><i class="fa fa-eye"></i></h3>
                            <div class="pricing-price">
                                <div>{{ $user->profile_views }}</div>
                                <div>{{ __('messages.candidate_dashboard.profile_views') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="pricing pricing-highlight-candidate">
                        <div class="pricing-padding">
                            <h3><i class="fa fa-users"></i></h3>
                            <div class="pricing-price">
                                <div>{{$followings}}</div>
                                <div>{{ __('messages.candidate_dashboard.followings') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="pricing">
                        <div class="pricing-padding">
                            <h3><i class="fa fa-briefcase"></i></h3>
                            <div class="pricing-price">
                                <div>{{ $resumes }}</div>
                                <div>{{ __('messages.apply_job.resume') }}</div>
                            </div>
                        </div>
                    </div>
                </div>--}}
            </div>
        </div>
    </section>
@endsection
