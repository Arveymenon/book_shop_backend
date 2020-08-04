<?php

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

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/home');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('retailer_onboarding');

Route::get('/retailers-book', 'RetailersBooksController@view');

Route::get('/order/view', 'OrdersController@view');
Route::post('/order/status/update', 'OrdersController@updateStatus');

Route::get('/resale-order/view', 'ResaleOrdersController@view');
Route::post('/resale-order/status/update', 'ResaleOrdersController@updateStatus');

Route::group(['prefix' => 'master'], function() {
    //
    Route::group(['prefix' => 'packages'], function() {
        Route::get('/view', 'Masters\PackagesController@view');
        Route::post('/update', 'Masters\PackagesController@update');
    });

    Route::group(['prefix' => 'books'], function() {
        Route::get('/view', 'Masters\BooksController@view');
        Route::post('/update', 'Masters\BooksController@bookUpdate');
    });
});


Route::group(['prefix' => 'user-management'], function() {
    //
    Route::get('users/view', 'UserManagementController@view');
    Route::get('/users/get/{id}', 'UserManagementController@getUser');
    Route::post('/users/update', 'UserManagementController@updateUser');


    Route::get('/roles/view', 'UserManagementController@rolesView');
    Route::get('/role/get/{id}', 'UserManagementController@getRole');
    Route::post('/roles/update', 'UserManagementController@updateRole');
});


Route::group(['prefix' => 'coupon'], function() {
    //
    Route::get('/view', 'CouponController@view');
    Route::post('/update', 'CouponController@update');
    // Route::group(['prefix' => 'books'], function() {
    // });
});

Route::group(['prefix' => 'push-notification'], function() {
    //
    Route::get('/view', 'PushNotificationController@view');
    Route::post('/send', 'PushNotificationController@send');
    // Route::group(['prefix' => 'books'], function() {
    // });
});


Route::group(['prefix' => 'api'], function() {
    Route::post('/retailer-details/update', 'APIController@retailerDetailsUpdate');
    Route::post('/retailers-book/update', 'RetailersBooksController@update');

    Route::get('/inventory/datatable', 'InventoryController@inventoryDatatables');
    Route::post('/inventory/update', 'InventoryController@update');


    // datatables api
    Route::get('/retailers-books/datatable', 'RetailersBooksController@datatable');

    Route::get('/books/datatable', 'Masters\BooksController@datatable');

    Route::get('/orders/datatable', 'OrdersController@datatable');

    Route::get('/resale-order/datatable', 'ResaleOrdersController@datatable');

    Route::get('/coupon/datatable', 'CouponController@datatables');

    Route::get('/packages/datatable', 'Masters\PackagesController@datatable');

    Route::get('/push-notification/datatable', 'PushNotificationController@datatable');

    Route::get('/users/datatable', 'UserManagementController@usersDatatable');

    Route::get('/roles/datatable', 'UserManagementController@rolesDatatable');
});

