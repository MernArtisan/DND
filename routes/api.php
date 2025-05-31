<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('signup',[App\Http\Controllers\api\AuthController::class,'signup']);
Route::post('signin',[App\Http\Controllers\api\AuthController::class,'signin']);
Route::post('verify-otp',[App\Http\Controllers\api\AuthController::class,'verifyOtp']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [App\Http\Controllers\api\AuthController::class,'logout']);
    Route::post('profile', [App\Http\Controllers\api\ProfileController::class,'Updateprofile']);
    Route::get('profile', [App\Http\Controllers\api\ProfileController::class,'profile']);
});

