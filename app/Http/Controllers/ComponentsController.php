<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ComponentsController extends Controller
{
    public function CardMostSold()
    {
        // Consultar los productos más vendidos
        $productosMasVendidos = DB::table('inventario_venta as iv')
            ->join('producto as p', 'iv.id_producto', '=', 'p.id_producto')
            ->select(
                'p.id_producto',
                'p.nombre',
                'p.url_imagen', 
                'p.precio', 
                DB::raw('SUM(iv.cantidad) as total_vendido')
            )
            ->groupBy('p.id_producto', 'p.nombre', 'p.url_imagen', 'p.precio') // Agrupar por los campos relevantes
            ->orderByDesc('total_vendido')
            ->take(5) // Limitar a los 5 más vendidos
            ->get();

        return view('components.Aldahir.CardMostSold', compact('productosMasVendidos'));
    }

    public function CardNewArrivals()
    {
        // Consultar los productos recién llegados
        $recienLlegados = DB::table('inventario_compra as ic')
            ->join('producto as p', 'ic.id_producto', '=', 'p.id_producto')
            ->select(
                'p.id_producto',
                'p.nombre',
                'p.url_imagen', 
                'p.precio', 
                'ic.fecha_compra' // Incluir la fecha de compra
            )
            ->orderByDesc('ic.fecha_compra') // Ordenar por la fecha más reciente
            ->take(7) // Limitar a los últimos 7 ingresos
            ->get();

        return view('components.Aldahir.CardNewArrivals', compact('recienLlegados'));
    }
}
