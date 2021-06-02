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

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RetailersBooksController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ResaleOrdersController;
use App\Http\Controllers\Masters\PackagesController;
use App\Http\Controllers\Masters\BooksController;
use App\Http\Controllers\Masters\UserManagementController;
use App\Http\Controllers\Masters\CouponController;
use App\Http\Controllers\Masters\PushNotificationController;
use App\Http\Controllers\APIController;

Route::get('/', function () {
    dd(public_path());
    return view('welcome');
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/home');
});


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('retailer_onboarding');

Route::get('/retailers-book', [RetailersBooksController::class, 'view']);

Route::get('/order/view', [OrdersController::class, 'view']);
Route::post('/order/status/update', [OrdersController::class, 'updateStatus']);

Route::get('/resale-order/view', [ResaleOrdersController::class, 'view']);
Route::post('/resale-order/status/update', [ResaleOrdersController::class, 'updateStatus']);

Route::group(['prefix' => 'master'], function() {
    //
    Route::group(['prefix' => 'packages'], function() {
        Route::get('/view', [PackagesController::class, 'view']);
        Route::post('/update', [PackagesController::class, 'update']);
    });

    Route::group(['prefix' => 'books'], function() {
        Route::get('/view', [BooksController::class, 'view']);
        Route::post('/update', [BooksController::class, 'bookUpdate']);
    });
});


Route::group(['prefix' => 'user-management'], function() {
    //
    Route::get('users/view', [UserManagementController::class, 'view']);
    Route::get('/users/get/{id}', [UserManagementController::class, 'getUser']);
    Route::post('/users/update', [UserManagementController::class, 'updateUser']);


    Route::get('/roles/view', [UserManagementController::class, 'rolesView']);
    Route::get('/role/get/{id}', [UserManagementController::class, 'getRole']);
    Route::post('/roles/update', [UserManagementController::class, 'updateRole']);
});


Route::group(['prefix' => 'coupon'], function() {
    //
    Route::get('/view', [CouponController::class, 'view']);
    Route::post('/update', [CouponController::class, 'update']);
    // Route::group(['prefix' => 'books'], function() {
    // });
});

Route::group(['prefix' => 'push-notification'], function() {
    //
    Route::get('/view', [PushNotificationController::class, 'view']);
    Route::post('/send', [PushNotificationController::class, 'send']);
    // Route::group(['prefix' => 'books'], function() {
    // });
});


Route::group(['prefix' => 'api'], function() {
    Route::post('/retailer-details/update', [APIController::class, 'retailerDetailsUpdate']);
    Route::post('/retailers-book/update', [RetailersBooksController::class, 'update']);

    Route::get('/inventory/datatable', [InventoryController::class, 'inventoryDatatables']);
    Route::post('/inventory/update', [InventoryController::class, 'update']);


    // datatables api
    Route::get('/retailers-books/datatable', [RetailersBooksController::class, 'datatable']);

    Route::get('/books/datatable', [Masters\BooksController::class, 'datatable']);

    Route::get('/orders/datatable', [OrdersController::class, 'datatable']);

    Route::get('/resale-order/datatable', [ResaleOrdersController::class, 'datatable']);

    Route::get('/coupon/datatable', [CouponController::class, 'datatables']);

    Route::get('/packages/datatable', [Masters\PackagesController::class, 'datatable']);

    Route::get('/push-notification/datatable', [PushNotificationController::class, 'datatable']);

    Route::get('/users/datatable', [UserManagementController::class, 'usersDatatable']);

    Route::get('/roles/datatable', [UserManagementController::class, 'rolesDatatable']);
});

