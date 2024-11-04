<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Usuario;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    public function show()
    {
        $usuario = Auth::user();
        $cliente = $usuario->cliente;
        $ventas = collect();

        if ($cliente) {
            $ventas = Venta::with(['detalles.plato'])
                ->where('cliente_id', $cliente->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('perfil.show', compact('usuario', 'cliente', 'ventas'));
    }

    public function update(Request $request)
    {
        $usuario = Auth::user();

        $validated = $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email,' . $usuario->id,
            'telefono' => 'required|string|size:9',
            'direccion' => 'required|string|max:255',
        ]);

        try {
            Usuario::where('id', $usuario->id)->update([
                'nombres' => $validated['nombres'],
                'apellidos' => $validated['apellidos'],
                'email' => $validated['email'],
            ]);

            if ($usuario->roles->contains('name', 'cliente')) {
                Cliente::where('usuario_id', $usuario->id)->update([
                    'telefono' => $validated['telefono'],
                    'direccion' => $validated['direccion'],
                ]);
            }

            return redirect()->back()->with('success', 'Perfil actualizado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar el perfil');
        }
    }
}
