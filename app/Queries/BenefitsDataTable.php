<?php

namespace App\Queries;

use App\Models\Benefit;

/**
 * Class BenefitDataTable
 */
class BenefitsDataTable
{
    /**
     * @return Benefit
     */
    public function get()
    {
        /** @var Benefit $query */
        $query = Benefit::query()->select('benefits.*');

        return $query;
    }
}
