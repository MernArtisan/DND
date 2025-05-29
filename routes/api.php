<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('signup',[App\Http\Controllers\api\AuthController::class,'signup']);
Route::post('signin',[App\Http\Controllers\api\AuthController::class,'signin']);
Route::post('verify-otp',[App\Http\Controllers\api\AuthController::class,'verifyOtp']);

Route::get('/user', function (Request $request) {
    
    

})->middleware('auth:sanctum');

