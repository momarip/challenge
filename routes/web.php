<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\InviteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/{pathMatch}', function(){return view('welcome');})->where('pathMatch', '.*');
Route::group(['middleware' => ['auth']], function() {
    // Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('companies', CompanyController::class);
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

