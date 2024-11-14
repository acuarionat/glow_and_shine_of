<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class productoEmpleadoController extends Controller
{

    public function mostrarTodosProductos()
{
    $productos = DB::table('producto')
        ->join('precio_mercado', 'producto.id_precio_mercado', '=', 'precio_mercado.id_precio_mercado')
        ->join('imagen_producto', 'producto.id_imagen_producto', '=', 'imagen_producto.id_imagen_producto')
        ->leftJoin('sub_parametros as sp_color', 'producto.color', '=', 'sp_color.id_sub_parametros')
        ->join('sub_parametros as sp_estado', 'producto.estado', '=', 'sp_estado.id_sub_parametros')
        ->join('sub_parametros as sp_marca', 'producto.marca', '=', 'sp_marca.id_sub_parametros')
        ->join('sub_parametros as sp_categoria', 'producto.categoria', '=', 'sp_categoria.id_sub_parametros')
        ->select(
            'producto.id_producto',
            'producto.nombre as nombre_producto',
            'producto.cantidad as cantidad',
            'producto.precio as precio',
            'producto.detalle_medida as detalle_medida',
            'precio_mercado.precio as precio_mercado',
            DB::raw("COALESCE(sp_color.descripcion, 'Sin color') as color"),
            'imagen_producto.direccion_imagen as direccion_imagen',
            'sp_estado.descripcion as estado',
            'sp_marca.descripcion as marca',
            'sp_categoria.descripcion as categoria'
        )
        ->get();


        return view('productoEmpleado', ['productos' => $productos]);
    }
}