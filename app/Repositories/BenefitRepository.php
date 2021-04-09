<?php

namespace App\Repositories;

use App\Models\Benefit;

/**
 * Class BenefitRepository
 * @package App\Repositories
 * @version June 23, 2020, 5:43 am UTC
 */
class BenefitRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'benefit',
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
        return Benefit::class;
    }
}
