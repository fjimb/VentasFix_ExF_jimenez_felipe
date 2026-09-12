<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

/**
 * Rutas de login & logout:
 */

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

Route::resource('usuarios', UserController::class)->middleware('auth');
