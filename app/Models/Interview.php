<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    //
    const TYPE_ONLINE = 0;
    const TYPE_TELEPHONE = 1;
    const TYPE_FACE_TO_FACE = 2;
    const TYPE = [
        0 => 'Online',
        1 => 'Telephone',
        2 => 'Face to Face',
    ];

    protected $fillable = [
        'application_id', 'date', 'time', 'type', 'venue', 'status', 'template_id'
    ];
}
