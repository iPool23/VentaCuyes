<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'admin', 'guard_name' => 'usuario']);
        Role::create(['name' => 'empleado', 'guard_name' => 'usuario']);
        Role::create(['name' => 'cliente', 'guard_name' => 'usuario']);
        Role::create(['name' => 'proveedor', 'guard_name' => 'usuario']);
    }
}
