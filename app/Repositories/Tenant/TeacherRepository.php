<?php

namespace App\Repositories\Tenant;

use App\Models\Tenant\Teacher;

class TeacherRepository extends BaseRepository
{

    public function __construct(Teacher $model)
    {
        $this->model = $model;
    }
}