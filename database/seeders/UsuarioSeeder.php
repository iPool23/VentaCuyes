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
        $dueño->assignRole('admin');
        $dueño->save();

        $dueño2 = new Usuario();
        $dueño2->nombres = 'Collins Pool';
        $dueño2->apellidos = 'Vieira Abad';
        $dueño2->usuario = 'vabadcollinspoo';
        $dueño2->email = 'vabadcollinspoo@gmail.com';
        $dueño2->password = 'vabadcollinspoo';
        $dueño2->assignRole('admin');
        $dueño2->save();

        $empleado = new Usuario();
        $empleado->nombres = 'Victor Anthony';
        $empleado->apellidos = 'Pantaleon Villegas';
        $empleado->usuario = 'victor23';
        $empleado->email = 'victor23@gmail.com';
        $empleado->password = '12345678';
        $empleado->assignRole('admin');
        $empleado->save();

        $proveedor = new Usuario();
        $proveedor->nombres = 'Irvin Yair';
        $proveedor->apellidos = 'Acuña Mendoza';
        $proveedor->usuario = 'irvin23';
        $proveedor->email = 'irvin23@gmail.com';
        $proveedor->password = '12345678';
        $proveedor->assignRole('admin');
        $proveedor->save();
    }
}