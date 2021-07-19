<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerificationAttempt extends Model
{
    //
    protected $fillable = [
        'role', 'document', 'company_id', 'verified'
    ];

    protected $appends = [
        'documents'
    ];

    protected $with = [
        'rejected'
    ];

    public function getDocumentsAttribute(){
        return json_decode($this->document);
    }

    public function rejected(){
        return $this->hasOne(CompanyVerificationRejection::class, 'attempt_id', 'id')->orderBy('id', 'DESC');
    }

}

