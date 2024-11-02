<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Empleado;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Empleado 1 - Cocinero
        $usuario1 = Usuario::create([
            'nombres' => 'María Elena',
            'apellidos' => 'Torres Pérez',
            'usuario' => 'mtorres',
            'email' => 'mtorres@gmail.com',
            'password' => bcrypt('password123')
        ])->assignRole('empleado');

        Empleado::create([
            'usuario_id' => $usuario1->id,
            'dni' => '45678912',
            'telefono' => '912345678',
            'direccion' => 'Jr. Los Pinos 789, Cajamarca',
            'fecha_contratacion' => '2023-01-15',
            'salario' => 2500.00,
            'imagen_perfil' => 'cocinero1.jpg'
        ]);

        // Empleado 2 - Mesero
        $usuario2 = Usuario::create([
            'nombres' => 'Pedro José',
            'apellidos' => 'Ruiz Silva',
            'usuario' => 'pruiz',
            'email' => 'pruiz@gmail.com',
            'password' => bcrypt('password123')
        ])->assignRole('empleado');

        Empleado::create([
            'usuario_id' => $usuario2->id,
            'dni' => '78912345',
            'telefono' => '923456789',
            'direccion' => 'Av. San Martín 456, Cajamarca',
            'fecha_contratacion' => '2023-03-20',
            'salario' => 1800.00,
            'imagen_perfil' => 'mesero1.jpg'
        ]);

        // Empleado 3 - Cajero
        $usuario3 = Usuario::create([
            'nombres' => 'Ana Lucía',
            'apellidos' => 'Vásquez Castro',
            'usuario' => 'avasquez',
            'email' => 'avasquez@gmail.com',
            'password' => bcrypt('password123')
        ])->assignRole('empleado');

        Empleado::create([
            'usuario_id' => $usuario3->id,
            'dni' => '56789123',
            'telefono' => '934567890',
            'direccion' => 'Jr. Comercio 234, Cajamarca',
            'fecha_contratacion' => '2023-02-01',
            'salario' => 2000.00,
            'imagen_perfil' => 'cajero1.jpg'
        ]);
    }
}
