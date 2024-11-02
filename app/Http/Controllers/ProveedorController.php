<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProveedorController extends Controller
{
    public function index(Request $request)
    {
        $texto = trim($request->get('texto'));
        $registros = Proveedor::with('usuario')
            ->whereHas('usuario', function($query) use ($texto) {
                $query->where('nombres', 'LIKE', '%'.$texto.'%')
                    ->orWhere('apellidos', 'LIKE', '%'.$texto.'%');
            })
            ->orWhere('ruc', 'LIKE', '%'.$texto.'%')
            ->orWhere('razon_social', 'LIKE', '%'.$texto.'%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('proveedor.index', compact('registros', 'texto'));
    }

    public function create()
    {
        $proveedor = new Proveedor();
        return view('proveedor.action', compact('proveedor'));
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
            
            // Proveedor data
            'ruc' => 'required|string|size:11|unique:proveedores,ruc',
            'razon_social' => 'required|string|max:255',
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
            $usuario->assignRole('proveedor');

            // Create Proveedor
            Proveedor::create([
                'usuario_id' => $usuario->id,
                'ruc' => $validated['ruc'],
                'razon_social' => $validated['razon_social'],
                'telefono' => $validated['telefono'],
                'direccion' => $validated['direccion']
            ]);

            DB::commit();
            return response()->json(['message' => 'Proveedor registrado correctamente']);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Error al registrar proveedor',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit(Proveedor $proveedor)
    {
        $proveedor->load('usuario');
        return view('proveedor.action', compact('proveedor'));
    }

    public function update(Request $request, Proveedor $proveedor)
    {
        $validated = $request->validate([
            // Usuario data
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'usuario' => ['required', 'string', Rule::unique('usuarios')->ignore($proveedor->usuario_id)],
            
            // Proveedor data
            'ruc' => ['required', 'string', 'size:11', Rule::unique('proveedores')->ignore($proveedor->id)],
            'razon_social' => 'required|string|max:255',
            'telefono' => 'required|string|size:9',
            'direccion' => 'required|string|max:255'
        ]);

        try {
            DB::beginTransaction();

            // Update Usuario
            $proveedor->usuario->update([
                'nombres' => $validated['nombres'],
                'apellidos' => $validated['apellidos'],
                'usuario' => $validated['usuario']
            ]);

            // Update Proveedor
            $proveedor->update([
                'ruc' => $validated['ruc'],
                'razon_social' => $validated['razon_social'],
                'telefono' => $validated['telefono'],
                'direccion' => $validated['direccion']
            ]);

            DB::commit();
            return response()->json(['message' => 'Proveedor actualizado correctamente']);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Error al actualizar proveedor',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Proveedor $proveedor)
    {
        try {
            DB::beginTransaction();
            
            $nombreCompleto = $proveedor->usuario->nombres . ' ' . $proveedor->usuario->apellidos;
            
            // Delete Usuario (will cascade delete Proveedor)
            $proveedor->usuario->delete();
            
            DB::commit();
            return redirect()->route('proveedor.index')
                ->with('mensaje', 'Proveedor ' . $nombreCompleto . ' eliminado correctamente');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('proveedor.index')
                ->with('error', 'Error al eliminar proveedor');
        }
    }
}