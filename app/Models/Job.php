<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Job
 *
 * @property int $id
 * @property string $job_title
 * @property string $description
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $salary_from
 * @property string $salary_to
 * @property int $currency_id
 * @property int $salary_period_id
 * @property int $job_type_id
 * @property int $career_level_id
 * @property int $functional_area_id
 * @property int $job_shift_id
 * @property int $degree_level_id
 * @property int $position_id
 * @property string $job_expiry_date
 * @property int $no_preference
 * @property int $hide_salary
 * @property int $is_freelance
 * @property int $is_suspended
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read CareerLevel $careerLevel
 * @property-read SalaryCurrency $currency
 * @property-read RequiredDegreeLevel $degreeLevel
 * @property-read FunctionalArea $functionalArea
 * @property-read JobShift $jobShift
 * @property-read JobType $jobType
 * @property-read Position $position
 * @property-read SalaryPeriod $salaryPeriod
 * @method static Builder|Job newModelQuery()
 * @method static Builder|Job newQuery()
 * @method static Builder|Job query()
 * @method static Builder|Job whereCareerLevelId($value)
 * @method static Builder|Job whereCity($value)
 * @method static Builder|Job whereCountry($value)
 * @method static Builder|Job whereCreatedAt($value)
 * @method static Builder|Job whereCurrencyId($value)
 * @method static Builder|Job whereDegreeLevelId($value)
 * @method static Builder|Job whereDescription($value)
 * @method static Builder|Job whereFunctionalAreaId($value)
 * @method static Builder|Job whereHideSalary($value)
 * @method static Builder|Job whereId($value)
 * @method static Builder|Job whereIsFreelance($value)
 * @method static Builder|Job whereIsFeatured($value)
 * @method static Builder|Job whereIsSuspended($value)
 * @method static Builder|Job whereJobExpiryDate($value)
 * @method static Builder|Job whereJobShiftId($value)
 * @method static Builder|Job whereJobTitle($value)
 * @method static Builder|Job whereJobTypeId($value)
 * @method static Builder|Job whereNoPreference($value)
 * @method static Builder|Job wherePositionId($value)
 * @method static Builder|Job whereSalaryFrom($value)
 * @method static Builder|Job whereSalaryPeriodId($value)
 * @method static Builder|Job whereSalaryTo($value)
 * @method static Builder|Job whereState($value)
 * @method static Builder|Job whereUpdatedAt($value)
 * @mixin Eloquent
 * @property int $company_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\JobApplication[] $appliedJobs
 * @property-read int|null $applied_jobs_count
 * @property-read \App\Models\Company $company
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\JobSkill[] $jobsSkill
 * @property-read int|null $jobs_skill_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereCompanyId($value)
 * @property string $job_id
 * @property int $job_category_id
 * @property-read \App\Models\JobCategory $jobCategory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereJobCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereJobId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job status($status)
 * @property int $status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereStatus($value)
 * @property int|null $country_id
 * @property int|null $state_id
 * @property int|null $city_id
 * @property-read mixed $city_name
 * @property-read mixed $country_name
 * @property-read mixed $state_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereStateId($value)
 */
class Job extends Model
{
    const NO_PREFERENCE = [
        1 => 'Male',
        0 => 'Female',
    ];

    const APPLY_METHODS = [
       0 => 'In-platform',
       1 => 'To URL',
       2 => 'Specified in Description'
    ];

    const IS_SUSPENDED = [
        1 => 'Yes',
        0 => 'No',
    ];

    const IS_FEATURED = [
        1 => 'Yes',
        0 => 'No',
    ];

    const STATUS_DRAFT = 0;
    const STATUS_OPEN = 1;
    const STATUS_CLOSED = 2;
    const STATUS_PAUSED = 3;
    const STATUS_SUSPENDED = 4;

    const STATUS = [
        0 => 'Drafted',
        1 => 'Live',
        2 => 'Closed',
        3 => 'Paused',
        4 => 'Suspended'
    ];

    const STATUS_COLOR = [
        0 => 'dark',
        1 => 'success',
        2 => 'warning',
        3 => 'primary',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'company_id'         => 'sometimes|required',
        'job_title'          => 'required',
        'currency_id'        => 'required',
        'salary_period_id'   => 'required',
        'job_type_id'        => '',
        /*'functional_area_id' => 'required',*/
        'position'           => 'required',
        'experience'         => 'required',
        'country_id'         => 'required',
        'state_id'           => 'required',
    ];
    public $table = 'jobs';
    public $fillable = [
        'job_id',
        'job_title',
        'description',
        'salary_from',
        'salary_to',
        'company_id',
        'job_category_id',
        'currency_id',
        'salary_period_id',
        'job_type_id',
        'career_level_id',
        'functional_area_id',
        'functional_areas',
        'job_shift_id',
        'degree_level_id',
        'position',
        'experience',
        'job_expiry_date',
        'no_preference',
        'hide_salary',
        'is_freelance',
        'is_suspended',
        'country_id',
        'state_id',
        'city_id',
        'status',
        'require_cover_letter',
        'reports_to',
        'industry_id',
        'summary',
        'qualifications',
        'additional_information',
        'benefits',
        'url',
        'application_method',
        'posted_by',
        'is_anonymous',
        'swap_company_name'
    ];
    /**
     * @var array
     */
    public $casts = [
        'id'                 => 'integer',
        'job_id'             => 'string',
        'job_title'          => 'string',
        'company_id'         => 'integer',
        'job_category_id'    => 'integer',
        'currency_id'        => 'integer',
        'salary_period_id'   => 'integer',
        'job_type_id'        => 'integer',
        'career_level_id'    => 'integer',
        'functional_area_id' => 'integer',
        'job_shift_id'       => 'integer',
        'degree_level_id'    => 'integer',
        'position'           => 'integer',
        'experience'         => 'integer',
        'salary_from'        => 'double',
        'salary_to'          => 'double',
        'country_id'         => 'integer',
        'city_id'            => 'integer',
        'state_id'           => 'integer',
        'description'        => 'text',
        'job_expiry_date'    => 'date',
        'no_preference'      => 'integer',
        'hide_salary'        => 'boolean',
        'is_freelance'       => 'boolean',
        'is_suspended'       => 'boolean',
    ];

    protected $appends = ['country_name', 'state_name', 'city_name', 'functional_area_ids', 'applications_count'];
    protected $with = ['country', 'state', 'city', 'activeFeatured', 'currency', 'company', 'functionalAreas', 'industry'];



    public function getApplicationsCountAttribute(){
        return $this->appliedJobs->count();
    }

    public function getJobTitleAttribute(){
        return htmlspecialchars_decode($this->attributes['job_title']);
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    /**
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    /**
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function getFunctionalAreaIdsAttribute(){
        return $this->functionalAreas()->pluck('functional_area_id');
    }



    public function getCountryNameAttribute()
    {
        if (! empty($this->country)) {
            return $this->country->name;
        }
    }

    public function getStateNameAttribute()
    {
        if (! empty($this->state)) {
            return $this->state->name;
        }
    }

    public function getCityNameAttribute()
    {
        if (! empty($this->city)) {
            return $this->city->name;
        }
    }

    /**
     * @return BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    /**
     * @param  Builder  $query
     * @param  int  $status
     *
     * @return Builder
     */
    public function scopeStatus(Builder $query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * @return BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(SalaryCurrency::class, 'currency_id');
    }

    /**
     * @return BelongsTo
     */
    public function salaryPeriod()
    {
        return $this->belongsTo(SalaryPeriod::class, 'salary_period_id');
    }

    /**
     * @return BelongsTo
     */
    public function jobType()
    {
        return $this->belongsTo(JobType::class, 'job_type_id');
    }

    /**
     * @return BelongsTo
     */
    public function careerLevel()
    {
        return $this->belongsTo(CareerLevel::class, 'career_level_id');
    }

    /**
     * @return BelongsTo
     */
    public function functionalArea()
    {
        return $this->belongsTo(FunctionalArea::class, 'functional_area_id');
    }

    public function functionalAreas(){
        return $this->hasMany(JobFunctionalArea::class, 'job_id', 'id');
    }

    public function industry(){
        return $this->belongsTo(Industry::class, 'industry_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function jobShift()
    {
        return $this->belongsTo(JobShift::class, 'job_shift_id');
    }

    /**
     * @return BelongsTo
     */
    public function degreeLevel()
    {
        return $this->belongsTo(RequiredDegreeLevel::class, 'degree_level_id');
    }

    /**
     * @return BelongsToMany
     */
    public function jobsSkill()
    {
        return $this->belongsToMany(Skill::class, 'jobs_skill', 'job_id', 'skill_id');
    }

    /**
     * @return BelongsToMany
     */
    public function jobsTag()
    {
        return $this->belongsToMany(Tag::class, 'jobs_tag', 'job_id', 'tag_id');
    }

    /**
     * @return HasMany
     */
    public function appliedJobs()
    {
        return $this->hasMany(JobApplication::class, 'job_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function jobCategory()
    {
        return $this->belongsTo(JobCategory::class, 'job_category_id');
    }

    /**
     * @return string
     */
    public function getFullLocationAttribute()
    {
        $location = '';
        if (! empty($this->city)) {
            $location = $this->city->name.', ';
        }

        if (! empty($this->state)) {
            $location = $location.$this->state->name.', ';
        }

        if (! empty($this->country)) {
            $location = $location.$this->country->name;
        }

        return $location;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function featured()
    {
        return $this->morphOne(FeaturedRecord::class, 'owner');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function activeFeatured()
    {
        return $this->morphOne(FeaturedRecord::class, 'owner')->where('end_time', '>', \Carbon\Carbon::now());
    }
}
