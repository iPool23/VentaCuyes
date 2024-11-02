<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Proveedor;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usuario1 = Usuario::create([
            'nombres' => 'Luis Alberto',
            'apellidos' => 'García Ramírez',
            'usuario' => 'lgarcia',
            'email' => 'lgarcia@gmail.com',
            'password' => bcrypt('password123')
        ])->assignRole('proveedor');

        Proveedor::create([
            'usuario_id' => $usuario1->id,
            'ruc' => '20512345678',
            'razon_social' => 'Crianza de Cuyes Los Andes SAC',
            'telefono' => '956784321',
            'direccion' => 'Jr. Amazonas 456, Cajamarca'
        ]);
    }
}
