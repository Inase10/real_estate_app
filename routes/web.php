<?php

use App\Http\Livewire\Counter;
use App\Http\Livewire\CounterSeller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\GEOlocationController;
use App\Http\Controllers\web\UserControllerWeb;
use Illuminate\Support\Facades\Artisan;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [OfferController::class, 'getLastOffers'])->name('welcome');


// auth route for both
Route::group(['middleware'=>['auth','role:seller']],function(){
    Route::get('/addProperty', function () {
        return view('property.addProperty');
    })->name("addProerty");
    Route::get('/myOffers/{id}', [OfferController::class, 'myoffers'])->name("myoffers");
    Route::get('/myOffers/edit_offer/{id}', [OfferController::class, 'edit_offer'])->name("edit_offer");


    Route::post('/properties_seller/store', [PropertyController::class, 'store'])->name('store_property_seller');
    // Route::post('/properties/store', [PropertyController::class, 'store'])->name('store_property');

    // Route::post('/arcgis-api',[GEOlocationController::class, 'arcgis'])->name('arcgis-api');
    Route::post('/offer/update', [OfferController::class, 'update'])->name('update_offer');

    Route::post('/offer/delete', [OfferController::class, 'delete'])->name('delete_offer');

    Route::post('/positionstack-api',[GEOlocationController::class, 'positionStack'])->name('positionstack-api');
    Route::get('/seller',CounterSeller::class)->name('seller');

    // Route::get('/dashboard','App\Http\Controllers\DashboardController@index')->name('dashboard');
    // Route::get('/dashboard/myprofile','App\Http\Controllers\DashboardController@myprofile')->name('dashboard.myprofile');
    // Route::get('/customer',Counter::class)->name('customer');
    // Route::get('/seller',CounterSeller::class)->name('seller');


});
Route::group(['middleware'=>['auth','role:customer']],function(){
Route::get('/customer',Counter::class)->name('customer');

});
// auth route for both
Route::group(['middleware'=>['auth']],function(){
    Route::get('/dashboard','App\Http\Controllers\DashboardController@index')->name('dashboard');
    Route::get('/dashboard/myprofile','App\Http\Controllers\DashboardController@myprofile')->name('dashboard.myprofile');
    // Route::get('/seller',CounterSeller::class)->name('seller');
    Route::get('/detail/{id}', [PropertyController::class, 'detail']);
    Route::post('/users_web/store', [UserControllerWeb::class, 'store'])->name('store_user_web');
    Route::post('/users_web/update', [UserControllerWeb::class, 'update'])->name('update_user_web');
    Route::post('/order_rent/store', [OrderController::class, 'storeRent'])->name('store_order_rent');
    Route::post('/order_buy/store', [OrderController::class, 'storeBuy'])->name('store_order_buy');

    Route::get('/myOrders/{id}', [OrderController::class, 'myorders'])->name("myorders");

});

Route::group(['middleware'=>['auth','role:admin']],function(){
    // Route::group(['middleware'=>['auth']],function(){
        Route::get('/profile-admin', [UserController::class, 'profileAdmin'])->name('profile-admin');

    // Route::get('/dashboard/myprofile','App\Http\Controllers\DashboardController@myprofile')->name('dashboard.myprofile');
    Route::get('users', [UserController::class, 'index'])->name('all_users');
    Route::get('/users/fetchall', [UserController::class, 'fetchAll'])->name('fetchAll_users');
    Route::delete('/users/delete', [UserController::class, 'delete'])->name('delete_user');
    Route::get('/users/edit', [UserController::class, 'edit'])->name('edit_user');
    Route::post('/users/store', [UserController::class, 'store'])->name('store_user');
    Route::post('/users/update', [UserController::class, 'update'])->name('update_user');

    Route::get('/properties', [PropertyController::class, 'index'])->name('all_properties');
    Route::post('/properties/store', [PropertyController::class, 'store'])->name('store_property');
    Route::get('/properties/fetchall', [PropertyController::class, 'fetchAll'])->name('fetchAll_properties');
    Route::delete('/properties/delete', [PropertyController::class, 'delete'])->name('delete_property');
    Route::get('/properties/edit', [PropertyController::class, 'edit'])->name('edit_property');
    Route::post('/properties/update', [PropertyController::class, 'update'])->name('update_property');

    Route::get('/offers', [OfferController::class, 'index'])->name('all_offers');
    Route::get('/offers/fetchall', [OfferController::class, 'fetchAll'])->name('fetchAll_offers');
    Route::post('/offers/approve', [OfferController::class, 'approve'])->name('approve_offer');
    Route::post('/offers/reject', [OfferController::class, 'reject'])->name('reject_offer');


    Route::get('/orders', [OrderController::class, 'index'])->name('all_orders');
    Route::get('/orders/fetchall', [OrderController::class, 'fetchAll'])->name('fetchAll_orders');
    Route::post('/orders/approve', [OrderController::class, 'approve'])->name('approve_order');
    Route::post('/orders/reject', [OrderController::class, 'reject'])->name('reject_order');


});



Route::get('migrate', function ()
{
    echo 'storage link command running..';
    return Artisan::exec('php artian storage:link');
});


require __DIR__.'/auth.php';