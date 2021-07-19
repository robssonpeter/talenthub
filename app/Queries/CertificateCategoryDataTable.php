<?php

namespace App\Queries;

use App\Models\CertificateCategory;
use App\Models\Industry;

/**
 * Class IndustryDataTable
 */
class CertificateCategoryDataTable
{
    /**
     * @return Industry
     */
    public function get()
    {
        /** @var Industry $query */
        $query = CertificateCategory::query()->select('certificate_categories.*');

        return $query;
    }
}
