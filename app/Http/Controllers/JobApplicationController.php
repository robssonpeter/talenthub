<?php

namespace App\Http\Controllers;

use App\Functionalities\Employer;
use App\Mail\InteviewInvitation;
use App\Mail\RejectionEmail;
use App\Models\ApplicationNote;
use App\Models\Company;
use App\Models\EmailTemplate;
use App\Models\Interview;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\Candidate;
use App\Queries\JobApplicationDataTable;
use App\Repositories\JobApplicationRepository;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;
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
     * @param int $jobId
     * @param Request $request
     *
     * @param string $status
     * @return Factory|View
     * @throws Exception
     */
    public function index($jobId, Request $request, $status = '')
    {
        $input['job_id'] = $jobId;
        $input['status'] = $status;
        $job = Job::with('city')->findOrFail($jobId);
        if ($request->ajax()) {
            return Datatables::of((new JobApplicationDataTable())->get($input))->make(true);
        }
        $statusArray = JobApplication::STATUS;

        if(\Auth::user()->hasRole('Admin', 'Moderator')){
            $company = Company::find($job->company_id);
            $extend = 'layouts.app';
        }else{
            $company = null;
            $extend = 'employer.layouts.app';
        }


        return view('employer.job_applications.index', compact('jobId', 'statusArray', 'job', 'company', 'extend'));
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

    public function destroyBulk($applications, $jobId){
        $applications = json_decode($applications);
        if(is_array($applications) && count($applications)){
            $deleted = JobApplication::whereIn('id', $applications)->where('job_id', $jobId)->delete();
        }
        if(count($applications)>1){
            return $this->sendSuccess('Job Applications deleted successfully.');
        }else if(count($applications) == 1){
            return $this->sendSuccess('Job Application deleted successfully.');
        }
        return $this->sendError('Nothing was deleted');
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

        $application = json_decode($id);
        if(is_array($application)){
            // Checking applications that have passed that stage or rejected
            $applicationsToIgnore = JobApplication::whereIn('id', $application)->where('status', '>=', $status)->select('id')->pluck('id')->toArray();
            // Remove application to ignore
            $application = array_diff($application, $applicationsToIgnore);
            // if there are still new applications then to update then update them
            if(count($application)){
                $updating = JobApplication::whereIn('id', $application)->update(['status' => $status]);
                if($statuses[$status] == 'Interviewed'){
                    $interviewed = Interview::whereIn('application_id', $application)->update(['status' => 1]);
                }
                if($statuses[$status] == 'Rejected'){
                    $defaultTemplate = Employer::defaultEmailTemplate('application_rejection');
                    $company = Company::whereUserId(\Auth::user()->id)->with('user')->first();
                    $candidates = JobApplication::whereIn('id', $application)->with('user')->get();
                    foreach($candidates as $candidate){
                        $message = EmailTemplate::renderTemplate($candidate->id, $defaultTemplate->id);
                        \Mail::to($candidate->user)->send(new RejectionEmail($message, $company->user->first_name));
                    }
                }
                return $this->sendSuccess('Status changed successfully.');
            }
            return $this->sendError('No change was made');
        }
        $jobApplication = JobApplication::findOrFail($id);
        if (! in_array($jobApplication->status, [JobApplication::REJECTED, JobApplication::COMPLETE])) {
            $jobApplication->update(['status' => $status]);
            if($statuses[$status] == 'Interviewed'){
                $interviewed = Interview::where('application_id', $jobApplication->id)->update(['status' => 1]);
                if($interviewed){
                    return $this->sendSuccess('Status changed successfully.');
                }
            }

            if($statuses[$status] == 'Rejected'){
                $defaultTemplate = Employer::defaultEmailTemplate('application_rejection');
                $message = EmailTemplate::renderTemplate($id, $defaultTemplate->id);
                $company = Company::whereUserId(\Auth::user()->id)->with('user')->first();
                $candidate = Candidate::where('id', $jobApplication->candidate_id)->with('user')->first();
                \Mail::to($candidate->user)->send(new RejectionEmail($message, $company->user->first_name));
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
        $application_id = json_decode($data['application_id']);
        if(is_array($application_id)){
            // Ignoring rejected applications
            $rejected = JobApplication::whereIn('id', $application_id)->where('status', '=', 2)->select('id')->pluck('id')->toArray();
            $application_id = array_diff($application_id, $rejected);

            // Check for existing interviews
            $existing = Interview::whereIn('application_id', $application_id)->select('application_id')->pluck('application_id')->toArray();
            if($existing){
                // update the existing interviews
                $updateData = $data;
                unset($updateData['application_id']);
                unset($updateData['_token']);

                $template = EmailTemplate::find(request()->template_id);
                $updating = Interview::whereIn('application_id', $existing)->update($updateData);
            }

            // finding new interviews
            $newInterviews = array_values(array_diff($application_id, $existing));
            $newData = $data;

            // inserting new interviews
            if(count($newInterviews)){
                $model =new Interview();
                foreach($newInterviews as $newInterview){
                    $row = $data;
                    $row['application_id'] = $newInterview;
                    unset($row['_token']);
                    $model->create($row);
                }
                //$model->save();
            }

            // Sending notification to candidates
            if($notification){
                $template = EmailTemplate::find(request()->template_id);
                $candidates = JobApplication::whereIn('id', $application_id)->with('user')->get();
                foreach($candidates as $candidate){
                    $subject = "Invitation for Job Interview";
                    $message = EmailTemplate::renderTemplate($candidate->id, $template->id);
                    \Mail::to($candidate->user)->send(new InteviewInvitation($message));
                }
                $updates = [
                    'template_id' =>  $template->id,
                    'notified' => true
                ];
                Interview::whereIn('application_id', $application_id)->update($updates);
            }
            return $this->sendResponse([], __('messages.apply_job.interview_schedule_success'));

        }else{
            $interview = Interview::updateOrCreate(['application_id' => $data['application_id']], $data);
            if($interview){
                if($notification){
                    $message = [
                        'success' => true,
                        'message' => __('messages.apply_job.interview_schedule_success'),
                        'next' => true
                    ];
                    $template = EmailTemplate::find(request()->template_id);
                    $candidate = JobApplication::whereId($data['application_id'])->with('user')->first();
                    $subject = "Invitation for Job Interview";
                    $message = EmailTemplate::renderTemplate($data['application_id'], $template->id);
                    \Mail::to($candidate->user)->send(new InteviewInvitation($message));
                    $application_id = $data['application_id'];
                    $updates = [
                        'template_id' =>  $template->id,
                        'notified' => true
                    ];
                    Interview::where('application_id', $application_id)->update($updates);
                }else{
                    $message = [
                        'success' => true,
                        'message' => __('messages.apply_job.interview_schedule_success'),
                        'next' => false
                    ];
                }
                return $this->sendResponse([], __('messages.apply_job.interview_schedule_success'));
            }
        }

        return $data;
    }
}
