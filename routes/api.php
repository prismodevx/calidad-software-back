<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);


Route::middleware(['auth:api'])->group(function () {
    Route::get('test', [AuthController::class, 'test']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

