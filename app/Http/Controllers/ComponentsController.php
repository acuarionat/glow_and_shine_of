<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ComponentsController extends Controller
{
    public function CardMostSold()
    {
        $productosMasVendidos = DB::table('inventario_venta as iv')
            ->join('producto as p', 'iv.id_producto', '=', 'p.id_producto')
            ->select(
                'p.id_producto',
                'p.nombre',
                'p.url_imagen', 
                'p.precio', 
                DB::raw('SUM(iv.cantidad) as total_vendido')
            )
            ->groupBy('p.id_producto', 'p.nombre', 'p.url_imagen', 'p.precio') 
            ->orderByDesc('total_vendido')
            ->take(5) 
            ->get();

        return view('components.Aldahir.CardMostSold', compact('productosMasVendidos'));
    }

    public function CardNewArrivals()
    {
 
        $recienLlegados = DB::table('inventario_compra as ic')
            ->join('producto as p', 'ic.id_producto', '=', 'p.id_producto')
            ->select(
                'p.id_producto',
                'p.nombre',
                'p.url_imagen', 
                'p.precio', 
                'ic.fecha_compra' 
            )
            ->orderByDesc('ic.fecha_compra') 
            ->take(7) 
            ->get();

        return view('components.Aldahir.CardNewArrivals', compact('recienLlegados'));
    }
}
