<?php

namespace App\Http\Controllers\Candidates;

use App;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CandidateUpdateGeneralInformationRequest;
use App\Http\Requests\CandidateUpdateOnlineProfileRequest;
use App\Http\Requests\CandidateUpdateProfileRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateCandidateProfileRequest;
use App\Models\Candidate;
use App\Models\CandidateEducation;
use App\Models\CandidateExperience;
use App\Models\CandidateLanguage;
use App\Models\CandidateObjective;
use App\Models\CandidateReferee;
use App\Models\CandidateSkill;
use App\Models\CareerLevel;
use App\Models\FavouriteCompany;
use App\Models\FavouriteJob;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\RequiredDegreeLevel;
use App\Models\User;
use App\Queries\CandidateAppliedJobDataTable;
use App\Queries\FavouriteCompanyDataTable;
use App\Queries\FavouriteJobDataTable;
use App\Repositories\Candidates\CandidateRepository;
use Auth;
use Exception;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Spatie\MediaLibrary\Models\Media;
use Yajra\DataTables\DataTables;
use App\Functionalities\Candidate as CandidateFunction;

class CandidateController extends AppBaseController
{
    /** @var  CandidateRepository */
    private $candidateRepository;

    public function __construct(CandidateRepository $candidateRepo)
    {
        $this->candidateRepository = $candidateRepo;
    }

    /**
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Factory|View
     */
    public function editProfile(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $user->phone = preparePhoneNumber($user->phone, $user->region_code);
        $data = $this->candidateRepository->prepareData();
        //dd($data);
        $countries = getCountries();
        $states = $cities = null;
        if (!empty($user->country_id)) {
            $states = getStates($user->country_id);
        }
        if (isset($user->state_id)) {
            $cities = getCities($user->state_id);
        }
        $careerLevels = CareerLevel::get();
        $data['careerLevels'] = [];
        foreach($careerLevels as $careerLevel){
            $data['careerLevels'][$careerLevel->id] = $careerLevel->level_name;
        }
        $candidateSkills = $user->candidateSkill()->pluck('skill_id')->toArray();
        $candidateLanguage = $user->candidateLanguage()->pluck('language_id')->toArray();
        $sectionName = ($request->section === null) ? 'general' : $request->section;
        $data['sectionName'] = $sectionName;

        if ($sectionName == 'resumes') {
            /** @var Candidate $candidate */
            $candidate = Candidate::findOrFail($user->candidate->id);

            $data['resumes'] = $candidate->getMedia('resumes');
        }

        if ($sectionName == 'certifications') {
            /** @var Candidate $candidate */
            $candidate = Candidate::findOrFail($user->candidate->id);

            $data['certifications'] = $candidate->getMedia('certifications');
        }

        if ($sectionName == 'career_informations' || $sectionName == 'cv_builder') {
            $data['jobCategories'] = App\Models\JobCategory::pluck('name', 'id');
            $data['candidateObjective'] = CandidateObjective::where('candidate_id', $user->owner_id)->first();
            $data['candidateReferees'] = CandidateReferee::where('candidate_id',
                $user->owner_id)->orderByDesc('id')->get();
            $data['candidateExperiences'] = CandidateExperience::where('candidate_id',
                $user->owner_id)->orderByDesc('id')->get();
            foreach ($data['candidateExperiences'] as $experience) {
                $experience->country = getCountryName($experience->country_id);
            }
            $data['candidateEducations'] = CandidateEducation::with('degreeLevel')->where('candidate_id',
                $user->owner_id)->orderByDesc('id')->get();
            foreach ($data['candidateEducations'] as $education) {
                $education->country = getCountryName($education->country_id);
            }
            $data['degreeLevels'] = RequiredDegreeLevel::pluck('name', 'id');
            $data['candidateAchievements'] = App\Models\CandidateAchievement::where('candidate_id',
                $user->owner_id)->orderByDesc('id')->get();
            $candidate = Candidate::findOrFail($user->candidate->id);
            $data['certifications'] = App\Models\Media::where('model_type', 'App\Models\Candidate')->where('collection_name', 'certifications')->where('model_id', $user->candidate->id)->pluck('custom_properties', 'id' )->toArray();
        }
        //dd($data);

        return view("candidate.profile.$sectionName",
            compact('user', 'data', 'countries', 'states', 'cities', 'candidateSkills', 'candidateLanguage'));
    }

    /**
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return mixed
     */
    public function showFavouriteJobs(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new FavouriteJobDataTable())->get())->make(true);
        }
        $statusArray = Job::STATUS;

        return view('candidate.favourite_jobs.index', compact('statusArray'));
    }

    /**
     * @param  FavouriteJob  $favouriteJob
     *
     * @throws Exception
     *
     * @return JsonResource
     */
    public function deleteFavouriteJob(FavouriteJob $favouriteJob)
    {
        $favouriteJob->delete();

        return $this->sendSuccess('Favourite Job deleted successfully.');
    }

    /**
     * @param  CandidateUpdateProfileRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function updateProfile(CandidateUpdateProfileRequest $request)
    {
        //dd($request->all());
        $this->candidateRepository->updateProfile($request->all());
        CandidateFunction::profileCompletion(Auth::user()->id);
        Flash::success('Candidate profile updated successfully.');

        return redirect(route('candidate.profile'));
    }

    /**
     * @param  CandidateUpdateGeneralInformationRequest  $request
     *
     * @throws \Throwable
     *
     * @return JsonResponse
     */
    public function updateGeneralInformation(CandidateUpdateGeneralInformationRequest $request)
    {
        $user = $this->candidateRepository->updateGeneralInformation($request->all());
        $user['candidateSkill'] = $user->candidateSkill()->pluck('name')->toArray();
        CandidateFunction::profileCompletion(Auth::user()->id);
        return $this->sendResponse($user, 'Candidate profile updated successfully.');
    }

    /**
     * @param  CandidateUpdateOnlineProfileRequest  $request
     *
     * @throws \Throwable
     *
     * @return JsonResponse
     */
    public function updateOnlineProfile(CandidateUpdateOnlineProfileRequest $request)
    {
        $user = $this->candidateRepository->updateGeneralInformation($request->all());
        $user['onlineProfileLayout'] = view('candidate.profile.career_informations.show_online_profile',
            compact('user'))->render();
        $user['editonlineProfileLayout'] = view('candidate.profile.career_informations.edit_online_profile',
            compact('user'))->render();
        CandidateFunction::profileCompletion(Auth::user()->id);
        return $this->sendResponse($user, 'Candidate profile updated successfully.');
    }

    /**
     * @throws \Throwable
     *
     * @return array|string
     */
    public function getCVTemplate()
    {
        $user = Auth::user();
        $data['user'] = $user;
        $data['candidateExperiences'] = CandidateExperience::where('candidate_id',
            $user->owner_id)->orderByDesc('id')->get();
        foreach ($data['candidateExperiences'] as $experience) {
            $experience->country = getCountryName($experience->country_id);
        }
        $data['candidateEducations'] = CandidateEducation::with('degreeLevel')->where('candidate_id',
            $user->owner_id)->orderByDesc('id')->get();
        foreach ($data['candidateEducations'] as $education) {
            $education->country = getCountryName($education->country_id);
        }
        $data['candidateAchievements'] = App\Models\CandidateAchievement::where('candidate_id',
            $user->owner_id)->orderByDesc('id')->get();
        //dd($data);
        return view('candidate.profile.cv_template')->with($data)->render();
    }

    /**
     * @param  Request  $request
     *
     * @return mixed
     */
    public function uploadResume(Request $request)
    {
        $input = $request->all();
        $this->sendSuccess('done');


        $this->candidateRepository->uploadResume($input, true);

        CandidateFunction::profileCompletion(Auth::user()->id);

        return $this->sendSuccess('Resume updated successfully.');
    }

    public function uploadCertificate(Request $request)
    {
        $input = $request->all();

        $this->candidateRepository->uploadResume($input, false);

        CandidateFunction::profileCompletion(Auth::user()->id);

        return $this->sendSuccess(__('messages.candidate_profile.certificate_uploaded'));
    }

    public function uploadSalarySlip(Request $request)
    {
        $input = $request->all();
        $this->candidateRepository->uploadResume($input, null);

        return $this->sendSuccess(__('messages.candidate_profile.salary_slip_uploaded'));
    }

    /**
     * @param  int  $media
     *
     * @return Media
     */
    public function downloadResume($media)
    {
        /** @var Media $mediaItem */
        $mediaItem = Media::findOrFail($media);

        return $mediaItem;
    }

    /**
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return mixed
     */
    public function showFavouriteCompanies(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new FavouriteCompanyDataTable())->get())->make(true);
        }

        return view('candidate.favourite_companies.index');
    }

    /**
     * @param  FavouriteCompany  $favouriteCompany
     *
     * @throws Exception
     *
     * @return JsonResource
     */
    public function deleteFavouriteCompany(FavouriteCompany $favouriteCompany)
    {
        $favouriteCompany->delete();

        return $this->sendSuccess('Favourite Company deleted successfully.');
    }

    /**
     * @return Factory|View
     */
    public function editJobAlert()
    {
        $data = $this->candidateRepository->getJobAlerts();

        return view('candidate.job_alert.edit')->with($data);
    }

    /**
     * @param  Request  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function updateJobAlert(Request $request)
    {
        $this->candidateRepository->updateJobAlerts($request->all());
        Flash::success('Job Alert updated successfully.');

        return redirect(route('candidate.job.alert'));
    }

    /**
     * @param  ChangePasswordRequest  $request
     *
     * @return JsonResponse
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $input = $request->all();

        try {
            $user = $this->candidateRepository->changePassword($input);

            return $this->sendSuccess('Password updated successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 422);
        }
    }

    /**
     * Show the form for editing the specified User.
     *
     * @return JsonResponse
     */
    public function editCandidateProfile()
    {
        $user = User::with('candidate')->where('id', '=', Auth::id())->first();

        return $this->sendResponse($user, 'Candidate retrieved successfully.');
    }

    /**
     * @param  UpdateCandidateProfileRequest  $request
     *
     * @return JsonResponse
     */
    public function profileUpdate(UpdateCandidateProfileRequest $request)
    {
        $input = $request->all();

        try {
            $employer = $this->candidateRepository->profileUpdate($input);

            return $this->sendResponse($employer, 'Candidate Profile updated successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 422);
        }
    }

    /**
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return mixed
     */
    public function showCandidateAppliedJob(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new CandidateAppliedJobDataTable())->get())->make(true);
        }

        $statusArray = JobApplication::STATUS;

        return view('candidate.applied_job.index', compact('statusArray'));
    }

    /**
     * @param  JobApplication  $jobApplication
     *
     * @throws Exception
     *
     * @return JsonResource
     */
    public function deleteCandidateAppliedJob(JobApplication $jobApplication)
    {
        $jobApplication->delete();

        return $this->sendSuccess('Applied Job deleted successfully.');
    }

    /**
     * @param  Media  $media
     *
     * @throws Exception
     *
     * @return mixed
     */
    public function deletedResume(Media $media)
    {
        $media->delete();

        CandidateFunction::profileCompletion(Auth::user()->id);

        return $this->sendSuccess('Media deleted successfully.');
    }

    /**
     * @param  JobApplication  $jobApplication
     *
     * @return mixed
     */
    public function showAppliedJobs(JobApplication $jobApplication)
    {
        return $this->sendResponse($jobApplication, 'Retrieved successfully.');
    }

    public function profileCompletion(){
        $user = Auth::user()->id;
        $candidate = Candidate::whereUserId($user)->first();
        if($candidate){
            return $candidate->profile_completion;
        }
        return null;
    }

    public function getSalarySlip(){
        $ajax = request()->ajax;
        $candidate = request()->cd;
        if($ajax){
            $media = App\Models\Media::where('model_id', $candidate)->where('collection_name', 'salary-slips')->first();
        }else{
            $media =  Media::where('model_id', $candidate)->where('collection_name', 'salary-slips')->first();
            return $media->get();
        }
        if($media){
            return $media;
        }
        return $media;
    }

    public function deleteSalarySlip(){
        $user = User::find(Auth::user()->id);
        /*$candidate = Candidate::where('user_id', $user)->first();
        if(is_null($candidate)){
            return null;
        }*/
        //return $this->sendSuccess($user->candidate->father_name);
        $media = App\Models\Media::where('model_id', $user->candidate->id)->where('collection_name', 'salary-slips')->first();
        $directory = public_path('salary-slips/'.$media->id);
        if(is_dir($directory)){
            rmdir(public_path('salary-slips/'.$media->id));
        }
        if(!is_dir($directory)){
            $media->delete();
        }

        return $this->sendSuccess(__('messages.candidate_profile.salary_slip_deleted'));
    }
}
