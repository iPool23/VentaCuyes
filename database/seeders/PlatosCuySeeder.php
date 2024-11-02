<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Proveedor;
use App\Models\PlatoCuy;

class PlatosCuySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proveedor = Proveedor::first();

        PlatoCuy::create([
            'proveedor_id' => $proveedor->id,
            'nombre_plato' => 'Cuy Chactado Especial',
            'tipo_preparacion' => 'Cuy Chactado',
            'descripcion' => 'Cuy chactado tradicional cajamarquino con hierbas aromáticas',
            'precio_plato' => 45.00,
            'tiempo_preparacion' => 45,
            'disponible' => true,
            'ingredientes' => 'Cuy, ajo, comino, pimienta, hierbas aromáticas',
            'imagen_plato' => 'cuy_chactado.jpg'
        ]);
    }
}
