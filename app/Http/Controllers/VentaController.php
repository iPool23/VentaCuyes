<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Obtiene el texto de búsqueda y lo limpia
        $texto = trim($request->get('texto'));
    
        // Consulta para obtener las ventas filtradas por el texto de búsqueda
        $ventas = Venta::with('cliente')
            ->whereHas('cliente', function($query) use ($texto) {
                $query->where('nombre', 'LIKE', '%'.$texto.'%')
                      ->orWhere('email', 'LIKE', '%'.$texto.'%');
            })
            ->orWhere('fecha', 'LIKE', '%'.$texto.'%')
            ->orWhere('total', 'LIKE', '%'.$texto.'%')
            ->orderBy('id', 'desc')
            ->paginate(10); 
    
        // Retorna la vista con los registros y el texto de búsqueda
        return view('venta.index', compact('ventas', 'texto'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
