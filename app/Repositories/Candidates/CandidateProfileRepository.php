<?php

namespace App\Repositories\Candidates;

use App\Models\Candidate;
use App\Models\CandidateAchievement;
use App\Models\CandidateEducation;
use App\Models\CandidateExperience;
use App\Models\CandidateReferee;
use App\Models\ExperienceFunctionalArea;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Functionalities\Candidate as CandidateFunction;

/**
 * Class CandidateProfileRepository
 */
class CandidateProfileRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'experience',
        'industry_id',
        'functional_area_id',
        'current_salary',
        'expected_salary',
        'immediate_available',
        'is_active',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Candidate::class;
    }

    /**
     * @param  array  $input
     *
     * @return mixed
     */
    public function createExperience($input)
    {
        $input['currently_working'] = isset($input['currently_working']) ? 1 : 0;
        $input['candidate_id'] = Auth::user()->owner_id;
        $input['end_date'] = (! empty($input['end_date'])) ? $input['end_date'] : null;

        $candidateExperience = CandidateExperience::create($input);
        $candidateExperience->country = getCountryName($candidateExperience->country_id);

        // add functional Areas
        $experience = CandidateExperience::find($candidateExperience->id);

        CandidateFunction::profileCompletion(Auth::user()->id);

        return $candidateExperience;
    }

    /**
     * @param  array  $input
     *
     * @return Builder|Model|object
     */
    public function createEducation($input)
    {
        $input['candidate_id'] = Auth::user()->owner_id;

        /** @var CandidateEducation $education */
        $education = CandidateEducation::create($input);

        CandidateFunction::profileCompletion(Auth::user()->id);

        return $this->getEducation($education);
    }

    /**
     * @param  CandidateEducation  $candidateEducation
     *
     * @return Builder|Model|object
     */
    public function getEducation(CandidateEducation $candidateEducation)
    {
        return CandidateEducation::with('degreeLevel')
            ->where('id', $candidateEducation->id)->first();
    }

    public function createReferee($input)
    {
        $input['candidate_id'] = Auth::user()->owner_id;

        /** @var CandidateEducation $education */
        $referee = CandidateReferee::create($input);

        CandidateFunction::profileCompletion(Auth::user()->id);

        return $this->getReferee($referee);
    }

    public function getReferee(CandidateReferee $candidateReferee)
    {
        return CandidateReferee::where('id', $candidateReferee->id)->first();
    }

    public function createAchievement($input)
    {
        $input['candidate_id'] = Auth::user()->owner_id;

        if(isset($input['ongoing'])){
            $input['ongoing'] = 1;
        }else{
            $input['ongoing'] = 0;
        }

        /** @var CandidateEducation $education */
        $achievement = CandidateAchievement::create($input);

        CandidateFunction::profileCompletion(Auth::user()->id);

        return $this->getAchievement($achievement);
    }

    public function getAchievement(CandidateAchievement $candidateAchievement)
    {
        return CandidateAchievement::where('id', $candidateAchievement->id)->first();
    }

}
