<?php

use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return redirect()->away(env('SPA_URL'));
});

Route::get('/login', function () {
    return redirect()->away(env('SPA_URL'));
})->name('login');
