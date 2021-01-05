<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerificationAttempt extends Model
{
    //
    protected $fillable = [
        'role', 'document', 'company_id', 'verified'
    ];

}

