<?php

use Illuminate\Support\Facades\Route;

Route::prefix('dnd')->name('dnd.')->middleware('auth')->group(function () {
    Route::group(['middleware' => ['admin.guest']], function () {
        Route::get('login', [App\Http\Controllers\admin\AuthController::class, 'login'])->name('login');
        Route::post('authenticate', [App\Http\Controllers\admin\AuthController::class, 'authenticate'])->name('authenticate');
    });

    Route::group(['middleware' => ['admin.auth']], function () {
        // Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    });
});
