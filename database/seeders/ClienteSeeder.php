<?php

namespace Database\Seeders;

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
        $usuarios = [
            [
                'nombres' => 'Juan Carlos',
                'apellidos' => 'Mendoza López',
                'usuario' => 'jmendoza',
                'email' => 'jmendoza@gmail.com',
                'password' => 'password123',
                'dni' => '75849632',
                'telefono' => '987654321',
                'direccion' => 'Av. Los Incas 123, Cajamarca'
            ],
            [
                'nombres' => 'María Elena',
                'apellidos' => 'Sánchez Díaz',
                'usuario' => 'msanchez',
                'email' => 'msanchez@gmail.com',
                'password' => 'password123',
                'dni' => '74563219',
                'telefono' => '987654322',
                'direccion' => 'Jr. Cruz de Piedra 456, Cajamarca'
            ],
            [
                'nombres' => 'Pedro José',
                'apellidos' => 'García Ruiz',
                'usuario' => 'pgarcia',
                'email' => 'pgarcia@gmail.com',
                'password' => 'password123',
                'dni' => '73216549',
                'telefono' => '987654323',
                'direccion' => 'Av. Atahualpa 789, Cajamarca'
            ]
        ];

        foreach ($usuarios as $userData) {
            $usuario = Usuario::create([
                'nombres' => $userData['nombres'],
                'apellidos' => $userData['apellidos'],
                'usuario' => $userData['usuario'],
                'email' => $userData['email'],
                'password' => $userData['password']
            ])->assignRole('cliente'); // Add role assignment here

            Cliente::create([
                'usuario_id' => $usuario->id,
                'dni' => $userData['dni'],
                'telefono' => $userData['telefono'],
                'direccion' => $userData['direccion']
            ]);
        }
    }
}
