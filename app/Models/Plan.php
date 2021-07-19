<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Plan
 *
 * @property int $id
 * @property string $name
 * @property string|null $stripe_plan_id
 * @property int $allowed_jobs
 * @property float $amount
 * @property int $is_trial_plan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereAllowedJobs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereIsTrialPlan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereStripePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Plan extends Model
{
    use SoftDeletes;
    const PERIODS = [
        'Weekly' => ['name' => 'week'],
        'Monthly' => ['name' => 'month'],
        'Quarterly' => ['name' => 'quarter'],
        'Yearly' => ['name' => 'year'],
    ];

    /**
     * @var string
     */
    protected $table = 'plans';

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'         => 'required|unique:plans,name',
        'amount'       => 'required|numeric|min:1',
        'allowed_jobs' => 'required|numeric|min:1',
    ];
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'subscription_duration',
        'stripe_plan_id',
        'allowed_jobs',
        'amount',
        'is_trial_plan',
        'currency_id',
        'period',
        'is_active'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'name'           => 'string',
        'stripe_plan_id' => 'string',
        'allowed_jobs'   => 'integer',
        'amount'         => 'double',
        'is_trial_plan'  => 'boolean',
    ];

    protected $appends = [
        'subscription_period', 'per'
    ];

    protected $with = [
        'currency',
    ];

    /**
     * @return BelongsTo
     */
    public function activeSubscriptions()
    {
        return $this->hasMany(Subscription::class, 'plan_id', 'id')
            ->Where('ends_at', '=', null);
    }

    public function getSubscriptionPeriodAttribute(){
        return array_search($this->period, array_keys(self::PERIODS));
    }

    public function getPerAttribute(){
        return Plan::PERIODS[$this->period]['name'];
    }

    public function currency(){
        return $this->hasOne(SalaryCurrency::class, 'id', 'currency_id');
    }

    public function subscribed(){
        $today = Carbon::now()->format('Y-m-d H:i:s');
        if(\Auth::check() && User::find(\Auth::user()->id)->hasRole('Employer')){
            return $this->hasOne(Subscription::class, 'plan_id', 'id')
                ->where('user_id', \Auth::user()->id)
                ->whereNull('trial_ends_at')
                ->where('current_period_end', '>', $today)
                ->orderBy('id', 'DESC');
        }
        return null;
    }
}
