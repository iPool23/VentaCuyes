<?php

namespace App\Http\Controllers;

use App\Models\PlatoCuy;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PlatoCuyController extends Controller
{
    public function index(Request $request)
    {
        $texto = trim($request->get('texto'));
        $platos = PlatoCuy::with('proveedor')
            ->where('nombre_plato', 'LIKE', '%'.$texto.'%')
            ->orWhere('tipo_preparacion', 'LIKE', '%'.$texto.'%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('plato-cuy.index', compact('platos', 'texto'));
    }

    public function create()
    {
        $platoCuy = new PlatoCuy();
        $proveedores = Proveedor::all();
        return view('plato-cuy.action', compact('platoCuy', 'proveedores'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'nombre_plato' => 'required|string|max:255',
            'tipo_preparacion' => 'required|in:' . implode(',', PlatoCuy::tiposPreparacion()),
            'descripcion' => 'required|string',
            'precio_plato' => 'required|numeric|min:0',
            'tiempo_preparacion' => 'required|integer|min:1',
            'ingredientes' => 'nullable|string',
            'imagen_plato' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            DB::beginTransaction();
            
            $platoCuy = new PlatoCuy($validated);

            // Manejar la imagen
            if ($request->hasFile('imagen_plato')) {
                $prefijo = Str::random(2);
                $image = $request->file('imagen_plato');
                $nombreImagen = $prefijo.'-'.$image->getClientOriginalName();
                $image->move('platos', $nombreImagen);
                $platoCuy->imagen_plato = $nombreImagen;
            }

            $platoCuy->save();

            DB::commit();
            return redirect()->route('plato-cuy.index')
                ->with('mensaje', 'Plato creado correctamente');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('plato-cuy.index')
                ->with('error', 'Error al registrar plato: ' . $e->getMessage());
        }
    }

    public function edit(PlatoCuy $platoCuy)
    {
        $proveedores = Proveedor::all();
        return view('plato-cuy.action', compact('platoCuy', 'proveedores'));
    }

    public function update(Request $request, PlatoCuy $platoCuy)
    {
        $validated = $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'nombre_plato' => 'required|string|max:255',
            'tipo_preparacion' => 'required|in:' . implode(',', PlatoCuy::tiposPreparacion()),
            'descripcion' => 'required|string',
            'precio_plato' => 'required|numeric|min:0',
            'tiempo_preparacion' => 'required|integer|min:1',
            'ingredientes' => 'nullable|string',
            'imagen_plato' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            DB::beginTransaction();

            // Manejar la imagen
            if ($request->hasFile('imagen_plato')) {
                // Eliminar imagen antigua
                $imagenAntigua = 'platos/'.$platoCuy->imagen_plato;
                if (file_exists($imagenAntigua)) {
                    @unlink($imagenAntigua);
                }

                // Guardar nueva imagen
                $prefijo = Str::random(2);
                $image = $request->file('imagen_plato');
                $nombreImagen = $prefijo.'-'.$image->getClientOriginalName();
                $image->move('platos', $nombreImagen);
                $validated['imagen_plato'] = $nombreImagen;
            }

            $platoCuy->update($validated);

            DB::commit();
            return redirect()->route('plato-cuy.index')
                ->with('mensaje', 'Plato actualizado correctamente');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('plato-cuy.index')
                ->with('error', 'Error al actualizar plato');
        }
    }

    public function destroy(PlatoCuy $platoCuy)
    {
        try {
            // Eliminar imagen si existe
            $imagenAntigua = 'platos/'.$platoCuy->imagen_plato;
            if (file_exists($imagenAntigua)) {
                @unlink($imagenAntigua);
            }

            $platoCuy->delete();
            return redirect()->route('plato-cuy.index')
                ->with('mensaje', 'Plato eliminado correctamente');

        } catch (\Exception $e) {
            return redirect()->route('plato-cuy.index')
                ->with('error', 'Error al eliminar plato');
        }
    }

    public function toggleDisponible(PlatoCuy $platoCuy)
    {
        $platoCuy->disponible = !$platoCuy->disponible;
        $platoCuy->save();

        return response()->json([
            'message' => 'Estado actualizado correctamente',
            'disponible' => $platoCuy->disponible
        ]);
    }
}