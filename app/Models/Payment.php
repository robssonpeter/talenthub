<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'token', 'user_id', 'transaction_id', 'type', 'items', 'currency', 'amount', 'payment_method', 'paid', 'ref_no'
    ];
}
