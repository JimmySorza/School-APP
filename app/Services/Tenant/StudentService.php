<?php

namespace App\Services\Tenant;

use App\Repositories\Tenant\StudentRepository;
use Illuminate\Support\Arr;

class StudentService
{
    protected $repository;

    public function __construct(StudentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll($requestData) {
        $students = $this->repository->getAll($requestData, isset($requestData['paginate']) ? $requestData['paginate'] : true);
        if ($students->count()) {
            $allStudents = collect($students->all())->map->only([
                'id',
                'first_name',
                'last_name',
                'id_number',
                'email',
                'phone_number',
                'address_line_1',
                'country',
                'city',
                'state',
                'zip_code',
            ]);

            $paginatedData = $students->toArray();

            // case where data is not paginated
            if (isset($requestData['paginate']) && !$requestData['paginate']) {
                if (isset($requestData['fields'])) {
                    $fields = explode(',', $requestData['fields']);
                    $allStudents = collect($students->all())->map->only($fields);
                }
                return $allStudents;
            }

            // case where data is paginated
            $paginatedData['data'] = $allStudents;
            return $paginatedData;
        }

        return null;
    }

    public function get($id) {
        $student = $this->repository->getOne($id);
        if ($student) {
            return $studentData = Arr::only($student->toArray(),[
                'id',
                'first_name',
                'last_name',
                'id_number',
                'email',
                'phone_number',
                'address_line_1',
                'country',
                'city',
                'state',
                'zip_code',
            ]);
        }

        return null;
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