<?php

namespace App\Repositories;

use App\Models\EducationInstitution;

/**
 * Class SalaryCurrencyRepository
 * @package App\Repositories
 * @version July 7, 2020, 6:41 am UTC
 */
class EducationInstitutionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return EducationInstitution::class;
    }
}
