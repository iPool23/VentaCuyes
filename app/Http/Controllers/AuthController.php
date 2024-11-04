<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Empleado;

class AuthController extends Controller
{
    public function mostrarLogin()
    {
        if (Auth::guard('usuario')->check()) {
            return redirect()->route('dashboard');
        }
        return view('usuario.login');
    }

    public function mostrarDashboard()
    {
        $usuario = Auth::guard('usuario')->user();
        $empleado = Empleado::where('usuario_id', $usuario->id)->first();
        return view('usuario.dashboard', compact('usuario', 'empleado'));
    }

    protected function redirectTo()
    {
        return '/login';
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('usuario')->attempt($credentials)) {
            $usuario = Auth::guard('usuario')->user();

            if ($usuario->roles->contains('name', 'cliente')) {
                return redirect()->route('menu.index');
            }

            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Las credenciales son incorrectas.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
