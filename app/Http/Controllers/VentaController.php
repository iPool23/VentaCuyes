<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\DetalleVenta;
use App\Models\Venta;
use App\Models\PlatoCuy;
use App\Models\Usuario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Obtiene el texto de búsqueda y lo limpia
        $texto = trim($request->get('texto'));

        // Consulta para obtener las ventas filtradas por el texto de búsqueda y estado
        $ventas = Venta::with(['cliente'])
            ->where('estado', '1') // Filtra por estado 1
            ->where(function ($query) use ($texto) {
                // Filtra por el texto de búsqueda en el DNI, fecha o total
                $query->whereHas('cliente', function ($q) use ($texto) {
                    $q->where('dni', 'LIKE', '%' . $texto . '%');
                })
                    ->orWhere('fecha', 'LIKE', '%' . $texto . '%')
                    ->orWhere('total', 'LIKE', '%' . $texto . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10); // Paginación de resultados

        // Retorna la vista con los registros y el texto de búsqueda
        return view('venta.index', compact('ventas', 'texto'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ventas = new Venta();
        $clientes = Cliente::all();
        $usuarios = Usuario::all();
        $platos = PlatoCuy::all();
        return view('venta.catalogo', compact('ventas', 'platos', 'clientes', 'usuarios'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validar
            $request->validate([
                'cliente_id' => 'required|exists:clientes,id',
                'platos' => 'required|array',
                'platos.*.id' => 'required|exists:platos_cuy,id',
                'platos.*.cantidad' => 'required|integer|min:1',
            ]);


            // Filtrar platos válidos, manteniendo solo los que tienen una cantidad mayor a cero
            $platosVenta = collect($request->platos)->filter(function ($plato) {
                return !empty($plato['id']) && (int)$plato['cantidad'] > 0;
            });

            // Validar que al menos haya un plato válido
            if ($platosVenta->isEmpty()) {
                Log::error('No se han proporcionado platos válidos para la venta.', $request->all());
                return back()->with('error', 'Debe seleccionar al menos un plato con cantidad válida.');
            }

            // Calcular el total de la venta
            $total = 0;
            foreach ($platosVenta as $plato) {
                $platoInfo = PlatoCuy::findOrFail($plato['id']);
                $subtotal = $platoInfo->precio_plato * $plato['cantidad'];
                $total += $subtotal;
            }

            // Crear la venta
            $venta = Venta::create([
                'cliente_id' => $request->cliente_id,
                'fecha' => now(),
                'total' => $total
            ]);

            // Crear los detalles de la venta
            foreach ($platosVenta as $plato) {
                $platoInfo = PlatoCuy::findOrFail($plato['id']);
                DetalleVenta::create([
                    'venta_id' => $venta->id,
                    'plato_id' => $platoInfo->id,
                    'cantidad' => $plato['cantidad'],
                    'precio_unitario' => $platoInfo->precio_plato,
                    'subtotal' => $platoInfo->precio_plato * $plato['cantidad']
                ]);
            }

            DB::commit();
            Log::info('Venta registrada exitosamente', ['venta_id' => $venta->id]);

            return redirect()->route('venta.index')->with('success', 'Venta registrada exitosamente');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error al registrar la venta', [
                'mensaje' => $e->getMessage(),
                'request' => $request->all()
            ]);
            return back()->with('error', 'Error al registrar la venta: ' . $e->getMessage());
        }
    }





    /**
     * Display the specified resource.
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $clientes = Cliente::all();
        $usuarios = Usuario::all();
        $platos = PlatoCuy::all();
        $venta = Venta::findOrFail($id);
        return view('venta.action', compact('venta', 'clientes', 'usuarios', 'platos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venta $venta)
    {
        try {
            DB::beginTransaction();

            // Validar los datos
            $request->validate([
                'cliente_id' => 'required|exists:clientes,id',
                'platos' => 'required|array',
                'platos.*.id' => 'required|exists:platos_cuy,id',
                'platos.*.cantidad' => 'required|integer|min:1',
            ]);

            DB::transaction(function () use ($request) {
                $venta = Venta::findOrFail($request->venta_id);
                // Filtrar platos válidos
                $platosVenta = collect($request->platos)->filter(function ($plato) {
                    return !empty($plato['id']) && (int)$plato['cantidad'] > 0;
                });

                // Calcular el total de platos vendidos
                $total = $platosVenta->sum(function ($plato) {
                    $platoInfo = PlatoCuy::findOrFail($plato['id']);
                    return $platoInfo->precio_plato * $plato['cantidad'];
                });
                $venta->update([
                    'total' => $total,
                    'fecha' => $request->fecha,
                    'cliente_id' => $request->cliente_id
                ]);

                // Eliminar los detalles anteriores de la venta
                $venta->detalles()->delete();

                // Crear nuevos detalles de venta
                foreach ($request->platos as $plato) {
                    $platoInfo = PlatoCuy::findOrFail($plato['id']);
                    DetalleVenta::create([
                        'venta_id' => $venta->id,
                        'plato_id' => $plato['id'],
                        'cantidad' => $plato['cantidad'],
                        'precio_unitario' => $platoInfo->precio_plato,
                        'subtotal' => $plato['cantidad'] * $platoInfo->precio_plato
                    ]);
                }
            });


            DB::commit();
            session()->flash('mensaje', 'La venta se ha guardado correctamente.');
            return redirect()->route('venta.index');
        } catch (Exception $e) {
            DB::rollback();
            Log::error('Error al actualizar venta', ['error' => $e->getMessage()]);
            session()->flash('mensaje', 'Ocurrió un error al actualizar la venta');
            return redirect()->route('venta.index');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $venta)
    {
        //
    }
    public function toggleDisponible(Venta $venta)
    {
        $venta->estado = 0;
        $venta->save();

        session()->flash('mensaje', 'La venta se eliminó correctamente.');

        return redirect()->route('venta.index');
    }
}
