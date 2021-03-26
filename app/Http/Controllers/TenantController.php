<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterTenantAndUserRequest;
use App\Http\Requests\CheckSchoolRequest;
use App\Models\Tenant\School;
use App\Models\Tenant;
use App\Models\Tenant\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService as SlugService;
use Auth;
class TenantController extends Controller
{

    private $school; 

    public function registerTenant(RegisterTenantAndUserRequest $request)
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return notFoundResponseJSON([], 'user not found.');
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return validationErrorResponseJSON(['token' => $e->getMessage()], 'The given data was invalid.', 'Error', 400);
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return validationErrorResponseJSON(['token' => $e->getMessage()], 'The given data was invalid.', 'Error', 400);

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return validationErrorResponseJSON(['token' => $e->getMessage()], 'The given token is invalid.', 'Error', 400);
        }

        DB::beginTransaction();
        $trimSchool = substr($request->get('school'), 0, 25);
        $school_id = SlugService::createSlug(Tenant::class, 'id', $trimSchool);
        $data = [
            "id"    => $school_id,
            "school" => $request->school,
            "district" => $request->district,
            "state" => $request->state,
        ];
        
        $tenant = Tenant::create($data);

        Auth::user()->tenants()->attach($school_id);
            
        
        $tenant->domains()->create(['domain' => $school_id]);
        
        $tenant->run(function () use ($request) {
           $this->school = School::create(['name' => $request->school, "district" => $request->district,  'state' => $request->state, 'email' =>  Auth::user()->email]);
        });

        $school = $this->school;
        DB::commit();
        return successResponseJSON([compact('school')], 'Tenant created Successfully.', 'Success', 201);
    }
}
