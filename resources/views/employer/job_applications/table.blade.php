<table class="table table-responsive-sm table-striped table-bordered" id="jobApplicationsTbl">
    <thead>
    <tr>
        <th scope="col">{{ __('messages.job_application.candidate_name') }}</th>
        <th scope="col">{{ __('messages.candidate.expected_salary') }}</th>
        <th scope="col">{{ __('messages.job_application.application_date') }}</th>
        <th scope="col">{{ __('messages.common.interview_date') }}</th>
        <th scope="col">{{ __('messages.applied_job.cover_letter') }}</th>
        <th scope="col">{{ __('messages.apply_job.resume') }}</th>
        <th scope="col">{{ __('messages.common.status') }}</th>
        <th scope="col">{{ __('messages.common.action') }}</th>
        <th scope="col">{{ Form::checkbox('select_all', 0, false, ['id' => 'select_all']) }}</th>
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>
