<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\itemsController;
use App\Http\Controllers\Api\BannerController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login', 'Api\RegisterController@login');
Route::post('register', 'Api\RegisterController@register');

// Route::middleware('auth:api')->group(function () {
    Route::prefix('items')->name('items.')->group(function(){
        Route::post('/index',[itemsController::class,'index'])->name('index');
        Route::post('/newItems',[itemsController::class,'newItems'])->name('newItems');
        Route::post('/discountItems',[itemsController::class,'discountItems'])->name('discountItems');
        Route::post('/offerItems',[itemsController::class,'offerItems'])->name('offerItems');
        Route::post('/favorite',[itemsController::class,'favorite'])->name('favorite');
        Route::post('/A_to_Z',[itemsController::class,'A_to_Z'])->name('A_to_Z');
        Route::post('/Z_to_A',[itemsController::class,'Z_to_A'])->name('Z_to_A');
        Route::post('/price_highest',[itemsController::class,'price_highest'])->name('price_highest');
        Route::post('/price_lowest',[itemsController::class,'price_lowest'])->name('price_lowest');
    });
    Route::prefix('home')->name('home.')->group(function(){
        Route::post('/homeItems',[HomeController::class,'index'])->name('homeItems');
        Route::post('/search',[HomeController::class,'search'])->name('search');
    });
    Route::resource('Banner',BannerController::class);
    // Route::resource('Items',itemsController::class);
    // Route::get('sort/item',[sortController::class , 'A_to_Z'])->name('sort');
// });