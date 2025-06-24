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

    Route::resource('/banner', App\Http\Controllers\admin\BannerController::class);
    Route::resource('/category', App\Http\Controllers\admin\CategoryController::class);
    Route::resource('/channel', App\Http\Controllers\admin\ChannelController::class);
    Route::resource('/user-streamer', App\Http\Controllers\admin\UserController::class);
    Route::post('/channel/toggle-status', [App\Http\Controllers\admin\ChannelController::class, 'toggleStatus'])->name('channel.toggleStatus');
    Route::get('/user-streamer-details', [App\Http\Controllers\admin\UserController::class, 'details'])->name('user-streamer.details');
    Route::post('/user-streamer/toggle-status', [App\Http\Controllers\admin\UserController::class, 'toggleStatus'])->name('user-streamer.toggleStatus');
    Route::get('/privacy-policy', [App\Http\Controllers\admin\ContentController::class, 'Privacy'])->name('privacy-policy');
    Route::put('/privacy-policy-update', [App\Http\Controllers\admin\ContentController::class, 'updatePrivacy'])->name('privacy-policy-update');


    Route::get('/terms-condition', [App\Http\Controllers\admin\ContentController::class, 'Terms'])->name('terms-condition');
    Route::put('/terms-condition-update', [App\Http\Controllers\admin\ContentController::class, 'updateTerms'])->name('terms-condition-update');
    Route::get('/streams', [App\Http\Controllers\admin\StreamController::class, 'Stream'])->name('streams');
  });
});
