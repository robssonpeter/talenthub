<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateAchievement extends Model
{
    protected $fillable = [
        'title', 'description', 'candidate_id', 'attachment_id', 'country_id', 'institution_id', 'category_id',
        'completion_date', 'valid_until', 'ongoing'
    ];

    protected $with = [
        'institution', 'category', 'country'
    ];

    public function country(){
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function institution(){
        return $this->hasOne(EducationInstitution::class, 'id', 'institution_id');
    }

    public function category(){
        return $this->hasOne(CertificateCategory::class, 'id', 'category_id');
    }
}
