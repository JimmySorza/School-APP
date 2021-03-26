<?php

namespace App\Repositories\Tenant;

use App\Models\Tenant\Administration;

class AdministrationRepository extends BaseRepository
{
    /**
     * @var Administration
     */
    public $model;

    /**
     * AdministrationRepository constructor.
     * @param Administration $model
     */
    public function __construct(Administration $model)
    {
        $this->model = $model;
    }
}
