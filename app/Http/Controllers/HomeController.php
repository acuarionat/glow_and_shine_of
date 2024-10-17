<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function principal()
    {
        // Obtener los productos más vendidos de la tabla 'inventario_venta' y 'producto'
        $productosMasVendidos = DB::table('inventario_venta')
            ->join('producto', 'inventario_venta.id_producto', '=', 'producto.id_producto')
            ->join('imagen_producto', 'producto.id_imagen_producto', '=', 'imagen_producto.id_imagen_producto')
            ->select('producto.nombre', 'producto.precio', 'producto.marca', DB::raw('SUM(inventario_venta.cantidad) as total_vendido'))
            ->groupBy('producto.id_producto', 'producto.nombre', 'producto.precio', 'producto.marca')
            ->orderBy('total_vendido', 'DESC')
            ->take(10) // Obtener los 10 productos más vendidos
            ->get();

        // Retornar la vista principal (home) con los productos más vendidos
        return view('home', compact('productosMasVendidos'));
        //return view('home');
    }
}
