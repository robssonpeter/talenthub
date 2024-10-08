<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\EmailJobToFriendRequest;
use App\Models\Candidate;
use App\Models\Job;
use App\Repositories\JobRepository;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;
use Share;

class JobController extends AppBaseController
{
    /** @var  JobRepository */
    private $jobRepository;

    public function __construct(JobRepository $jobRepo)
    {
        $this->jobRepository = $jobRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $data = $this->jobRepository->prepareJobData();
        $data['input'] = $request->all();

        return view('web.jobs.index')->with($data);
    }

    /**
     * @param  string  $uniqueJobId
     *
     * @return Application|Factory|View
     */
    public function jobDetails($uniqueJobId)
    {
        $job = Job::whereJobId($uniqueJobId)->first();

        if ($job->status == Job::STATUS_DRAFT && Auth::check() && Auth::user()->hasRole('Candidate')) {
            abort(404);
        }

        if(Auth::check() && Auth::user()->hasRole('Candidate')){
            $candidate = Candidate::whereUserId(Auth::user()->id)->first();
        }else{
            $candidate = null;
        }

        $data['resumes'] = null;

        $data['isActive'] = $data['isApplied'] = $data['isJobAddedToFavourite'] = $data['isJobReportedAsAbuse'] = false;
        if (Auth::check() && Auth::user()->hasRole('Candidate')) {
            $data = $this->jobRepository->getJobDetails($job);
        }
        $data['jobsCount'] = Job::whereStatus(Job::STATUS_OPEN)->whereCompanyId($job->company_id)->count();

        // check job status is active or not
        $data['isActive'] = ($job->status == Job::STATUS_OPEN) ? true : false;

        $relatedJobs = Job::with('jobCategory', 'jobShift', 'company')->whereJobCategoryId($job->job_category_id);
        $data['getRelatedJobs'] = $relatedJobs->whereNotIn('id', [$job->id])->where('is_anonymous', 0)->orderByDesc('created_at')->take(5)->get();
        $url = Share::load(url()->current())->services('facebook', 'twitter', 'gmail', 'pinterest');
        //dd($job);
        return view('web.jobs.job_details', compact('job', 'url', 'candidate'))->with($data);
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResource
     */
    public function saveFavouriteJob(Request $request)
    {
        $input = $request->all();
        $favouriteJob = $this->jobRepository->storeFavouriteJobs($input);
        if ($favouriteJob) {
            return $this->sendResponse($favouriteJob, 'Favourite Job added successfully.');
        }
            return $this->sendResponse($favouriteJob, 'Favourite Job removed successfully.');

    }

    /**
     * @param  Request  $request
     *
     * @return JsonResource
     */
    public function reportJobAbuse(Request $request)
    {
        $input = $request->all();
        $this->jobRepository->storeReportJobAbuse($input);

        return $this->sendSuccess('Job Abuse reported successfully.');
    }

    /**
     * @param  EmailJobToFriendRequest  $request
     *
     * @return JsonResource
     */
    public function emailJobToFriend(EmailJobToFriendRequest $request)
    {
        $input = $request->all();
        $this->jobRepository->emailJobToFriend($input);

        return $this->sendSuccess('Job Emailed to friend successfully.');
    }
}
