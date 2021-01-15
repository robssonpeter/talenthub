<?php

namespace App\Http\Controllers;

use App\Models\ApplicationNote;
use App\Models\Interview;
use App\Models\Job;
use App\Models\JobApplication;
use App\Queries\JobApplicationDataTable;
use App\Repositories\JobApplicationRepository;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class JobApplicationController extends AppBaseController
{
    /** @var  JobApplicationRepository */
    private $jobApplicationRepository;

    public function __construct(JobApplicationRepository $jobApplicationRepo)
    {
        $this->jobApplicationRepository = $jobApplicationRepo;
    }

    /**
     * Display a listing of the Industry.
     *
     * @param  int  $jobId
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Factory|View
     */
    public function index($jobId, Request $request)
    {
        $input['job_id'] = $jobId;
        $job = Job::with('city')->findOrFail($jobId);
        if ($request->ajax()) {
            return Datatables::of((new JobApplicationDataTable())->get($input))->make(true);
        }
        $statusArray = JobApplication::STATUS;

        return view('employer.job_applications.index', compact('jobId', 'statusArray', 'job'));
    }


    /**
     * Remove the specified Job Application from storage.
     *
     * @param  JobApplication  $jobApplication
     *
     * @throws Exception
     *
     * @return RedirectResponse|Redirector
     */
    public function destroy(JobApplication $jobApplication)
    {
        $this->jobApplicationRepository->delete($jobApplication->id);

        return $this->sendSuccess('Job Application deleted successfully.');
    }

    /**
     * @param  $id
     *
     * @param $status
     *
     * @return mixed
     */
    public function changeJobApplicationStatus($id, $status)
    {
        $statuses = JobApplication::STATUS;
        $jobApplication = JobApplication::findOrFail($id);
        if (! in_array($jobApplication->status, [JobApplication::REJECTED, JobApplication::COMPLETE])) {
            $jobApplication->update(['status' => $status]);
            if($statuses[$status] == 'Interviewed'){
                $interviewed = Interview::where('application_id', $jobApplication->id)->update(['status' => 1]);
                if($interviewed){
                    return $this->sendSuccess('Status changed successfully.');
                }
            }

            return $this->sendSuccess('Status changed successfully.');
        }

        return $this->sendError(JobApplication::STATUS[$jobApplication->status].' job cannot be '.JobApplication::STATUS[$status]);
    }

    /**
     * @param  JobApplication  $jobApplication
     *
     * @return Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function downloadMedia(JobApplication $jobApplication)
    {
        list($file, $headers) = $this->jobApplicationRepository->downloadMedia($jobApplication);

        return response($file, 200, $headers);
    }

    public function addNote(){
        $data = request()->all();
        $data['user_id'] = \Auth::user()->id;
        $saved = ApplicationNote::create($data);
        return $saved;
    }

    public function fetchNotes(){
        $data = request()->application_id;
        $notes = ApplicationNote::where('application_id', $data)->with('author')->get();
        return $notes;
    }

    public function scheduleInterview(){
        $data = request()->all();
        $notification = request()->email_notification;
        unset($data['email_notification']);
        $interview = Interview::updateOrCreate(['application_id' => $data['application_id']], $data);
        if($interview){
            if($notification){
                $message = [
                    'success' => true,
                    'message' => __('messages.apply_job.interview_schedule_success'),
                    'next' => true
                ];
            }else{
                $message = [
                    'success' => true,
                    'message' => __('messages.apply_job.interview_schedule_success'),
                    'next' => false
                ];
            }
            return $message;
        }
        return $data;
    }
}
