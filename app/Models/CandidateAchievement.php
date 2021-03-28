<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateAchievement extends Model
{
    protected $fillable = [
        'title', 'description', 'candidate_id', 'attachment_id'
    ];
}
