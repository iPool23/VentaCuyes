<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;

Route::get('login', [AuthController::class, 'mostrarLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:usuario'])->group(function () {
    Route::get('dashboard', [AuthController::class, 'mostrarDashboard'])->name('dashboard');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('usuario', UsuarioController::class);
});