<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MigrationController;



Route::get('/run-migrate', [MigrationController::class, 'runAll']);
Route::get('/run-specific-migration', [MigrationController::class, 'runSpecific']);

Route::get('/', function () {
    return view('welcome');
    // return "abc";
});
