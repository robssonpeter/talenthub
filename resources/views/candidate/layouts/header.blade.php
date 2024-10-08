<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar mb-0 pb-0">
    <a href="{{ route('front.home') }}" class="navbar-brand sidebar-gone-hide">{{ config('app.name') }}</a>
    <div class="navbar-nav">
        <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
    </div>
    <ul class="navbar-nav navbar-right ml-auto nav-item">
        @if(\Illuminate\Support\Facades\Auth::user())
            <li class="dropdown">
                <a href="#" data-toggle="dropdown"
                   class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <img alt="image" src="{{ getLoggedInUser()->avatar }}"
                         class="rounded-circle mr-1 user-thumbnail">
                    <div class="d-sm-none d-lg-inline-block">
                        {{ __('messages.common.hi') }}, {{\Illuminate\Support\Facades\Auth::user()->first_name}}</div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-title">
                        {{ __('messages.common.welcome') }}
                        , {{\Illuminate\Support\Facades\Auth::user()->full_name}}</div>
                    <a class="dropdown-item has-icon editProfileModal" href="#" data-id="{{ getLoggedInUserId() }}">
                        <i class="fa fa-user"></i>{{ __('messages.user.edit_profile') }}</a>
                    <a class="dropdown-item has-icon changePasswordModal" href="#"
                       data-id="{{ getLoggedInUserId() }}"><i
                                class="fa fa-lock"> </i>{{ (Str::limit(__('messages.user.change_password'),20,'...')) }}
                    </a>
                    <a class="dropdown-item has-icon changeLanguageModal" href="#"
                       data-id="{{ getLoggedInUserId() }}"><i
                                class="fa fa-language"> </i>{{ (Str::limit(__('messages.user_language.change_language'),20,'...')) }}
                    </a>
                    <a href="{{ url('logout') }}" class="dropdown-item has-icon text-danger"
                       onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> {{ __('messages.user.logout') }}
                    </a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                        {{ csrf_field() }}
                    </form>
                </div>
            </li>
        @else
            <li class="dropdown"><a href="#" data-toggle="dropdown"
                                    class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    {{--                <img alt="image" src="#" class="rounded-circle mr-1">--}}
                    <div class="d-sm-none d-lg-inline-block">{{ __('messages.common.hello') }}</div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-title">{{ __('messages.common.login') }}
                        / {{ __('messages.common.register') }}</div>
                    <a href="{{ route('login') }}" class="dropdown-item has-icon">
                        <i class="fas fa-sign-in-alt"></i> {{ __('messages.common.login') }}
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('register') }}" class="dropdown-item has-icon">
                        <i class="fas fa-user-plus"></i> {{ __('messages.common.register') }}
                    </a>
                </div>
            </li>
        @endif
    </ul>
</nav>
<nav class="navbar navbar-secondary navbar-expand-lg">
    <div class="container">
        <ul class="navbar-nav">

            <li class="nav-item {{ Request::is('candidate/dashboard*') ? 'active' : ''}}">
                <a href="{{ route('dashboard') }}"
                   class="nav-link {{ Request::is('candidate/dashboard*') ? 'active' : ''}}">
                    <i class="fab fa-dashcube"></i>
                    <span>{{ __('messages.candidate.dashboard') }}</span></a>
            </li>
            <li class="nav-item {{ Request::is('candidate/profile*') ? 'active' : ''}}">
                <a href="{{ route('candidate.profile') }}"
                   class="nav-link {{ Request::is('candidate/profile*') ? 'active' : ''}}">
                    <i class="far fa-user-circle"></i>
                    <span>{{ __('messages.profile') }}</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('candidate/favourite-jobs*') ? 'active' : ''}}">
                <a href="{{ route('favourite.jobs') }}"
                   class="nav-link {{ Request::is('candidate/favourite-jobs*') ? 'active' : ''}}">
                    <i class="far fa-star"></i>
                    <span>{{ __('messages.favourite_jobs') }}</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('candidate/favourite-companies*') ? 'active' : ''}}">
                <a href="{{ route('favourite.companies') }}"
                   class="nav-link {{ Request::is('candidate/favourite-companies*') ? 'active' : ''}}">
                    <i class="far fa-building"></i>
                    <span>{{ __('messages.favourite_companies') }}</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('candidate/applied-job*') ? 'active' : ''}}">
                <a href="{{ route('candidate.applied.job') }}"
                   class="nav-link {{ Request::is('candidate/applied-job*') ? 'active' : ''}}">
                    <i class="fas fa-briefcase"></i>
                    <span>{{ __('messages.applied_job.applied_jobs') }}</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('candidate/job-alert*') ? 'active' : ''}}">
                <a href="{{ route('candidate.job.alert') }}"
                   class="nav-link {{ Request::is('candidate/job-alert*') ? 'active' : ''}}">
                    <i class="far fa-bell"></i>
                    <span>{{ __('messages.job.job_alert') }}</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
