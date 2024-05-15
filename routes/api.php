<?php

use App\Models\InviteesList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BannersController;
use App\Http\Controllers\Api\PackagesController;
use App\Http\Controllers\Api\DesignsController;
use App\Http\Controllers\Api\RatingsController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\InvitationsController;
use App\Http\Controllers\Api\InviteesListController;
use App\Http\Controllers\Api\CitiesController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\AboutAsController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\MethodsController;
use App\Http\Controllers\Api\CountriesController;
use App\Http\Controllers\Api\TermsController;
use App\Http\Controllers\Api\PaymentController;



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

Route::middleware('localization')->group(function (){

Route::get('cities', CitiesController::class);
Route::get('home', HomeController::class);
Route::get('banners', BannersController::class);
Route::get('designs', DesignsController::class);
Route::get('packages', PackagesController::class);
Route::get('notifications', NotificationController::class);
Route::get('methods', MethodsController::class);
Route::get('about-us', AboutAsController::class);
Route::get('countries', CountriesController::class);
Route::get('terms', TermsController::class);
Route::get('ratings', [RatingsController::class,'index']);
Route::get('payment_methods', [PaymentController::class,'index']);


Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'signup');
    Route::post('login', 'login');
    Route::post('send-code', 'sendCode');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('show-profile', [AuthController::class, 'showProfile']);
    Route::post('update-profile', [AuthController::class, 'updateProfile']);


    Route::post('ratings/store', [RatingsController::class,'store']);

    Route::resource('invitations',InvitationsController::class);

    Route::get('invitation/types', [InvitationsController::class,'types']);
    Route::post('invitation/check-coupon', [InvitationsController::class,'checkCode']);
    Route::post('invitation/additional-package', [InvitationsController::class,'additionalPackage']);
    Route::post('invitation/address/store', [AddressController::class,'store']);
    Route::get('invitation/scan-location/{id}', [AddressController::class,'scanQrcodeLocation']);

    Route::post('invitation/start-sending/{id}', [InvitationsController::class,'startSend']);
    Route::post('invitation/stop-sending/{id}', [InvitationsController::class,'stopSend']);

    Route::resource('inviteesList',InviteesListController::class)->only(['store', 'show']);
    Route::post('inviteesList/update/{id}', [InviteesListController::class,'update']);
    Route::post('inviteesList/update-numbered-invitation/{id}', [InviteesListController::class,'updateNumberedInvitation']);
    Route::post('inviteesList/update-status/{id}', [InviteesListController::class,'updateStatus']);
    Route::post('inviteesList/scan-qrcode/{id}', [InviteesListController::class,'scanQrcode']);
    Route::get('inviteesList/{id}/{status}', [InviteesListController::class,'showListByStatus']);
    Route::post('inviteesList/share-link/{id}', [InviteesListController::class,'shareLink']);

    Route::post('inviteesList/add-all', [InviteesListController::class,'addAllInvitees']);


    Route::post('notifications/{id}', [NotificationController::class,'update']);

    Route::post('checkout', [PaymentController::class,'checkout']);


});
    Route::post('callback/success', [PaymentController::class,'successCallback'])->name('success.callback');
    Route::post('callback/error', [PaymentController::class,'errorCallback'])->name('error.callback');

});
