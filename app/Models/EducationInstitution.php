<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationInstitution extends Model
{
    //
    protected $fillable = [
        'country_id', 'name', 'city_id'
    ];

}
