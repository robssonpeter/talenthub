<?php

namespace App\Queries;

use App\Models\Company;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

/**
 * Class TransactionDataTable
 */
class TransactionDataTable
{
    /**
     * @return Transaction
     */
    public function get()
    {
        if (Auth::user()->hasRole('Admin')) {
            $query = Transaction::with(['type', 'user'])->get();
        }
        if (Auth::user()->hasRole('Employer')) {
            $query = Transaction::where('owner_id', Auth::user()->owner_id)->where('owner_type',
                Company::class)->Orwhere('user_id', Auth::user()->id)->get();
        }

        return $query;
    }
}
