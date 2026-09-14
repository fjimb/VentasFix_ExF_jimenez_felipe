<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route(Auth::check() ? 'dashboard' : 'login');
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

Route::resource('usuarios', UserController::class)
    ->middleware('auth');

Route::resource('productos', ProductoController::class)
    ->middleware('auth');

Route::resource('clientes', ClienteController::class)
    ->middleware('auth');
