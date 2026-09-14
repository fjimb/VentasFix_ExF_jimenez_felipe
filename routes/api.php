<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\ClienteApiController;
use App\Http\Controllers\Api\ProductoApiController;
use App\Http\Controllers\Api\UserApiController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthApiController::class, 'login']);

Route::middleware('auth:sanctum')->name('api.')->group(function () {
    Route::post('/logout', [AuthApiController::class, 'logout'])->name('logout');

    Route::apiResource('usuarios', UserApiController::class);
    Route::apiResource('productos', ProductoApiController::class);
    Route::apiResource('clientes', ClienteApiController::class);
});