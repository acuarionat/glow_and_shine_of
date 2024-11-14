<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class comprasController extends Controller
{
    public function mostrarCompras($id)
    {

        $user = DB::table('usuarios')->where('id', $id)->first();

        
        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }
        $saludo = 'Perfil del Administrador';
        // Ejecutamos la consulta usando Query Builder
        $compras = DB::table('inventario_compra as iv')
                ->select(
                    'iv.id_inventario_compra',
                    'p.nombre as producto',
                    'iv.cantidad',
                    'iv.costo_unitario as precio', // Usando el campo correcto de costo unitario
                    'u.name as usuario',
                    'iv.fecha_compra'
                )
                ->join('producto as p', 'iv.id_producto', '=', 'p.id_producto')
                ->join('usuarios as u', 'iv.id_usuario', '=', 'u.id') // Asumiendo que es el campo 'id_usuario'
                ->get();

        // Pasar los datos a la vista
        return view('mostrarCompras', compact('user','saludo','compras'));
    }
}
