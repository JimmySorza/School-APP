<?php

namespace App\Services\Tenant;

use App\Repositories\Tenant\UserRepository;

class UserService
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function patch($data) {
        $id = $data['id'];
        unset($data['id']);
        return $this->repository->update($data, $id);
    }

}
