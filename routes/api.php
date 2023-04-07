<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function(){
    Route::post('register', "register");
    Route::post('login', "login");
});

Route::controller(CompanyController::class)->group(function(){
    Route::get('get_all_companies', 'get_all_companies');
    Route::post('create_company', 'create_company');
    Route::post('update_company/{id}', 'update_company');
    Route::delete('delete_company/{id}', 'delete_company');
});

Route::controller(EmployeeController::class)->group(function(){
    Route::get('get_all_employees', 'get_all_employees');
    Route::post('create_employee', 'create_employee');
    Route::post('update_employee/{id}', 'update_employee');
    Route::delete('delete_employee/{id}', 'delete_employee');
});

