<?php

use App\Http\Controllers\OrderController;
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
    Route::get('/order', [OrderController::class, 'index']);
});
