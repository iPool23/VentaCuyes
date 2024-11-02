<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Empleado;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        View::composer('*', function ($view) {
            if (Auth::guard('usuario')->check()) {
                $usuario = Auth::guard('usuario')->user();
                $empleado = Empleado::where('usuario_id', $usuario->id)->first();
                $view->with(compact('usuario', 'empleado'));
            }
        });
    }
}
