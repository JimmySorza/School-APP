<?php


namespace App\Services\Tenant;


use App\Repositories\Tenant\AdministrationRepository;
use Illuminate\Support\Arr;

class AdministrationService
{
    /**
     * @var AdministrationRepository
     */
    private $repository;

    /**
     * AdministrationService constructor.
     * @param AdministrationRepository $repository
     */
    public function __construct(AdministrationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll($requestData) {
        $administrations = $this->repository->getAll($requestData, isset($requestData['paginate']) ? $requestData['paginate'] : true);
        if ($administrations->count()) {
            $allAdministrations = collect($administrations->all())->map->only([
                "id",
                "name",
                "first_name",
                "last_name",
                "id_number",
                "email",
                "phone_number",
                "address_line_1",
                "city",
                "state",
                "zip_code",
                "trace_risk_level",
                "trace_risk_count",
                "position",
            ]);

            $paginatedData = $administrations->toArray();

            // case where data is not paginated
            if (isset($requestData['paginate']) && !$requestData['paginate']) {
                if (isset($requestData['fields'])) {
                    $fields = explode(',', $requestData['fields']);
                    $allAdministrations = collect($administrations->all())->map->only($fields);
                }
                return $allAdministrations;
            }

            // case where data is paginated
            $paginatedData['data'] = $allAdministrations;

            return $paginatedData;
        }

        return null;
    }

    public function get($id) {
        $administration = $this->repository->getOne($id);
        if ($administration) {
            return Arr::only($administration->toArray(),[
                "id",
                "first_name",
                "last_name",
                "id_number",
                "email",
                "phone_number",
                "address_line_1",
                "city",
                "state",
                "zip_code",
                "trace_risk_level",
                "trace_risk_count",
                "position",
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
