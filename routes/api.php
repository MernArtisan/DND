<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// Authenticate apis
Route::post('signup', [App\Http\Controllers\api\AuthController::class, 'signup']);
Route::post('signin', [App\Http\Controllers\api\AuthController::class, 'signin']);
Route::post('verify-otp', [App\Http\Controllers\api\AuthController::class, 'verifyOtp']);
// Middleware To Protect Over Auth Routes
Route::middleware(['auth:sanctum'])->group(function () {
    // Profile Routes
    Route::post('logout', [App\Http\Controllers\api\ProfileController::class, 'logout']);
    Route::post('profile', [App\Http\Controllers\api\ProfileController::class, 'Updateprofile']);
    Route::get('profile', [App\Http\Controllers\api\ProfileController::class, 'profile']);
    // Channel Routes
    Route::post('channel/create', [App\Http\Controllers\api\ChannelController::class, 'create']);
});
