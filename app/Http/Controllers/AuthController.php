<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function mostrarLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('usuario.login');
    }

    public function mostrarDashboard()
    {
        $usuario = Auth::guard('usuario')->user();
        return view('usuario.dashboard', compact('usuario'));
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
            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['email' => 'Las credenciales son incorrectas.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
