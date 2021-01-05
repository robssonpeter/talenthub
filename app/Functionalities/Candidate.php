<?php
namespace App\Functionalities;
use App\Models\Candidate as Candid;
use App\Models\CandidateEducation as Education;
use App\Models\CandidateExperience as Experience;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class Candidate
{
    public static function profileCompletion($user_id){
        $candidate = Candid::where('user_id', $user_id)->first();
        $user = User::find($user_id);
        $education = Education::where('candidate_id', $candidate->id)->get();
        $experience = Experience::where('candidate_id', $candidate->id)->get();
        $language = DB::table('candidate_language')->where('user_id', $user_id)->get();
        $skills = DB::table('candidate_skills')->where('user_id', $user_id);
        $pictures = DB::table('media')->where('collection_name', 'profile-pictures')->where('model_id', $user_id)->get();
        $resumes = DB::table('media')->where('collection_name', 'resumes')->where('model_id', $candidate->id)->get();
        $certifications = DB::table('media')->where('collection_name', 'certifications')->where('model_id', $candidate->id)->get();
        $percentages = [
            'personal' => ['value' => 20, 'eligible' => $user->first_name],
            'skills' => ['value' => 10, 'eligible' => $skills->count()],
            'experience' => ['value' => 10, 'eligible' => $experience->count()],
            'education' => ['value' => 20, 'eligible' => $education->count()],
            'languages' => ['value' => 10, 'eligible' => $language->count()],
            'picture' => ['value' => 3, 'eligible' => $pictures->count()],
            'social' => ['value' => 2, 'eligible' => Self::hasSocialAccount(User::find($user_id))],
            'resumes' => ['value' => 20, 'eligible' => $resumes->count()],
            'certification' => ['value' => 5, 'eligible' => $certifications->count()]
        ];

        $sections = array_keys($percentages);
        $completion = 0;
        foreach ($sections as $section){
            if($percentages[$section]['eligible']){
                $completion += $percentages[$section]['value'];
            }
        }
        $candidate->update(['profile_completion' => $completion]);
        return $completion;
    }

    public static function hasSocialAccount(User $user){
        if(
            $user->facebook_url || $user->linkedin_url ||
            $user->twitter_url || $user->google_plus_url ||
            $user->pinterest_url
        ){
            return true;
        }
        return false;
    }
}
