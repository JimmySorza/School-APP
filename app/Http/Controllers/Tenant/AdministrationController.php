<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\API\Administration\PatchAdministrationRequest;
use App\Http\Requests\Tenant\API\Administration\StoreAdministrationRequest;
use App\Services\Tenant\AdministrationService;
use Illuminate\Http\Request;
use App\Http\Controllers\Tenant\AdministrationController;
class AdministrationController extends Controller
{
    /**
     * @var AdministrationService
     */
    private $service;

    /**
     * AdministrationController constructor.
     * @param AdministrationService $service
     */
    public function __construct(AdministrationService $service)
    {
        $this->service = $service;
    }

    public function get($id) {

        if (!$id) {
            return notFoundResponseJSON([], 'Administration not found.');
        }

        if ($teacher = $this->service->get($id)) {
            return successFetchResponseJSON($teacher, 'Administration successfully fetched.');
        }

        return notFoundResponseJSON([], 'Administration not found.');
    }

    public function getAll(Request $request) {
        if ($teachers = $this->service->getAll($request->all())) {
            return successFetchResponseJSON($teachers, 'Administration successfully fetched.');
        }

        return successFetchResponseJSON([], 'No administration found.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAdministrationRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreAdministrationRequest $request)
    {
        try {
            $this->service->store($request->all());
        } catch (\Exception $exception) {
            return internalServerErrorResponseJSON();
        }

        return successResponseJSON([], 'Administration is added successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PatchAdministrationRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function patch(PatchAdministrationRequest $request)
    {
        try {
            $teacher = $this->service->patch($request->all());
        } catch (\Exception $exception) {
            return internalServerErrorResponseJSON();
        }

        if (!$teacher) {
            return validationErrorResponseJSON([], 'Please check if the data is correct or contact admin.');
        }

        return successUpdateResponseJSON([], 'Administration updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
