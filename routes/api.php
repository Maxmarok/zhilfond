<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([
    'prefix' => '/v1',
    'as' => 'api.',
], function(){

    Route::get('/items', [App\Http\Controllers\API\ItemsController::class, 'getItems']);
    Route::post('/cart', [App\Http\Controllers\API\CartController::class, 'getCart']);
    Route::post('/order', [App\Http\Controllers\API\CartController::class, 'createOrder']);
    Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->prefix('orders')->as('orders.')->group(function(){
        Route::get('/', [App\Http\Controllers\API\Dashboard\OrdersController::class, 'getOrders']);
        Route::delete('/delete/{id}', [App\Http\Controllers\API\Dashboard\OrdersController::class, 'deleteOrder'])->name('delete');
    });
});