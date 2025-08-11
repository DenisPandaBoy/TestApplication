<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::middleware(['auth:sanctum'])->group(function ()
{
   /** Route::get('/temporary', function (Request $request)
    {
        $user = User::findOrFail(1);
        $user->password = bcrypt('noveHeslo');
        $user->save();
    });
    **/

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/user/update-password', [AuthController::class, 'updatePassword']);
    Route::post('/order/store', [OrderController::class, 'store']);
    Route::post('/order/update/{id}', [OrderController::class, 'update']);
    Route::post('/order/destroy/{id}', [OrderController::class, 'destroy']);
    Route::get('/order', [OrderController::class, 'index']);
    Route::get('/order/{id}', [OrderController::class, 'show']);
    Route::apiResource('order-items', OrderItemController::class);
});
