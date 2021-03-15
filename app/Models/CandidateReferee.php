<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateReferee extends Model
{
    //
    protected $fillable = [
        'candidate_id', 'name', 'phone', 'position', 'email', 'company', 'postal_address', 'region_code'
    ];
}
