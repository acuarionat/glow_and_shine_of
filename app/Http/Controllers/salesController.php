<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class salesController extends Controller
{
    public function mostrarVentas($id)
    {

        $user = DB::table('usuarios')->where('id', $id)->first();

        
        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }
        $saludo = 'Perfil del Administrador';
        // Ejecutamos la consulta usando Query Builder
        $ventas = DB::table('inventario_venta as iv')
                    ->select('iv.id_inventario_venta', 'p.nombre as producto', 'iv.cantidad', 'pm.precio as precio', 'u.name as usuario', 'iv.fecha_venta')
                    ->join('producto as p', 'iv.id_producto', '=', 'p.id_producto')
                    ->join('precio_mercado as pm', 'iv.id_precio_mercado', '=', 'pm.id_precio_mercado')
                    ->join('usuarios as u', 'iv.id_usuario_accion', '=', 'u.id')
                    ->limit(1000)
                    ->get();

        // Pasar los datos a la vista
        return view('mostrarVentas', compact('user','saludo','ventas'));
    }
}
