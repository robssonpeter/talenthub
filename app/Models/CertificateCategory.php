<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificateCategory extends Model
{
    public static $rules = [
        'name' => 'required|unique:certificate_categories,name',
    ];
    public $table = 'certificate_categories';
    public $fillable = [
        'name',
        'description',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'          => 'integer',
        'name'        => 'string',
        'description' => 'string',
    ];
}
