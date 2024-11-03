<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisosTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('permisos')->insert([
            ['nombre_permiso' => 'crear', 'descripcion' => 'Permiso para crear'],
            ['nombre_permiso' => 'modificar', 'descripcion' => 'Permiso para modificar'],
            ['nombre_permiso' => 'leer', 'descripcion' => 'Permiso para leer'],
            ['nombre_permiso' => 'eliminar', 'descripcion' => 'Permiso para eliminar'],
        ]);
    }
}
