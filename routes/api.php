<?php

use App\Coupon;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\Categories;
use App\Http\Controllers\Api\Coupons;
use App\Http\Controllers\Api\Specifications;
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
// route::namespace('Api')->prefix('api')->group(function(){
//     route::get('','');
// });
Route::namespace('Api')->middleware(['corsfruit'])->group(function(){
    Route::post('login', 'Authentication@login');
});

Route::group(['middleware' => ['corsfruit','jwt.verify']], function() {
    Route::prefix('admin')->namespace('Api')->group(function () {
        //Admin routes
        /******************************************************************/
            //Authentication
            Route::get('logout', [Authentication::class, 'logout']);
            //Route::get('get_user', [ApiController::class, 'get_user']);
        /******************************************************************/
            //Data Api
            Route::get('main-data/{lang}',[ApiController::class,'mainData']);
        /******************************************************************/
            //Specifications Api
            Route::post('specifications',[Specifications::class,'store']);
            Route::get('specifications/delete/{id}',[Specifications::class,'delete']);
            //Coupons Api
            Route::post('coupons',[Coupons::class,'store']);
            Route::post('coupons/{id}',[Coupons::class,'update']);
            Route::get('coupons/delete/{id}',[Coupons::class,'delete']);

             //Categories Api
             Route::post('categories',[Categories::class,'store']);
             Route::post('categories/{id}',[Categories::class,'update']);
             Route::get('categories/delete/{id}',[Categories::class,'delete']);






             //Admin routes

    });
});
