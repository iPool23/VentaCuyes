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

        $platos = [
            [
                'nombre_plato' => 'Cuy Chactado Especial',
                'tipo_preparacion' => 'Cuy Chactado',
                'descripcion' => 'Cuy chactado tradicional cajamarquino con hierbas aromáticas',
                'precio_plato' => 45.00,
                'tiempo_preparacion' => 45,
                'ingredientes' => 'Cuy, ajo, comino, pimienta, hierbas aromáticas',
                'imagen_plato' => 'cuy_chactado.jpg'
            ],
            [
                'nombre_plato' => 'Cuy al Horno Tradicional',
                'tipo_preparacion' => 'Cuy al Horno',
                'descripcion' => 'Cuy horneado con hierbas andinas y papas nativas',
                'precio_plato' => 42.00,
                'tiempo_preparacion' => 60,
                'ingredientes' => 'Cuy, romero, tomillo, papas nativas, ají panca',
                'imagen_plato' => 'cuy_horno.jpg'
            ],
            [
                'nombre_plato' => 'Pepián de Cuy',
                'tipo_preparacion' => 'Pepián de Cuy',
                'descripcion' => 'Guiso tradicional de cuy con maní y especias',
                'precio_plato' => 38.00,
                'tiempo_preparacion' => 40,
                'ingredientes' => 'Cuy, maní molido, arroz, papa amarilla, ají mirasol',
                'imagen_plato' => 'pepian_cuy.jpg'
            ],
            [
                'nombre_plato' => 'Cuy Frito Crocante',
                'tipo_preparacion' => 'Cuy Frito',
                'descripcion' => 'Cuy frito hasta dorarse, acompañado de papas doradas',
                'precio_plato' => 40.00,
                'tiempo_preparacion' => 35,
                'ingredientes' => 'Cuy, ajo, comino, papas, ají',
                'imagen_plato' => 'cuy_frito.jpg'
            ],
            [
                'nombre_plato' => 'Cuy al Palo',
                'tipo_preparacion' => 'Cuy al Palo',
                'descripcion' => 'Cuy asado a la leña con hiervas aromáticas',
                'precio_plato' => 48.00,
                'tiempo_preparacion' => 55,
                'ingredientes' => 'Cuy, chincho, huacatay, ají panca, cerveza negra',
                'imagen_plato' => 'cuy_palo.jpg'
            ]
        ];

        foreach ($platos as $plato) {
            PlatoCuy::create(array_merge(
                $plato,
                [
                    'proveedor_id' => $proveedor->id,
                    'disponible' => true
                ]
            ));
        }
    }
}
