@extends('employer.layouts.app')
@section('title')
    {{ __('messages.employer_dashboard.dashboard') }}
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.candidate.dashboard') }}</h1>
        </div>
        <div class="section-body">
            <div class="row mb-1">
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1 shadow-success">
                        <div class="card-icon bg-success">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('messages.employer_menu.total_jobs') }}</h4>
                            </div>
                            <div class="card-body employer-dashboard-card">
                                {{ isset($totalJobs)?$totalJobs:'0' }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1 shadow-primary">
                        <div class="card-icon bg-primary">
                            <i class="far fa-clock"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('messages.employer_dashboard.open_jobs') }}</h4>
                            </div>
                            <div class="card-body employer-dashboard-card">
                                {{ isset($jobCount)?$jobCount:'0' }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1 shadow-warning">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-pause-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('messages.employer_menu.paused_jobs') }}</h4>
                            </div>
                            <div class="card-body employer-dashboard-card">
                                {{ isset($pausedJobCount)?$pausedJobCount:'0' }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1 shadow-danger">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-window-close"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('messages.employer_menu.closed_jobs') }}</h4>
                            </div>
                            <div class="card-body employer-dashboard-card">
                                {{ isset($closedJobCount)?$closedJobCount:'0' }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1 shadow-info">
                        <div class="card-icon bg-info">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('messages.employer_dashboard.followers') }}</h4>
                            </div>
                            <div class="card-body employer-dashboard-card">
                                {{ isset($followersCount)?$followersCount:'0' }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1 shadow-dark">
                        <div class="card-icon bg-dark">
                            <i class="fas fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('messages.employer_menu.total_job_applications') }}</h4>
                            </div>
                            <div class="card-body employer-dashboard-card">
                                {{ isset($jobApplicationsCount)?$jobApplicationsCount:'0' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('messages.employer_menu.recent_jobs') }}</h4>
                        <div class="card-header-action">
                            <a href="{{ route('job.index') }}"
                               class="btn btn-primary">{{ __('messages.common.view_more') }} <i
                                        class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                    <div class="card-body p-0 mt-0">
                        <div class="table-responsive table-invoice table-bordered">
                            <table class="table table-striped mb-0">
                                <tbody>
                                <tr class="">
                                    <th>{{ __('messages.job.job_title') }}</th>
                                    <th>{{ __('messages.employer_menu.expires_on') }}</th>
                                    <th>{{ __('messages.common.status') }}</th>
                                </tr>
                                @if(count($recentJobs) > 0)
                                    @foreach($recentJobs as $recentJob)
                                        <tr>
                                            <td>
                                                <a href="{{ route('front.job.details',$recentJob->job_id) }}">{{ $recentJob->job_title }}</a>
                                            </td>
                                            <td>
                                                {{ Carbon\Carbon::parse($recentJob->job_expiry_date)->format('jS M, Y') }}
                                            </td>
                                            <td>
                                                <div
                                                        class="badge w-100 badge-{{\App\Models\Job::STATUS_COLOR[$recentJob->status]}}">
                                                    <span>{{ isset(\App\Models\Job::STATUS[$recentJob->status])?\App\Models\Job::STATUS[$recentJob->status]:'' }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            <span>{{ __('messages.employer_menu.no_data_available') }}.</span>
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('messages.employer_menu.recent_follower') }}</h4>
                        <div class="card-header-action">
                            <a href="{{ route('followers.index') }}"
                               class="btn btn-primary">{{ __('messages.common.view_more') }} <i
                                        class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                    <div class="card-body p-0 mt-0">
                        <div class="table-responsive table-invoice table-bordered">
                            <table class="table table-striped mb-0">
                                <tbody>
                                <tr class="">
                                    <th>{{ __('messages.company.candidate_name') }}</th>
                                    <th>{{ __('messages.company.candidate_phone') }}</th>
                                    <th>{{ __('messages.company.candidate_email') }}</th>
                                </tr>
                                @if(count($recentFollowers) > 0)
                                    @foreach($recentFollowers as $recentFollower)
                                        <tr>
                                            <td>
                                                {{ $recentFollower->user->full_name }}
                                            </td>
                                            <td>
                                                {{ $recentFollower->user->phone }}
                                            </td>
                                            <td>
                                                {{ $recentFollower->user->email }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            <span>{{ __('messages.employer_menu.no_data_available') }}.</span>
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

