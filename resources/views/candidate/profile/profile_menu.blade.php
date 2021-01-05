<div class="row mt-3">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body px-0 py-0">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a href="{{ route('candidate.profile',['section' => 'general']) }}"
                           class="nav-link {{ (isset($data['sectionName']) && $data['sectionName'] == 'general') ? 'active' : ''}}">
                            {{ __('messages.general') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('candidate.profile',['section' => 'resumes']) }}"
                           class="nav-link {{ (isset($data['sectionName']) && $data['sectionName'] == 'resumes') ? 'active' : ''}}">
                            {{ __('messages.apply_job.resume') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('candidate.profile',['section' => 'career_informations']) }}"
                           class="nav-link {{ (isset($data['sectionName']) && $data['sectionName'] == 'career_informations') ? 'active' : ''}}">
                            {{ __('messages.career_informations') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('candidate.profile',['section' => 'certifications']) }}"
                           class="nav-link {{ (isset($data['sectionName']) && $data['sectionName'] == 'certifications') ? 'active' : ''}}">
                            {{ __('messages.apply_job.certification') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('candidate.profile',['section' => 'cv_builder']) }}"
                           class="nav-link {{ (isset($data['sectionName']) && $data['sectionName'] == 'cv_builder') ? 'active' : ''}}">
                            {{ __('messages.cv_builder') }}
                        </a>
                    </li>
                </ul>
            </div>
            {{--<div class="py-2 container">
                <span>Profile Completion</span>
                <div id="circle" style=""></div>
            </div>--}}
            @php
            $candidate = \App\Models\Candidate::where('user_id', Auth::user()->id)->first()
            @endphp
            <div class="py-2 container">
                <span><strong>Profile Completion</strong></span>
                <div class="single-chart w-75">
                    <svg viewBox="0 0 36 36" class="circular-chart blue">
                        <path class="circle-bg"
                              d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831"
                        />
                        <path id="completion" class="circle"
                              stroke-dasharray="{{ $candidate->profile_completion }}, 100"
                              d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831"
                        />
                        <text x="18" y="20.35" class="percentage">{{ $candidate->profile_completion."%" }}</text>
                    </svg>
                </div>
            </div>

        </div>
    </div>
    <div class="col-md-9">
        @yield('section')
    </div>
</div>

