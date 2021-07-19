<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyVerificationRejection extends Model
{
    protected $fillable = [
        'company_id', 'rejected_by', 'reason', 'attempt_id'
    ];
}
