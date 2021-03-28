<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionCharge extends Model
{
    protected $fillable = [
        'payment_id', 'charged'
    ];
}
