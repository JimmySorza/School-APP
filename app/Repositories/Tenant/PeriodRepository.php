<?php

namespace App\Repositories\Tenant;

use App\Models\Tenant\Period;

class PeriodRepository extends BaseRepository
{
    /**
     * PeriodRepository constructor.
     * @param Period $model
     */
    public function __construct(Period $model)
    {
        $this->model = $model;
    }
}
