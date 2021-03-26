<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\API\Teacher\FetchAllTeachersRequest;
use App\Http\Requests\Tenant\API\Teacher\PatchTeacherRequest;
use App\Http\Requests\Tenant\API\Teacher\StoreTeacherRequest;
use App\Services\Tenant\TeacherService;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    protected $service;
    public function __construct(TeacherService $service)
    {
        $this->service = $service;
    }

    public function get($id) {

        if (!$id) {
            return notFoundResponseJSON([], 'Teacher not found.');
        }

        if ($teacher = $this->service->get($id)) {
            return successFetchResponseJSON($teacher, 'Teacher successfully fetched.');
        }

        return notFoundResponseJSON([], 'Teacher not found.');
    }

    public function getAll(FetchAllTeachersRequest $request) {

        if ($teachers = $this->service->getAll($request->all())) {
            return successFetchResponseJSON($teachers, 'Teacher successfully fetched.');
        }

        return successFetchResponseJSON([], 'No teacher found.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTeacherRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeacherRequest $request)
    {
        try {
            $this->service->store($request->all());
        } catch (\Exception $exception) {
            return internalServerErrorResponseJSON();
        }

        return successResponseJSON([], 'Teacher is added successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PatchTeacherRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function patch(PatchTeacherRequest $request)
    {
        try {
            $teacher = $this->service->patch($request->only([
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
            ]));
        } catch (\Exception $exception) {
            return internalServerErrorResponseJSON();
        }

        if (!$teacher) {
            return validationErrorResponseJSON([], 'Please check if the data is correct or contact admin.');
        }

        return successUpdateResponseJSON([], 'Teacher updated successfully');
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
