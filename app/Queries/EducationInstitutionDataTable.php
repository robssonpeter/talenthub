<?php

namespace App\Queries;

use App\Models\EducationInstitution;

/**
 * Class SalaryCurrencyDataTable
 */
class EducationInstitutionDataTable
{
    /**
     * @return SalaryCurrency
     */
    public function get()
    {
        /** @var SalaryCurrency $query */
        $query = EducationInstitution::query()->join('countries', 'countries.id', 'education_institutions.country_id')->select('education_institutions.*', 'countries.name as country_name');

        return $query;
    }
}
