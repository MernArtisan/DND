<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::group(['middleware' => ['admin.guest']], function () {
        Route::get('login', [App\Http\Controllers\admin\AuthController::class, 'login'])->name('login');
        Route::post('authenticate', [App\Http\Controllers\admin\AuthController::class, 'authenticate'])->name('authenticate');
    });

    Route::group(['middleware' => ['admin.auth']], function () {
      Route::get('dashboard', [App\Http\Controllers\admin\DashboardControler::class, 'dashboard'])->name('dashboard');
      Route::post('logout', [App\Http\Controllers\admin\AuthController::class, 'logout'])->name('logout');
    });
});
