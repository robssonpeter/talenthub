<div class="d-md-flex d-block justify-content-between">
    <h1 id="candidateName">{{ $user->full_name }}</h1>
    <a href="javascript:void(0)" class="editGeneralBtn"><i class="fas fa-user-edit fa-lg"></i></a>
</div>
<div class="mt-3">
    <p class="mb-1" id="candidateProfessionalTitle">{{ $user->candidate->professional_title}}</p>
    <p class="mb-1" id="candidateLocation">{{ $user->candidate->full_location}}</p>
    <p class="mb-1" id="cadidateEmail">{{ $user->email}}</p>
    <p id="candidatePhone">{{ $user->phone}}</p>
</div>
<div id="candidateObjectiveDiv">
@if($user->candidate->objective && strlen($user->candidate->objective->description))
    <div class="mt-3 border-bottom mb-3 d-flex justify-content-between">
        <h5 class="mt-2">{{ __('messages.candidate.career_objective') }}</h5>
    </div>
    <div id="candidateObjectiveDiv">
        <p>{{$user->candidate->objective->description}}</p>
    </div>
@endif
</div>
<div class="mt-3 border-bottom mb-3">
    <h5 class="mt-2">{{ __('messages.candidate.candidate_skill') }}</h5>
</div>
<div id="candidateSkillDiv">
    @if($user->candidateSkill)
        <ul class="pl-3">
            @foreach($user->candidateSkill as $skill)
                <li class="font-weight-bold">{{ $skill->name }}</li>
            @endforeach
        </ul>
    @endif
</div>
