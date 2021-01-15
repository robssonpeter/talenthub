<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationNote extends Model
{
    //
    protected $fillable = [
        'application_id', 'user_id', 'description'
    ];

    public function author(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
