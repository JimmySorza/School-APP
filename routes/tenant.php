<?php

declare(strict_types=1);

use Stancl\Tenancy\Middleware\InitializeTenancyByPath;
use App\Http\Controllers\Tenant\AdministrationController;
/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

// Route::group([
//     'prefix' => '/api/tenant/{tenant}/',
//     'namespace' => 'App\\Http\\Controllers\\Tenant',
//     'middleware' => [
//         InitializeTenancyByPath::class
//     ],
// ], function () {
//     Route::post('login', 'UserController@authenticate');
// });

Route::group([
    'prefix' => '/api/',
    'namespace' => 'App\\Http\\Controllers',
    'middleware' => [
        'jwt.verify',
    ],
], function () {
    Route::post('addschool', 'TenantController@registerTenant');
});


Route::group([
    'prefix' => '/api/tenant/',
    'namespace' => 'App\\Http\\Controllers\\Tenant',
    'middleware' => [
        'jwt.verify',
    ],
], function () {

    // Super admin
    Route::get('user', 'UserController@getAuthenticatedUser');
    Route::patch('user', 'UserController@patch');

    // Admin
    Route::get('get/administration', 'AdministrationController@getAll');
    Route::get('get/administration/{id}', 'AdministrationController@get');
    Route::post('post/administration', 'AdministrationController@store');
    Route::patch('patch/administration', 'AdministrationController@patch');

    // Period
    Route::get('get/period', 'PeriodController@getAll');
    Route::get('get/period/{id}', 'PeriodController@get');
    Route::post('post/period', 'PeriodController@store');
    Route::patch('patch/period', 'PeriodController@patch');
    Route::post('/period/post/user-matrix', 'PeriodController@storeUserMatrixLocation');

    // School
    Route::get('getUserSchools', 'SchoolController@getUserSchools');
    Route::get('get/school', 'SchoolController@show');
    Route::get('get/school/{id}', 'SchoolController@get');
    Route::post('post/school', 'SchoolController@store');
    Route::patch('patch/school', 'SchoolController@patch');

    // Teacher
    Route::get('get/teacher/{id}', 'TeacherController@get');
    Route::get('get/teachers', 'TeacherController@getAll');
    Route::post('post/teacher', 'TeacherController@store');
    Route::patch('patch/teacher', 'TeacherController@patch');

    // Student
    Route::get('get/student/{id}', 'StudentController@get');
    Route::get('get/students', 'StudentController@getAll');
    Route::post('post/student', 'StudentController@store');
    Route::patch('patch/student', 'StudentController@patch');
});

/*Route::group([
    'prefix' => '/{tenant}',
    'middleware' => [InitializeTenancyByPath::class],
], function () {
    Route::get('/', function () {
        return view('welcome');
    });
});*/
