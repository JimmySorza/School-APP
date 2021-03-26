<?php

namespace App\Repositories\Tenant;

use App\Models\Tenant\School;

class SchoolRepository extends BaseRepository
{

    public function __construct(School $model)
    {
        $this->model =new School;
    }
}