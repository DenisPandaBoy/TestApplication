<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\IsUserAdmin;
use App\Http\Middleware\IsUserPairedWithOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::middleware(['auth:sanctum'])->group(function ()
{
    /** Route::get('/temporary', function (Request $request)
     * {
     * $user = User::findOrFail(1);
     * $user->password = bcrypt('noveHeslo');
     * $user->save();
     * });
     **/

    Route::get('/user', function (Request $request)
    {
        return $request->user();
    });
    Route::post('/user/update-password', [AuthController::class, 'updatePassword']);
    Route::apiResource('users', UserController::class);

    Route::apiResource('orders', OrderController::class)
    ->middlewareFor(['show', 'update', 'destroy'],IsUserPairedWithOrder::class);

    Route::apiResource('categories', CategoryController::class)
        ->middlewareFor(['store', 'update', 'destroy'],IsUserAdmin::class);

    Route::apiResource('order-items', OrderItemController::class)->only(['update', 'destroy']);
    Route::get('order-items/{order_id}', [OrderItemController::class, 'index']);
    Route::post('order-items/store/{order_id}', [OrderItemController::class, 'store']);
});
