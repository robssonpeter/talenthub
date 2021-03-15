<a href="{{ route('front.company.details', $company->unique_id) }}">
    <div class="col-md-6 mt30 {{ ($loop->last && $loop->iteration % 2 != 0) ? 'col-md-offset-3' : '' }}">
        <div class="single-job-post row nomargin container-shadow">
            <div class="col-md-2 col-xs-3 nopadding">
                <img src="{{ str_replace('htts:', 'https:', asset($company->company_url)) }}" class="jobs-company-logo" alt="company logo">
            </div>
            <div class="col-md-10 col-xs-6 pt5 nopadding-right ">
                <div class="job-title d-flex flex-row">
                    <h6 class="text-dark flex-fill mr-3">{{ $company->user->first_name }}</h6>
                    @if($company->verification)
                    <img src="{{asset('assets/images/002-check.svg')}}" title="{{__('messages.verification.verified_employer')}}" style="height: 17px; width: 17px" alt="">
                    @endif
                </div>
                <div class="job-info pt5 pb5 nopadding-right">
                    <span class="location">
                        <i class="fa fa-map-marker"></i>
                        {{ (isset($company->location)) ? Str::limit($company->location,40,'...') : __('messages.common.n/a') }}
                    </span>
                    <br>
                    <span class="location websiteText">
                        <i class="fa fa-globe"></i>
                        {{ (isset($company->website)) ? Str::limit($company->website,40,'...') : __('messages.common.n/a') }}
                    </span>

                </div>

            </div>
            @if($company->activeFeatured)
                <img src="{{ asset('web/img/icons8-star-64.png') }}" class="featured-img"
                     data-toggle="tooltip" data-placement="bottom" title="Featured">
            @endif
            <span class="job-count pull-right">
                       {{ $company->jobs_count }} {{ __('web.companies_menu.opened_jobs') }}
            </span>
        </div>
    </div>
</a>
