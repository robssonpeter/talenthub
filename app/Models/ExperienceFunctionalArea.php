<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExperienceFunctionalArea extends Model
{
    protected $fillable = [
        'experience_id', 'functional_area_id'
    ];

    protected $table = 'experience_functional_areas';
}
