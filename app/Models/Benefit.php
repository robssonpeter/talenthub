<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    public static $rules = [
        'name' => 'required|unique:benefits,name',
    ];
}
