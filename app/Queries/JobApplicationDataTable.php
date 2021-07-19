<?php

namespace App\Queries;

use App\Models\JobApplication;

/**
 * Class JobApplicationDataTable
 */
class JobApplicationDataTable
{
    /**
     * @param  array  $input
     *
     *
     * @return JobApplication
     */
    public function get($input = [])
    {
        /** @var JobApplication $query */
        $query = JobApplication::with(['job.currency', 'candidate.user'])
            ->where('job_id', $input['job_id'])
            ->where('status', '!=', JobApplication::STATUS_DRAFT)
            ->where('status','LIKE', "%".$input['status']."%")
            ->select('job_applications.*');

        return $query;
    }
}
