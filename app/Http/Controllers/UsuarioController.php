<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $texto = trim($request->get('texto'));
        $registros = Usuario::with('roles')
            ->where('nombres', 'LIKE', '%' . $texto . '%')
            ->orWhere('apellidos', 'LIKE', '%' . $texto . '%')
            ->orWhere('email', 'LIKE', '%' . $texto . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('usuario.index', compact('registros', 'texto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuario = new Usuario();
        $roles = Role::pluck('name', 'name');
        return view('usuario.action', compact('usuario', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'usuario' => 'required|string|max:255|unique:usuarios',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'password' => 'required|string|min:8',
            'rol' => 'required|string|exists:roles,name',
        ]);

        $usuario = Usuario::create($request->except('rol'));

        $usuario->assignRole($request->rol);

        return redirect()->route('usuario.index')
            ->with('mensaje', 'Usuario creado satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        return view('usuario.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        $roles = Role::pluck('name', 'name');
        return view('usuario.action', compact('usuario', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'usuario' => ['required', 'string', 'max:255', Rule::unique('usuarios')->ignore($usuario->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('usuarios')->ignore($usuario->id)],
            'password' => 'nullable|string|min:8',
            'rol' => 'required|string|exists:roles,name',
        ]);

        $usuario->update($request->except(['password', 'rol']));

        if ($request->filled('password')) {
            $usuario->password = bcrypt($request->password);
        }

        $usuario->syncRoles($request->rol);

        return redirect()->route('usuario.index')
            ->with('mensaje', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        try {
            $nombreCompleto = $usuario->nombres . ' ' . $usuario->apellidos;
            $usuario->delete();
            return redirect()->route('usuario.index')
                ->with('mensaje', 'Usuario ' . $nombreCompleto . ' eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('usuario.index')
                ->with('error', 'No se puede eliminar el usuario ' . $usuario->nombres . ' ' . $usuario->apellidos . ' porque está siendo usado en el sistema.');
        }
    }
}
