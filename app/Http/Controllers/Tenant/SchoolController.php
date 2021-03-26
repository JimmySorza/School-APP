<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\API\School\PatchSchoolRequest;
use App\Http\Requests\Tenant\API\School\StoreSchoolRequest;
use App\Services\Tenant\SchoolService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Auth;
class SchoolController extends Controller
{
    protected $service;
    public function __construct(SchoolService $service)
    {
        $this->service = $service;
    }

    public function get($id) {
        if (!$id) {
            return notFoundResponseJSON([], 'School not found.');
        }
        if ($school = $this->service->get($id)) {
            return successFetchResponseJSON($school, 'School successfully fetched.');
        }
        return notFoundResponseJSON([], 'School not found.');
    }

    public function getUserSchools()
    {
        try {
            if(!Auth::check()){   
                return response()->json(['error' => 'you are not logged in'], 400);
            }    
        } catch (JWTException $e) {
            return response()->json(['error' => 'please login first'], 400);
        }

        $schools = Auth::user()->tenants()->get(['id','school']);
        
        return successResponseJSON(compact('schools'));
    }

    public function show()
    {
        return $this->service->show();
        if ($school = $this->service->first()) {
            return successFetchResponseJSON($school, 'School successfully fetched.');
        }
        return notFoundResponseJSON([], 'School not found.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSchoolRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSchoolRequest $request)
    {

        try {
            $this->service->store($request->all());
        } catch (\Exception $exception) {
            return internalServerErrorResponseJSON();
        }

        return successResponseJSON([], 'School is added successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PatchSchoolRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function patch(PatchSchoolRequest $request)
    {
        try {
            $school = $this->service->patch($request->all());
        } catch (\Exception $exception) {
            return internalServerErrorResponseJSON();
        }

        if (!$school) {
            return validationErrorResponseJSON([], 'Please check if the data is correct or contact admin.');
        }

        return successUpdateResponseJSON([], 'School updated successfully');
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
