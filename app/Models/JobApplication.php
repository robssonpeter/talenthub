<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\Models\Media;

/**
 * App\Models\JobApplication
 *
 * @property int $id
 * @property int $job_id
 * @property int $candidate_id
 * @property int $resume_id
 * @property float $expected_salary
 * @property string|null $notes
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|JobApplication newModelQuery()
 * @method static Builder|JobApplication newQuery()
 * @method static Builder|JobApplication query()
 * @method static Builder|JobApplication whereCandidateId($value)
 * @method static Builder|JobApplication whereCreatedAt($value)
 * @method static Builder|JobApplication whereExpectedSalary($value)
 * @method static Builder|JobApplication whereId($value)
 * @method static Builder|JobApplication whereJobId($value)
 * @method static Builder|JobApplication whereNotes($value)
 * @method static Builder|JobApplication whereResumeId($value)
 * @method static Builder|JobApplication whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read \App\Models\Candidate $candidate
 * @property-read \App\Models\Job $job
 * @property int $status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JobApplication whereStatus($value)
 */
class JobApplication extends Model
{
    public $table = 'job_applications';

    protected $appends = ['resume_url'];

    const STATUS_DRAFT = 0;
    const STATUS_APPLIED = 1;
    const REJECTED  = 2;
    const COMPLETE = 3;
    const SHORT_LIST = 4;

    const STATUS = [
        0 => 'Drafted',
        1 => 'Applied',
        2 => 'Rejected',
        3 => 'Selected',
        4 => 'Shortlisted',
    ];

    public $fillable = [
        'job_id',
        'candidate_id',
        'resume_id',
        'expected_salary',
        'notes',
        'cover_letter',
        'status',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'job_id'          => 'integer',
        'candidate_id'    => 'integer',
        'resume_id'       => 'integer',
        'status'          => 'integer',
        'expected_salary' => 'double',
        'notes'           => 'string',
        'cover_letter'    => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'job_id'          => 'required',
        'resume_id'       => 'required',
        'expected_salary' => 'required',
    ];

    /**
     * @return BelongsTo
     */
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }

    /**
     * @return BelongsTo
     */
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    /**
     * @return mixed
     */


    public function getResumeUrlAttribute()
    {
        /** @var Media $media */
        $media = Media::find($this->resume_id);
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return null;
    }
}
