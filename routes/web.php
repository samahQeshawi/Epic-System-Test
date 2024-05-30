<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\EmployeesController;
use App\Http\Controllers\Dashboard\GroupsController;



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




Route::group(['middleware' => 'auth:admin','prefix' => 'admin/'], function() {
    Route::resource('employees',EmployeesController::class);
    Route::resource('groups',GroupsController::class);

    Route::post('/logout', [AuthController::class,'logout'])->name('admin.logout');

});

Route::group(['middleware' => 'web' ,'prefix' => 'admin/'], function () {
    // Login Routes
    Route::get('/', function () {
        return redirect('/admin/login');
    });
    Route::get('login',  [AuthController::class,'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class,'login'])->name('admin.signIn');

});
