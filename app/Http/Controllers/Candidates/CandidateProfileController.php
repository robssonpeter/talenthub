<?php

namespace App\Http\Controllers\Candidates;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateCandidateEducationRequest;
use App\Http\Requests\CreateCandidateExperienceRequest;
use App\Models\Candidate;
use App\Models\CandidateEducation;
use App\Models\CandidateExperience;
use App\Models\CandidateObjective;
use App\Models\CandidateReferee;
use App\Models\CandidateAchievement;
use App\Repositories\Candidates\CandidateProfileRepository;
use App\Functionalities\Candidate as CandidateFunction;

class CandidateProfileController extends AppBaseController
{
    /** @var  CandidateProfileRepository */
    private $candidateProfileRepository;

    public function __construct(CandidateProfileRepository $candidateProfileRepo)
    {
        $this->candidateProfileRepository = $candidateProfileRepo;
    }

    /**
     * @param  CreateCandidateExperienceRequest  $request
     *
     * @return mixed
     */
    public function createExperience(CreateCandidateExperienceRequest $request)
    {
        $input = $request->all();
        $input['end_date'] = empty($input['end_date']) ? date('Y-m-d') : $input['end_date'];
        $candidateExperience = $this->candidateProfileRepository->createExperience($input);

        return $this->sendResponse($candidateExperience, 'Candidate Experience added successfully.');
    }

    /**
     * @param  CandidateExperience  $candidateExperience
     *
     * @return mixed
     */
    public function editExperience(CandidateExperience $candidateExperience)
    {
        return $this->sendResponse($candidateExperience, 'Candidate Experience retrieved successfully.');
    }

    /**
     * @param  CandidateExperience  $candidateExperience
     * @param  CreateCandidateExperienceRequest  $request
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function updateExperience(
        CandidateExperience $candidateExperience,
        CreateCandidateExperienceRequest $request
    ) {
        $input = $request->all();
        $input['end_date'] = empty($input['end_date']) ? date('Y-m-d') : $input['end_date'];
        $data['id'] = $candidateExperience->id;
        $input['industry_id'] = request()->industry_id;
        $candidateExperience->delete();

        $data['candidateExperience'] = $this->candidateProfileRepository->createExperience($input);

        return $this->sendResponse($data, 'Candidate Experience updated successfully.');
    }

    /**
     * @param  CandidateExperience  $candidateExperience
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function destroyExperience(CandidateExperience $candidateExperience)
    {
        $id = $candidateExperience->id;
        $candidateExperience->delete();

        CandidateFunction::profileCompletion(\Auth::user()->id);

        return $this->sendResponse($id, 'Candidate Experience deleted successfully.');
    }

    /**
     * @param  CreateCandidateEducationRequest  $request
     *
     * @return mixed
     */
    public function createEducation(CreateCandidateEducationRequest $request)
    {
        $input = $request->all();

        $candidateEducation = $this->candidateProfileRepository->createEducation($input);
        $candidateEducation->country = getCountryName($candidateEducation->country_id);

        return $this->sendResponse($candidateEducation, 'Candidate Education added successfully.');
    }
    /**
     * @param  CreateCandidateRefereeRequest  $request
     *
     * @return mixed
     */
    public function createReferee()
    {
        $input = request()->all();

        $candidateReferee = $this->candidateProfileRepository->createReferee($input);
        //$candidateReferee->country = getCountryName($candidateEducation->country_id);

        return $this->sendResponse($candidateReferee, 'Candidate Referee added successfully.');
    }

    public function editReferee(CandidateReferee $candidateEducation)
    {
        $reference = $this->candidateProfileRepository->getReferee($candidateEducation);

        return $this->sendResponse($reference, 'Candidate Reference retrieved successfully.');
    }

    public function updateReferee(CandidateReferee $candidateReferee)
    {
        $input = request()->all();
        $data['id'] = $candidateReferee->id;
        $candidateReferee->delete();
        $data['candidateReferee'] = $this->candidateProfileRepository->createReferee($input);

        return $this->sendResponse($data, 'Candidate Referee updated successfully.');
    }

    public function destroyReferee(CandidateReferee $candidateReferee)
    {
        $id = $candidateReferee->id;
        $candidateReferee->delete();

        CandidateFunction::profileCompletion(\Auth::user()->id);

        return $this->sendResponse($id, 'Candidate Referee deleted successfully.');
    }


    public function createObjective()
    {
        $input = request()->all();

        $candidate = Candidate::where('user_id', \Auth::user()->id)->first();

        $candidateObjective = CandidateObjective::updateOrCreate(['candidate_id' => $candidate->id], ['description' => $input['objective']]);

        return $this->sendResponse($candidateObjective, 'Candidate Objective updated successfully.');
    }

    public function createAchievement()
    {
        $input = request()->all();

        $candidateAchievement = $this->candidateProfileRepository->createAchievement($input);

        return $this->sendResponse($candidateAchievement, 'Candidate Achievement added successfully.');
    }

    public function editAchievement(CandidateAchievement $candidateAchievement)
    {
        //$this->sendError('there is an issue here', '500');
        $achievement = $this->candidateProfileRepository->getAchievement($candidateAchievement);

        return $this->sendResponse($achievement, 'Candidate Achievement retrieved successfully.');
    }

    public function updateAchievement(CandidateAchievement $candidateAchievement)
    {
        $input = request()->all();
        $data['id'] = $candidateAchievement->id;
        $candidateAchievement->delete();
        $data['candidateAchievements'] = $this->candidateProfileRepository->createAchievement($input);

        return $this->sendResponse($data, 'Candidate Achievement updated successfully.');
    }

    public function destroyAchievement(CandidateAchievement $candidateAchievement)
    {
        $id = $candidateAchievement->id;
        $candidateAchievement->delete();

        CandidateFunction::profileCompletion(\Auth::user()->id);

        return $this->sendResponse($id, 'Candidate Achievement deleted successfully.');
    }

    /**
     * @param  CandidateEducation  $candidateEducation
     *
     * @return mixed
     */
    public function editEducation(CandidateEducation $candidateEducation)
    {
        $education = $this->candidateProfileRepository->getEducation($candidateEducation);

        return $this->sendResponse($education, 'Candidate Education retrieved successfully.');
    }

    /**
     * @param  CandidateEducation  $candidateEducation
     * @param  CreateCandidateEducationRequest  $request
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function updateEducation(CandidateEducation $candidateEducation, CreateCandidateEducationRequest $request)
    {
        $input = $request->all();
        $data['id'] = $candidateEducation->id;
        $candidateEducation->delete();

        $data['candidateEducation'] = $this->candidateProfileRepository->createEducation($input);
        $data['candidateEducation']->country = getCountryName($data['candidateEducation']->country_id);

        return $this->sendResponse($data, 'Candidate Education updated successfully.');
    }

    /**
     * @param  CandidateEducation  $candidateEducation
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function destroyEducation(CandidateEducation $candidateEducation)
    {
        $id = $candidateEducation->id;
        $candidateEducation->delete();

        CandidateFunction::profileCompletion(\Auth::user()->id);

        return $this->sendResponse($id, 'Candidate Education deleted successfully.');
    }
}
