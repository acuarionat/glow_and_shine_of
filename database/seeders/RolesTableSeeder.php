<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            ['nombre_rol' => 'cliente', 'descripcion' => 'Rol para clientes'],
            ['nombre_rol' => 'empleado', 'descripcion' => 'Rol para empleados'],
            ['nombre_rol' => 'admin', 'descripcion' => 'Rol para administradores'],
        ]);
    }
}
