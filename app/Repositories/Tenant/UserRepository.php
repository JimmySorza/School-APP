<?php

namespace App\Repositories\Tenant;

use App\Models\Tenant\User;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
