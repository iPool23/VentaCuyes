<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $texto = trim($request->get('texto'));
        $registros = Cliente::with('usuario')
            ->whereHas('usuario', function($query) use ($texto) {
                $query->where('nombres', 'LIKE', '%'.$texto.'%')
                    ->orWhere('apellidos', 'LIKE', '%'.$texto.'%');
            })
            ->orWhere('dni', 'LIKE', '%'.$texto.'%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('cliente.index', compact('registros', 'texto'));
    }

    public function create()
    {
        $cliente = new Cliente();
        return view('cliente.action', compact('cliente'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Usuario data
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|min:8',
            'usuario' => 'required|string|unique:usuarios,usuario',
            
            // Cliente data
            'dni' => 'required|string|size:8|unique:clientes,dni',
            'telefono' => 'required|string|size:9',
            'direccion' => 'required|string|max:255'
        ]);

        try {
            DB::beginTransaction();

            // Create Usuario
            $usuario = Usuario::create([
                'nombres' => $validated['nombres'],
                'apellidos' => $validated['apellidos'],
                'usuario' => $validated['usuario'],
                'email' => $validated['email'],
                'password' => $validated['password']
            ]);
            
            // Assign role
            $usuario->assignRole('cliente');

            // Create Cliente
            Cliente::create([
                'usuario_id' => $usuario->id,
                'dni' => $validated['dni'],
                'telefono' => $validated['telefono'],
                'direccion' => $validated['direccion']
            ]);

            DB::commit();
            return response()->json(['message' => 'Cliente registrado correctamente']);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Error al registrar cliente',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit(Cliente $cliente)
    {
        $cliente->load('usuario');
        return view('cliente.action', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $validated = $request->validate([
            // Usuario data
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'usuario' => ['required', 'string', Rule::unique('usuarios')->ignore($cliente->usuario_id)],
            
            // Cliente data
            'dni' => ['required', 'string', 'size:8', Rule::unique('clientes')->ignore($cliente->id)],
            'telefono' => 'required|string|size:9',
            'direccion' => 'required|string|max:255'
        ]);

        try {
            DB::beginTransaction();

            // Update Usuario
            $cliente->usuario->update([
                'nombres' => $validated['nombres'],
                'apellidos' => $validated['apellidos'],
                'usuario' => $validated['usuario']
            ]);

            // Update Cliente
            $cliente->update([
                'dni' => $validated['dni'],
                'telefono' => $validated['telefono'],
                'direccion' => $validated['direccion']
            ]);

            DB::commit();
            return response()->json(['message' => 'Cliente actualizado correctamente']);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Error al actualizar cliente',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Cliente $cliente)
    {
        try {
            DB::beginTransaction();
            
            $nombreCompleto = $cliente->usuario->nombres . ' ' . $cliente->usuario->apellidos;
            
            // Delete Usuario (will cascade delete Cliente)
            $cliente->usuario->delete();
            
            DB::commit();
            return redirect()->route('cliente.index')
                ->with('mensaje', 'Cliente ' . $nombreCompleto . ' eliminado correctamente');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('cliente.index')
                ->with('error', 'Error al eliminar cliente');
        }
    }
}