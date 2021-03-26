<?php

namespace App\Services\Tenant;


use App\Repositories\Tenant\SchoolRepository;
use Illuminate\Support\Arr;
use App\Models\Tenant\School;
class SchoolService
{
    protected $repository;

    public function __construct(SchoolRepository $repository)
    {
        $this->repository = $repository;
    }

    public function get($id) {
        $school = $this->repository->getOne($id);
        if ($school) {
            return $schoolData = Arr::only($school->toArray(),[
                'id',
                'name',
                'phone_number',
                'address_line_1',
                'city',
                'state',
                'zip_code',
            ]);
        }

        return null;
    }

    public function show() {   
        return School::firstOrFail();
    }

    public function store($data) {
        return $this->repository->store($data);
    }

    public function patch($data) {
        $id = $data['id'];
        unset($data['id']);
        return $this->repository->update($data, $id);
    }

}