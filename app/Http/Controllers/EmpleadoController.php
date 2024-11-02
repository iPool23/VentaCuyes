<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class EmpleadoController extends Controller
{
    public function index(Request $request)
    {
        $texto = trim($request->get('texto'));
        $registros = Empleado::with('usuario')
            ->whereHas('usuario', function ($query) use ($texto) {
                $query->where('nombres', 'LIKE', '%' . $texto . '%')
                    ->orWhere('apellidos', 'LIKE', '%' . $texto . '%');
            })
            ->orWhere('dni', 'LIKE', '%' . $texto . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('empleado.index', compact('registros', 'texto'));
    }

    public function create()
    {
        $empleado = new Empleado();
        return view('empleado.action', compact('empleado'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|min:8',
            'usuario' => 'required|string|unique:usuarios,usuario',

            'dni' => 'required|string|size:8|unique:empleados,dni',
            'telefono' => 'required|string|size:9',
            'direccion' => 'required|string|max:255',
            'fecha_contratacion' => 'required|date',
            'salario' => 'required|numeric|min:0',
            'imagen_perfil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            DB::beginTransaction();

            $usuario = Usuario::create([
                'nombres' => $validated['nombres'],
                'apellidos' => $validated['apellidos'],
                'usuario' => $validated['usuario'],
                'email' => $validated['email'],
                'password' => $validated['password']
            ]);

            $usuario->assignRole('empleado');

            $imagen_perfil = null;
            if ($request->hasFile('imagen_perfil')) {
                $prefijo = Str::random(2);
                $image = $request->file('imagen_perfil');
                $nombreImagen = $prefijo . '-' . $image->getClientOriginalName();
                $image->move('empleados', $nombreImagen);
                $imagen_perfil = $nombreImagen;
            }

            Empleado::create([
                'usuario_id' => $usuario->id,
                'dni' => $validated['dni'],
                'telefono' => $validated['telefono'],
                'direccion' => $validated['direccion'],
                'fecha_contratacion' => $validated['fecha_contratacion'],
                'salario' => $validated['salario'],
                'imagen_perfil' => $imagen_perfil
            ]);

            DB::commit();
            return response()->json([
                'success' => true, 
                'message' => 'Empleado registrado correctamente'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false, 
                'message' => 'Error al registrar empleado',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit(Empleado $empleado)
    {
        $empleado->load('usuario');
        return view('empleado.action', compact('empleado'));
    }

    public function update(Request $request, Empleado $empleado)
    {
        $validated = $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'required|string|max:9',
            'direccion' => 'required|string|max:255',
            'fecha_contratacion' => 'required|date',
            'salario' => 'required|numeric',
            'imagen_perfil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            DB::beginTransaction();

            // Update usuario data
            $empleado->usuario->update([
                'nombres' => $validated['nombres'],
                'apellidos' => $validated['apellidos']
            ]);

            // Update empleado data
            $empleado->update([
                'telefono' => $validated['telefono'],
                'direccion' => $validated['direccion'],
                'fecha_contratacion' => $validated['fecha_contratacion'],
                'salario' => $validated['salario']
            ]);

            // Handle image
            if ($request->hasFile('imagen_perfil')) {
                if ($empleado->imagen_perfil) {
                    $imagenAntigua = 'empleados/' . $empleado->imagen_perfil;
                    if (file_exists($imagenAntigua)) {
                        @unlink($imagenAntigua);
                    }
                }

                $prefijo = Str::random(2);
                $image = $request->file('imagen_perfil');
                $nombreImagen = $prefijo . '-' . $image->getClientOriginalName();
                $image->move('empleados', $nombreImagen);
                $empleado->imagen_perfil = $nombreImagen;
                $empleado->save();
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Empleado actualizado correctamente'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar empleado',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Empleado $empleado)
    {
        try {
            DB::beginTransaction();

            // Delete profile image if exists
            if ($empleado->imagen_perfil) {
                $imagenAntigua = 'empleados/' . $empleado->imagen_perfil;
                if (file_exists($imagenAntigua)) {
                    @unlink($imagenAntigua);
                }
            }

            $nombreCompleto = $empleado->usuario->nombres . ' ' . $empleado->usuario->apellidos;
            $empleado->usuario->delete();

            DB::commit();
            return redirect()->route('empleado.index')
                ->with('mensaje', 'Empleado ' . $nombreCompleto . ' eliminado correctamente');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('empleado.index')
                ->with('error', 'Error al eliminar empleado');
        }
    }
}
