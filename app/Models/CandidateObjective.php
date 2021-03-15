<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateObjective extends Model
{
    protected $fillable = [
        'candidate_id', 'description'
    ];

    const MAX_CHARACTERS = 500;
}
