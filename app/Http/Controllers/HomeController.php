<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function masVendidos()
    {
        // Consultar los productos más vendidos
        $productosMasVendidos = DB::table('inventario_venta as iv')
            ->join('producto as p', 'iv.id_producto', '=', 'p.id_producto')
            ->select(
                'p.id_producto',
                'p.nombre',
                'p.url_imagen', 
                'p.precio', 
                DB::raw('SUM(iv.cantidad) as total_vendido') // Total de productos vendidos
            )
            ->groupBy('p.id_producto', 'p.nombre', 'p.url_imagen', 'p.precio') // Agrupación correcta
            ->orderByDesc('total_vendido')
            ->take(7) // Limitar a los 7 más vendidos
            ->get();

        // Consultar los productos recién llegados
        $recienLlegados = DB::table('inventario_compra as ic')
            ->join('producto as p', 'ic.id_producto', '=', 'p.id_producto')
            ->select(
                'p.id_producto',
                'p.nombre',
                'p.url_imagen',
                'p.precio', 
                'ic.fecha_compra' // Fecha de compra
            )
            ->orderByDesc('ic.fecha_compra') // Ordenar por la fecha más reciente
            ->take(7) // Limitar a los últimos 7 ingresos
            ->get();

        // Retornar la vista con los datos
        return view('home', compact('productosMasVendidos', 'recienLlegados'));
    }
}
