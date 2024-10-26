<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function masVendidos()
    {
        // Retornar la vista principal (home) con los productos más vendidos
        $productosMasVendidos = DB::table('inventario_venta as iv')
            ->join('producto as p', 'iv.id_producto', '=', 'p.id_producto')
            ->join('precio_mercado as pm', 'p.id_precio_mercado', '=', 'pm.id_precio_mercado') // Asegúrate de que esta tabla también existe.
            ->join('imagen_producto as ip', 'p.id_imagen_producto', '=', 'ip.id_imagen_producto')
            ->select('p.id_producto', 'p.nombre', 'ip.direccion_imagen', 'pm.precio', DB::raw('SUM(iv.cantidad) as total_vendido')) // Cambia 'ip.ruta_imagen' según el nombre del campo que almacena la imagen
            ->groupBy('p.id_producto', 'p.nombre', 'ip.direccion_imagen', 'pm.precio') // Asegúrate de agrupar correctamente
            ->orderByDesc('total_vendido')
            ->take(7) // Cambiamos limit(5) por take(5) para que sea compatible con Laravel.
            ->get();

        $recienLlegados = DB::table('inventario_compra as ic')
            ->join('producto as p', 'ic.id_producto', '=', 'p.id_producto')
            ->join('imagen_producto as ip', 'p.id_imagen_producto', '=', 'ip.id_imagen_producto')
            ->join('precio_mercado as pm', 'p.id_precio_mercado', '=', 'pm.id_precio_mercado')
            ->select('p.id_producto', 'p.nombre', 'ip.direccion_imagen', 'pm.precio', 'ic.fecha_compra') // Seleccionamos la fecha de compra y los demás datos
            ->orderByDesc('ic.fecha_compra') // Ordenamos por la fecha más reciente
            ->take(7) // Limitar a los últimos 7 ingresos
            ->get();

        return view('home', compact('productosMasVendidos', 'recienLlegados'));
        //return view('home');
    }

    /* public function mostrarRecienLlegados()
    {
        $recienLlegados = DB::table('inventario_compra as ic')
            ->join('producto as p', 'ic.id_producto', '=', 'p.id_producto')
            ->join('imagen_producto as ip', 'p.id_imagen_producto', '=', 'ip.id_imagen_producto')
            ->join('precio_mercado as pm', 'p.id_precio_mercado', '=', 'pm.id_precio_mercado')
            ->select('p.id_producto', 'p.nombre', 'ip.direccion_imagen', 'pm.precio', 'ic.fecha_compra') // Seleccionamos la fecha de compra y los demás datos
            ->orderByDesc('ic.fecha_compra') // Ordenamos por la fecha más reciente
            ->take(7) // Limitar a los últimos 7 ingresos
            ->get();

        return view('home', compact('recienLlegados'));
    } */
}
