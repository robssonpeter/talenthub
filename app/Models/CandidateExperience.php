<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\CandidateExperience
 *
 * @property int $id
 * @property int $candidate_id
 * @property string $experience_title
 * @property string $company
 * @property string $country
 * @property string|null $state
 * @property string|null $city
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @property bool $currently_working
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|CandidateExperience newModelQuery()
 * @method static Builder|CandidateExperience newQuery()
 * @method static Builder|CandidateExperience query()
 * @method static Builder|CandidateExperience whereCandidateId($value)
 * @method static Builder|CandidateExperience whereCity($value)
 * @method static Builder|CandidateExperience whereCompany($value)
 * @method static Builder|CandidateExperience whereCountry($value)
 * @method static Builder|CandidateExperience whereCreatedAt($value)
 * @method static Builder|CandidateExperience whereCurrentlyWorking($value)
 * @method static Builder|CandidateExperience whereDescription($value)
 * @method static Builder|CandidateExperience whereEndDate($value)
 * @method static Builder|CandidateExperience whereExperienceTitle($value)
 * @method static Builder|CandidateExperience whereId($value)
 * @method static Builder|CandidateExperience whereStartDate($value)
 * @method static Builder|CandidateExperience whereState($value)
 * @method static Builder|CandidateExperience whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read \App\Models\Candidate $candidate
 * @property int|null $country_id
 * @property int|null $state_id
 * @property int|null $city_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateExperience whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateExperience whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateExperience whereStateId($value)
 */
class CandidateExperience extends Model
{
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'experience_title' => 'required',
        'company'          => 'required',
        'country_id'       => 'required',
        'start_date'       => 'required',
    ];
    public $table = 'candidate_experiences';
    public $fillable = [
        'candidate_id',
        'experience_title',
        'company',
        'country_id',
        'state_id',
        'city_id',
        'start_date',
        'end_date',
        'currently_working',
        'description',
        'career_level_id',
        'job_category_id',
        'industry_id',
        'functional_areas'
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'candidate_id'      => 'integer',
        'experience_title'  => 'string',
        'company'           => 'string',
        'country_id'        => 'integer',
        'state_id'          => 'integer',
        'city_id'           => 'integer',
        'start_date'        => 'date',
        'end_date'          => 'date',
        'currently_working' => 'boolean',
        'description'       => 'string',
    ];

    protected $appends = ['duration'];

    protected $with = ['areasOfFunction'];

    /**
     * @return string
     */
    public function getDurationAttribute(){
        $start = Carbon::parse($this->start_date);
        $end = Carbon::parse($this->currently_working?date('Y-m-d', time()):$this->end_date);

        return $start->diffForHumans($end, true, false, 2);
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }

    public function areasOfFunction(){
        return $this->hasMany(ExperienceFunctionalArea::class, 'experience_id', 'id');
    }

    public static function syncFunctionalAreas($experience_id){
        $experience = CandidateExperience::find($experience_id);
        $functionalAreas = json_decode($experience->functional_areas);
        $exceptions = [];
        $savingFunction = new ExperienceFunctionalArea();
        foreach($functionalAreas as $area){
            $check = ExperienceFunctionalArea::where('experience_id', $experience->id)->where('functional_area_id', $area)->first();
            if(!$check){
                $data = [
                    'experience_id'=> $experience->id,
                    'functional_area_id'=> $area
                ];
                //$check = ExperienceFunctionalArea::create($data);
                $check = $savingFunction->create($data);

            }
            if($check){
                array_push($exceptions, $check->id);
            }
        }
        // Delete non-existing functions
        ExperienceFunctionalArea::where('experience_id', $experience->id)->whereNotIn('functional_area_id', $exceptions)->delete();
        return $exceptions;
    }
}
