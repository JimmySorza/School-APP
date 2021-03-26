<?php

namespace App\Repositories\Tenant;

use App\Models\Tenant\Student;

class StudentRepository extends BaseRepository
{

    public function __construct(Student $model)
    {
        $this->model = $model;
    }
}