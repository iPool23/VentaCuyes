<?php

namespace App\Http\Controllers;

use App\Models\PlatoCuy;

class MenuController extends Controller
{
    public function index()
    {
        $platos = PlatoCuy::where('disponible', true)
            ->orderBy('nombre_plato')
            ->get();

        return view('menu.index', compact('platos'));
    }
}