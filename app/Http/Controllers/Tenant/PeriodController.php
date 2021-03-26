<?php


namespace App\Http\Controllers\Tenant;


use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\API\Period\PatchPeriodRequest;
use App\Http\Requests\Tenant\API\Period\StorePeriodRequest;
use App\Http\Requests\Tenant\API\Period\StorePeriodStudentLocationRequest;
use App\Services\Tenant\PeriodService;
use Facade\FlareClient\Http\Exceptions\InvalidData;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PeriodController extends Controller
{
    /**
     * @var PeriodService
     */
    private $service;

    /**
     * PeriodController constructor.
     * @param PeriodService $service
     */
    public function __construct(PeriodService $service)
    {
        $this->service = $service;
    }

    public function get($id) {

        if (!$id) {
            return notFoundResponseJSON([], 'Period not found.');
        }

        if ($teacher = $this->service->get($id)) {
            return successFetchResponseJSON($teacher, 'Period successfully fetched.');
        }

        return notFoundResponseJSON([], 'Period not found.');
    }

    public function getAll(Request $request) {

        if ($teachers = $this->service->getAll($request->all())) {
            return successFetchResponseJSON($teachers, 'Period successfully fetched.');
        }

        return successFetchResponseJSON([], 'No administration found.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePeriodRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePeriodRequest $request)
    {
        try {
            $this->service->store($request->all());
        } catch (\Exception $exception) {
            return internalServerErrorResponseJSON();
        }

        return successResponseJSON([], 'Period is added successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PatchPeriodRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function patch(PatchPeriodRequest $request)
    {
        try {
            $teacher = $this->service->patch($request->all());
        } catch (\Exception $exception) {
            return internalServerErrorResponseJSON();
        }

        if (!$teacher) {
            return validationErrorResponseJSON([], 'Please check if the data is correct or contact admin.');
        }

        return successUpdateResponseJSON([], 'Period updated successfully');
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

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePeriodStudentLocationRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeUserMatrixLocation(StorePeriodStudentLocationRequest $request)
    {
        try {
            $data = [
                'period_id' => $request->get('period_id'),
                'student_id' => $request->get('student_id'),
                'matrix_place_row' => $request->get('matrix_place_row', null),
                'matrix_place_col' => $request->get('matrix_place_col', null)
            ];
            $this->service->storeUserMatrixLocation($data);
            return successUpdateResponseJSON();
        } catch (NotFoundHttpException $exception) {
            return notFoundResponseJSON();
        } catch (InvalidData $exception) {
            return notFoundResponseJSON([], $exception->getMessage(), 'Data error', $exception->getCode());
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            return internalServerErrorResponseJSON();
        }
    }

}
