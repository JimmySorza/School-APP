<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\API\User\LoginUserRequest;
use App\Http\Requests\Tenant\API\User\RegisterUserRequest;
use App\Http\Requests\Tenant\API\User\PatchUserRequest;
use App\Services\Tenant\UserService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\Tenant\User;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    private $service;

    /**
     * UserController constructor.
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * @param LoginUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(LoginUserRequest $request)
    {
        $credentials = $request->only('username', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        
        $user = Auth::user();
        return successResponseJSON(compact('token', 'user'));
    }

    public function registration(RegisterUserRequest $request)
    {
        try{
            $token = null;
            $user = null;
            $user = User::create([
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'username' => $request->get('username'),
                'email' => $request->get('email'),
                'phone_number' => $request->get('phone_number'),
                'role' => "super-admin",
                'is_message' => $request->get('is_message'),
                'password' => Hash::make($request->get('password')),
            ]);

            $token = JWTAuth::fromUser($user);
            return successResponseJSON([compact('user','token')], 'Tenant created Successfully.', 'Success', 201);
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_register_user'], 500);
        }
        
    }
    
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAuthenticatedUser()
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

        return successResponseJSON(compact('user'));
    }

    /**
     * Update the specified resource in database.
     *
     * @param PatchUserRequest|Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function patch(PatchUserRequest $request)
    {
        try {
            $user = $this->service->patch($request->only('id', 'name', 'password'));
        } catch (\Exception $exception) {
            return internalServerErrorResponseJSON();
        }

        if (!$user) {
            return validationErrorResponseJSON([], 'Please check if the data is correct or contact admin.');
        }

        return successUpdateResponseJSON([], 'User updated successfully');
    }
}
