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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/send-sms', [
    'uses'   =>  'SmsController@getUserNumber',
    'as'     =>  'sendSms'
    ]);


Route::post('/register','APIController@register'); // Can Also Update the user
Route::post('/login','APIController@login');


Route::group(['prefix' => 'books'], function() {
    //
    Route::post('/get/{id}','APIController@getBooks');
    Route::get('/filter/options','APIController@booksFilterOptions');
});


Route::get('address/{id}','APIController@getAddresses');
Route::post('address/update','APIController@updateAddress');
Route::post('address/delete/{id}','APIController@deleteAddress');

Route::group(['prefix' => 'order'], function() {
    //
    Route::post('post','APIController@postOrders');
    Route::get('cancel/request/{id}','APIController@orderCancelation');

    Route::get('user/{id}','APIController@usersOrder');
    Route::get('details/{id}','APIController@getOrderDetails');

});
Route::post('recommendations/get','APIController@getRecommendations');

Route::group(['prefix' => 'resale'], function() {
    //

    Route::post('post','APIController@postResale');
    Route::get('user/{id}','APIController@getUserResaleOrders');
    Route::get('order/details/{id}','APIController@getResaleOrderDetails');
    // to be made
    Route::get('cancel/request/{id}','APIController@resaleCancelation');

});

Route::post('coupon/check','APIController@checkCouponCode');
