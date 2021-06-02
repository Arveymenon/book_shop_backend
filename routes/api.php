<?php

use Illuminate\Http\Request;

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

use App\Http\Controllers\APIController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/send-sms', [
    'uses'   =>  'SmsController@getUserNumber',
    'as'     =>  'sendSms'
    ]);


Route::post('/register',[APIController::class,'register']); // Can Also Update the user
Route::post('/login',[APIController::class,'login']);


Route::group(['prefix' => 'books'], function() {
    //
    Route::post('/get/{id}',[APIController::class,'getBooks']);
    Route::get('/filter/options',[APIController::class,'booksFilterOptions']);
});


Route::get('address/{id}',[APIController::class,'getAddresses']);
Route::post('address/update',[APIController::class,'updateAddress']);
Route::post('address/delete/{id}',[APIController::class,'deleteAddress']);

Route::group(['prefix' => 'order'], function() {
    //
    Route::post('post',[APIController::class,'postOrders']);
    Route::get('cancel/request/{id}',[APIController::class,'orderCancelation']);

    Route::get('user/{id}',[APIController::class,'usersOrder']);
    Route::get('details/{id}',[APIController::class,'getOrderDetails']);

});
Route::post('recommendations/get',[APIController::class,'getRecommendations']);

Route::group(['prefix' => 'resale'], function() {
    //

    Route::post('post',[APIController::class,'postResale']);
    Route::get('user/{id}',[APIController::class,'getUserResaleOrders']);
    Route::get('order/details/{id}',[APIController::class,'getResaleOrderDetails']);
    // to be made
    Route::get('cancel/request/{id}',[APIController::class,'resaleCancelation']);

});

Route::post('coupon/check',[APIController::class,'checkCouponCode']);
