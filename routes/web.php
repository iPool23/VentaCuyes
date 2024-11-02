<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\PlatoCuyController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::get('login', [AuthController::class, 'mostrarLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);


Route::middleware(['auth:usuario'])->group(function () {
    Route::get('dashboard', [AuthController::class, 'mostrarDashboard'])->name('dashboard');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('usuario', controller: UsuarioController::class);
    Route::resource('empleado', controller: EmpleadoController::class);
    Route::resource('cliente', controller: ClienteController::class);
    Route::resource('proveedor', controller: ProveedorController::class);
    Route::resource('plato-cuy', controller: PlatoCuyController::class);

    Route::post('plato-cuy/{platoCuy}/toggle-disponible', [PlatoCuyController::class, 'toggleDisponible'])
        ->name('plato-cuy.toggle-disponible');
    //rutas para ventas
    Route::resource('venta', VentaController::class);
});
