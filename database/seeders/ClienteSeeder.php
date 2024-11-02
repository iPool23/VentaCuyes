<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Cliente;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usuario1 = Usuario::create([
            'nombres' => 'Juan Carlos',
            'apellidos' => 'Mendoza López',
            'usuario' => 'jmendoza',
            'email' => 'jmendoza@gmail.com',
            'password' => bcrypt('password123')
        ]);

        Cliente::create([
            'usuario_id' => $usuario1->id,
            'dni' => '75849632',
            'telefono' => '987654321',
            'direccion' => 'Av. Los Incas 123, Cajamarca'
        ]);
    }
}
