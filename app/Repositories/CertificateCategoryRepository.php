<?php

namespace App\Repositories;

use App\Models\CertificateCategory;

/**
 * Class IndustryRepository
 * @package App\Repositories
 * @version June 20, 2020, 5:43 am UTC
 */
class CertificateCategoryRepository extends BaseRepository
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
        return CertificateCategory::class;
    }
}
