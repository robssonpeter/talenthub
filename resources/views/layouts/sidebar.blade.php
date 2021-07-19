@php
    if(Auth::user()->hasRole('Admin')){
        $type = 'admin';
    }else{
        $type = 'staff';
    }
@endphp
<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <img src="{{ getLogoUrl() }}" width="70px" class="navbar-brand-full"/>&nbsp;&nbsp;
        <a href="{{ url('/') }}">{{ getSettingValue('application_name') }}</a>
        <div class="input-group px-3">
            <input type="text" class="form-control searchTerm" id="searchText" placeholder="Search Menu"
                   autocomplete="off">
            <div class="input-group-append">
                <div class="input-group-text">
                    <i class="fas fa-search search-sign"></i>
                    <i class="fas fa-times close-sign"></i>
                </div>
            </div>
            <div class="no-results mt-3 ml-1">No matching records found</div>
        </div>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ url('/') }}" class="small-sidebar-text">
            <img class="navbar-brand-full" src="{{ getLogoUrl() }}" alt="{{config('app.name')}}"/>
        </a>
    </div>
    <ul class="sidebar-menu mt-3">
        <li class="side-menus {{ Request::is($type.'/dashboard*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route($type.'.dashboard') }}"><i class="fas fa fa-digital-tachograph"></i>
                <span>{{ __('messages.dashboard') }}</span></a></li>
    </ul>
    <ul class="sidebar-menu">
        <li class="nav-item dropdown side-menus">
            <a class="nav-link has-dropdown" href="#"><i class="fas fa-user-tie"></i>
                <span>{{ __('messages.employers') }}</span>
            </a>
            <ul class="dropdown-menu side-menus">
                <li class="side-menus {{ Request::is($type.'/companies*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ $type == 'admin'? route('company.index') : route('staff.company.index') }}">
                        <i class="fas fa-user-friends"></i>
                        <span>{{ __('messages.employers') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is($type.'/companies/verification') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route($type.'.company.verify') }}">
                        <i class="fas fa-check"></i>
                        <span>{{ __('messages.employer_menu.verification') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is($type.'/reported-company*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ $type == 'admin'? route('reported.companies') : route('staff.reported.companies') }}">
                        <i class="fas fa-file-signature"></i>
                        <span> {{ __('messages.company.reported_employers') }}</span>
                    </a>
                </li>
                @if($type == 'admin')
                <li class="side-menus {{ Request::is($type.'/staff-users*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ $type == 'admin'? route('staff.index') :  route('staff.reported.companies')}}">
                        <i class="fas fa-users"></i>
                        <span> {{ __('messages.staff_users') }}</span>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        <li class="nav-item dropdown side-menus">
            <a class="nav-link has-dropdown" href="#"><i class="fas fa-users"></i>
                <span>{{ __('messages.candidates') }}</span>
            </a>
            <ul class="dropdown-menu side-menus">
                <li class="side-menus {{ Request::is($type.'/candidates*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ $type == 'admin'? route('candidates.index') : route('staff.candidates.index') }}">
                        <i class="fas fa-user-circle"></i>
                        <span>{{ __('messages.candidates') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is($type.'/candidates*') ? 'active' : '' }}">
                    <a target="_blank" class="nav-link" href="{{ route('front.candidate.lists') }}">
                        <i class="fas fa-search"></i>
                        <span>{{ __('messages.find_candidates') }}</span>
                    </a>
                </li>
                @if($type == 'admin')
                <li class="side-menus {{ Request::is($type.'/required-degree-level*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ $type == 'admin'? route('requiredDegreeLevel.index') : route('requiredDegreeLevel.index') }}">
                        <i class="fas fa-user-graduate"></i>
                        <span>{{ __('messages.required_degree_levels') }}</span>
                    </a>
                </li>
                @endif
                <li class="side-menus {{ Request::is($type.'/reported-candidate*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ $type == 'admin' ? route('reported.candidates') : route('staff.reported.candidates') }}">
                        <i class="fas fa-file-signature"></i>
                        <span>{{ __('messages.candidate.reported_candidates') }}</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item side-menus dropdown">
            <a class="nav-link has-dropdown" href="#"><i class="fas fa-briefcase"></i>
                <span>{{ __('messages.jobs') }}</span>
            </a>
            <ul class="dropdown-menu side-menus">
                <li class="side-menus {{ Request::is($type.'/jobs*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route($type.'.jobs.index') }}">
                        <i class="fas fa-briefcase"></i>
                        <span>{{ __('messages.jobs') }}</span>
                    </a>
                </li>
                @if(Auth::user()->hasRole('Admin'))
                <li class="side-menus {{ Request::is($type.'/job-categories*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('job-categories.index') }}">
                        <i class="fas fa-sitemap"></i>
                        <span>{{ __('messages.job_categories') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is($type.'/job-types*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('jobType.index') }}">
                        <i class="fas fa-list-alt"></i>
                        <span>{{ __('messages.job_types') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is($type.'/job-tags*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('jobTag.index') }}">
                        <i class="fas fa-tags"></i>
                        <span>{{ __('messages.job_tags') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is($type.'/job-shifts*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('jobShift.index') }}">
                        <i class="fas fa-clock"></i>
                        <span>{{ __('messages.job_shifts') }}</span>
                    </a>
                </li>
                @endif
                <li class="side-menus {{ Request::is($type.'/reported-jobs*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ $type == 'admin' ? route('reported.jobs') : route('staff.reported.jobs') }}">
                        <i class="fab fa-r-project"></i>
                        <span>{{ __('messages.reported_jobs') }}</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item side-menus dropdown">
            <a class="nav-link has-dropdown" href="#"><i class="fab fa-usps"></i>
                <span>{{ __('messages.post.blog') }}</span>
            </a>
            <ul class="dropdown-menu side-menus">
                <li class="side-menus {{ Request::is($type.'/post-categories*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ $type == 'admin' ? route('post-categories.index') : route($type.'.post-categories.index') }}">
                        <i class="far fa-list-alt"></i>
                        <span> {{ __('messages.post_category.post_categories') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is($type.'/posts*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ $type == 'admin' ? route('posts.index') : route('staff.posts.index')}}">
                        <i class="fas fa-blog"></i>
                        <span> {{ __('messages.post.posts') }}</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item side-menus dropdown">
            <a class="nav-link has-dropdown" href="#"><i class="fas fa-solar-panel"></i>
                <span>{{ __('messages.plan.subscriptions') }}</span>
            </a>
            <ul class="dropdown-menu side-menus">
                <li class="side-menus {{ Request::is($type.'/plans*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('plans.index') }}">
                        <i class="fab fa-bandcamp"></i>
                        <span>{{ __('messages.subscriptions_plans') }}</span>
                    </a>
                </li>
                @if($type == 'admin')
                <li class="side-menus {{ Request::is($type.'/transactions*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('transactions.index') }}">
                        <i class="fas fa-money-bill-wave"></i>
                        <span>{{ __('messages.transactions') }}</span>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @if(Auth::user()->hasRole('Admin'))
        <li class="side-menus {{ Request::is($type.'/subscribers*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('subscribers.index') }}">
                <i class="fas fa-bell"></i>
                <span>{{ __('messages.subscribers') }}</span>
            </a>
        </li>

        <li class="nav-item dropdown side-menus">
            <a class="nav-link has-dropdown" href="#"><i class="fas fa-cogs"></i>
                <span>{{ __('messages.general') }}</span>
            </a>
            <ul class="dropdown-menu side-menus">
                <li class="side-menus {{ Request::is($type.'/marital-status*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('educationInstitution.index') }}">
                        <i class="fas fa-school"></i>
                        <span>{{ __('messages.education_institutions') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is($type.'/marital-status*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('maritalStatus.index') }}">
                        <i class="fas fa-life-ring"></i>
                        <span>{{ __('messages.marital_statuses') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is($type.'/skills*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('skills.index') }}">
                        <i class="fas fa-clipboard-list"></i>
                        <span>{{ __('messages.skills') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is($type.'/salary-periods*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('salaryPeriod.index') }}">
                        <i class="fas fa-calendar-alt"></i>
                        <span>{{ __('messages.salary_periods') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is($type.'/industries*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('industry.index') }}">
                        <i class="fas fa-landmark"></i>
                        <span>{{ __('messages.industries') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is($type.'/certificate-categories*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('cert-category.index') }}">
                        <i class="fas fa-certificate"></i>
                        <span>{{ __('messages.candidate_profile.certificate_categories') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is($type.'/company-sizes*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('companySize.index') }}">
                        <i class="fas fa-list-ol"></i>
                        <span>{{ __('messages.company_sizes') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is($type.'/functional-area*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('functionalArea.index') }}">
                        <i class="fas fa-chart-pie"></i>
                        <span>{{ __('messages.functional_areas') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is($type.'/career-levels*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('careerLevel.index') }}">
                        <i class="fas fa-level-up-alt"></i>
                        <span>{{ __('messages.career_levels') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is($type.'/salary-currencies*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('salaryCurrency.index') }}">
                        <i class="fas fa-money-bill"></i>
                        <span>{{ __('messages.salary_currencies') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is($type.'/ownership-types*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('ownerShipType.index') }}">
                        <i class="fas fa-universal-access"></i>
                        <span>{{ __('messages.ownership_types') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is($type.'/languages*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('languages.index') }}">
                        <i class="fas fa-language"></i>
                        <span>{{ __('messages.languages') }}</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item dropdown side-menus">
            <a class="nav-link has-dropdown" href="#"><i class="fas fa-users-cog"></i>
                <span>{{ __('messages.cms') }}</span>
            </a>
            <ul class="dropdown-menu side-menus">
                <li class="side-menus {{ Request::is($type.'/testimonials*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('testimonials.index') }}">
                        <i class="fas fa-sticky-note"></i>
                        <span>{{ __('messages.testimonials') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is($type.'/image-sliders*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('image-sliders.index') }}">
                        <i class="far fa-images"></i>
                        <span>{{ __('messages.image_sliders') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is($type.'/noticeboards*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('noticeboards.index') }}">
                        <i class="fas fa-clipboard"></i>
                        <span>{{ __('messages.noticeboards') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is($type.'/faqs*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('faqs.index') }}">
                        <i class="fas fa-question-circle"></i>
                        <span> {{ __('messages.faq.faq') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is($type.'/inquires*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('inquires.index') }}">
                        <i class="fab fa-linkedin"></i>
                        <span> {{ __('messages.inquires') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is($type.'/front-settings*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('front.settings.index') }}">
                        <i class="fas fa-cog"></i>
                        <span>{{ __('messages.setting.front_settings') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is($type.'/settings*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('settings.index') }}">
                        <i class="fas fa-sliders-h"></i>
                        <span>{{ __('messages.settings') }}</span>
                    </a>
                </li>
            </ul>
        </li>
        @endif
    </ul>
</aside>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ mix('assets/js/sidebar_menu_search/sidebar_menu_search.js') }}"></script>
