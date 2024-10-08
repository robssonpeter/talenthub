<div class="col-md-8 col-xs-12 job-post-main">
    <div class="search-location pb20 d-flex flex-row">
        <input wire:model.debounce.100ms="searchByLocation" type="text" class="search-job-location p-2 form-control"
               placeholder="Location + Job title" id="searchByLocation">
        <button class="p-2 flex-shrink-1 btn btn-red  btn-medium reset-filter">{{ __('web.reset_filter') }}</button>
    </div>
    <h4>{{ __('web.job_menu.we_found') }} {{ ($jobs->total()) }} {{ __('web.jobs') }}.</h4>
    <div class="job-post-wrapper mt20">
        @forelse($jobs as $job)
            <div class="single-job-post row mt20 container-shadow m-sm-2">
                <div class="col-md-1 col-xs-3 nopadding mt5">
                    <div class="job-company">
                        <a href="{{ route('front.job.details',$job['job_id']) }}"
                           title="View Company Details">
                            @if( !$job['is_anonymous'])
                                <img src="{{ $job->company->company_url }}" alt="">
                            @elseif($job['is_anonymous'])
                                <img src="{{ asset('assets/img/infyom-logo.png') }}" alt="">
                            @endif
                        </a>
                    </div>
                </div>
                <div class="col-md-8 col-xs-6 ptb5 ml20">
                    <div class="job-title">
                        <a href="{{ route('front.job.details',$job['job_id']) }}">{{ $job['job_title'] }} </a>
                        @if( !$job['is_anonymous'])
                        <label class="text-muted">- {{ htmlspecialchars_decode($job->swap_company_name?$job->swap_company_name:$job->company->user->first_name) }}</label>
                        @endif
                    </div>

                    <div class="job-info">
                        <span class="location nomargin pt10"><i class="fa fa-map-marker"></i>
                            {{ (!empty($job->full_location)) ? $job->full_location : 'Location Info. not available.'}}
                        </span>
                        <br>
                        <span class="company pt10">
                            {!! nl2br(Str::limit($job['description'],120,'...')) !!}
                        </span>
                    </div>

                </div>
                <div class="col-md-2 col-xs-3 ptb5">
                    <div class="job-category">

                        <div class="job-category pull-left j-category-type">
                            <small class="text-muted font-weight-bolder">{{ __('messages.job.expires_on') }}</small>
                            <br>
                            <span class="font-weight-bolder">{{ date('jS M, Y', strtotime($job->job_expiry_date)) }}</span>
                        </div>
                        @if(!empty($job->jobShift))
                            <div class="job-category pull-left j-category-type irs-sing">
                                <a href="javascript:void(0)"
                                   class="mt15 btn btn-orange btn-small btn-effect">{{ $job->jobShift->shift }}</a>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-12 text-center">{{ __('web.job_menu.no_results_found') }}</div>
        @endforelse

        @if($jobs->count() > 0)
            {{$jobs->links() }}
        @endif
    </div>
</div>

