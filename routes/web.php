<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MigrationController;
use Illuminate\Support\Facades\Response;

Route::get('/migrate', [MigrationController::class, 'runAll']);
Route::get('/migrate-1', [MigrationController::class, 'runSpecific']);
Route::get('/clear', [MigrationController::class, 'clearAll']);

Route::get('/viewer', function () {
    return view('welcome');
});
