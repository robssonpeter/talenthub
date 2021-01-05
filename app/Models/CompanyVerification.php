<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyVerification extends Model
{
    //
    protected $fillable = [
      'company_id', 'document', 'verified_by'
    ];


}
