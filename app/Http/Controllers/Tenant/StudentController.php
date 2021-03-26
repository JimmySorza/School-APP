<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\API\Student\FetchAllStudentsRequest;
use App\Http\Requests\Tenant\API\Student\PatchStudentRequest;
use App\Http\Requests\Tenant\API\Student\StoreStudentRequest;
use App\Services\Tenant\StudentService;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $service;
    public function __construct(StudentService $service)
    {
        $this->service = $service;
    }

    public function get($id) {

        if (!$id) {
            return notFoundResponseJSON([], 'Student not found.');
        }

        if ($student = $this->service->get($id)) {
            return successFetchResponseJSON($student, 'Student successfully fetched.');
        }

        return notFoundResponseJSON([], 'Student not found.');
    }

    public function getAll(FetchAllStudentsRequest $request) {

        if ($students = $this->service->getAll($request->all())) {
            return successFetchResponseJSON($students, 'Student successfully fetched.');
        }

        return successFetchResponseJSON([], 'No student found.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreStudentRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        try {
            $this->service->store($request->all());
        } catch (\Exception $exception) {
            return internalServerErrorResponseJSON();
        }

        return successResponseJSON([], 'Student is added successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PatchStudentRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function patch(PatchStudentRequest $request)
    {
        try {
            $student = $this->service->patch($request->only([
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

        if (!$student) {
            return validationErrorResponseJSON([], 'Please check if the data is correct or contact admin.');
        }

        return successUpdateResponseJSON([], 'Student updated successfully');
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
