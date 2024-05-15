<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\CitiesController;
use App\Http\Controllers\Dashboard\AboutUsController;
use App\Http\Controllers\Dashboard\BannersController;
use App\Http\Controllers\Dashboard\DesignsController;
use App\Http\Controllers\Dashboard\PackagesController;
use App\Http\Controllers\Dashboard\RatingsController;
use App\Http\Controllers\Dashboard\InvitationsController;
use App\Http\Controllers\Dashboard\InvitationTypesController;
use App\Http\Controllers\Dashboard\CouponsController;
use App\Http\Controllers\Dashboard\LinkController;
use App\Http\Controllers\Dashboard\NotificationController;
use App\Http\Controllers\Dashboard\MethodsController;
use App\Http\Controllers\Dashboard\PagesController;


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
Route::get('/test', function () {
    return \URL::signedRoute('share-link', ['user' => 6]);
});
Route::get('share-link/{user}', [LinkController::class,'index'])
    ->name('share-link')->middleware('signed');

Route::post('share-link/{user}', [LinkController::class,'updateStatus'])
    ->name('status-share-link')->middleware('signed');



Route::group(['middleware' => 'auth:admin','prefix' => 'admin/'], function() {
    Route::resource('users',UserController::class);
    Route::resource('cities',CitiesController::class);
    Route::resource('banners',BannersController::class);
    Route::resource('about-us',AboutUsController::class);
    Route::resource('designs',DesignsController::class);
    Route::resource('packages',PackagesController::class);
    Route::resource('invitations',InvitationsController::class);
    Route::resource('coupons',CouponsController::class);
    Route::resource('invitation-types',InvitationTypesController::class);
    Route::resource('ratings',RatingsController::class);
    Route::resource('notifications',NotificationController::class);
    Route::resource('methods',MethodsController::class);
    Route::resource('pages',PagesController::class);
    Route::post('/send/{id}', [NotificationController::class,'send'])->name('notifications.send');


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
