<?php

namespace App\Services\Tenant;

use App\Repositories\Tenant\TeacherRepository;
use Illuminate\Support\Arr;

class TeacherService
{
    protected $repository;

    public function __construct(TeacherRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll($requestData) {
        $teachers = $this->repository->getAll($requestData, isset($requestData['paginate']) ? $requestData['paginate'] : true);
        if ($teachers->count()) {
            $allTeachers = collect($teachers->all())->map->only([
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

            $paginatedData = $teachers->toArray();

            // case where data is not paginated
            if (isset($requestData['paginate']) && !$requestData['paginate']) {
                if (isset($requestData['fields'])) {
                    $fields = explode(',', $requestData['fields']);
                    $allTeachers = collect($teachers->all())->map->only($fields);
                }
                return $allTeachers;
            }

            // case where data is paginated
            $paginatedData['data'] = $allTeachers;
            return $paginatedData;
        }

        return null;
    }

    public function get($id) {
        $teacher = $this->repository->getOne($id);
        if ($teacher) {
            return $teacherData = Arr::only($teacher->toArray(),[
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