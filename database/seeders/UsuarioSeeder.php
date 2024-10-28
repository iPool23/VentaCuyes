<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {

        $dueño = new Usuario();
        $dueño->nombres = 'Pool Anthony';
        $dueño->apellidos = 'Deza Millones';
        $dueño->usuario = 'pool23';
        $dueño->email = 'pool23@gmail.com';
        $dueño->password = '12345678';
        $dueño->rol = 'Admin';
        $dueño->save();
    }
}