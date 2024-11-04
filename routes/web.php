<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\PlatoCuyController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('index');
});

// Rutas de autenticación
Route::get('login', [AuthController::class, 'mostrarLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);

// Grupo de rutas protegidas por autenticación
Route::middleware(['auth:usuario'])->group(function () {
    Route::get('dashboard', [AuthController::class, 'mostrarDashboard'])->name('dashboard');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('usuario', UsuarioController::class);
    Route::resource('empleado', EmpleadoController::class);
    Route::resource('cliente', ClienteController::class);
    Route::resource('proveedor', ProveedorController::class);
    Route::resource('plato-cuy', PlatoCuyController::class);

    Route::post('plato-cuy/{platoCuy}/toggle-disponible', [PlatoCuyController::class, 'toggleDisponible'])
        ->name('plato-cuy.toggle-disponible');

    Route::resource('venta', VentaController::class);
    Route::put('venta/{venta}/toggle-disponible', [VentaController::class, 'toggleDisponible'])
        ->name('venta.toggle-disponible');

    Route::get('/perfil', [PerfilController::class, 'show'])->name('perfil.show');
    Route::put('/perfil', [PerfilController::class, 'update'])->name('perfil.update');

    Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
});
