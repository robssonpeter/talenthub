<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class SalaryCurrency
 *
 * @package App\Models
 * @version July 7, 2020, 6:41 am UTC
 * @property string $currency_name
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalaryCurrency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalaryCurrency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalaryCurrency query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalaryCurrency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalaryCurrency whereCurrencyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalaryCurrency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalaryCurrency whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SalaryCurrency extends Model
{
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'currency_name' => 'required|unique:salary_currencies',
    ];
    public $table = 'salary_currencies';
    public $fillable = [
        'currency_name',
        'currency_icon',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'            => 'integer',
        'currency_name' => 'string',
    ];
}
