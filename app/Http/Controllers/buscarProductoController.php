<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;

class buscarProductoController extends Controller
{
    public function buscarProducto(Request $request)
{
    $query = DB::table('producto')
        ->leftjoin('precio_mercado', 'producto.id_precio_mercado', '=', 'precio_mercado.id_precio_mercado')
        ->join('imagen_producto', 'producto.id_imagen_producto', '=', 'imagen_producto.id_imagen_producto')
        ->leftJoin('sub_parametros as sp_color', 'producto.color', '=', 'sp_color.id_sub_parametros')
        ->join('sub_parametros as sp_estado', 'producto.estado', '=', 'sp_estado.id_sub_parametros')
        ->join('sub_parametros as sp_marca', 'producto.marca', '=', 'sp_marca.id_sub_parametros')
        ->join('sub_parametros as sp_categoria', 'producto.categoria', '=', 'sp_categoria.id_sub_parametros')
        ->select(
            'producto.id_producto',
            'producto.nombre as nombre_producto',
            'producto.cantidad as cantidad',
            'precio_mercado.precio as precio_mercado',
            DB::raw("COALESCE(precio_mercado.precio, 1) as precio"),
            DB::raw("COALESCE(sp_color.descripcion, 'Sin color') as color"),
            'imagen_producto.direccion_imagen as direccion_imagen',
            'sp_estado.descripcion as estado',
            'sp_marca.descripcion as marca',
            'sp_categoria.descripcion as categoria',
            'producto.precio',  // Reemplazar 'p.precio' por 'producto.precio'
            'producto.detalle_medida'  // Reemplazar 'p.detalle_medida' por 'producto.detalle_medida'
        );

    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->where('producto.nombre', 'LIKE', "%{$search}%")
                ->orWhere('producto.precio', 'LIKE', "%{$search}%")
                ->orWhere('sp_color.descripcion', 'LIKE', "%{$search}%")
                ->orWhere('sp_estado.descripcion', 'LIKE', "%{$search}%")
                ->orWhere('sp_marca.descripcion', 'LIKE', "%{$search}%")
                ->orWhere('sp_categoria.descripcion', 'LIKE', "%{$search}%");
        });
    }

    $productos = $query->get();

    return view('buscarProducto', ['productos' => $productos]);
}

    public function mostrarDetalleProductoAdmin($id) {
        $producto = DB::table('producto AS p')
            ->leftJoin('imagen_producto AS ip', 'p.id_imagen_producto', '=', 'ip.id_imagen_producto')
            ->leftJoin('sub_parametros AS sp_color', function($join) {
                $join->on('p.color', '=', 'sp_color.id_sub_parametros')
                     ->where('sp_color.id_parametros', '=', 3);
            })
            ->leftJoin('sub_parametros AS sp_estado', function($join) {
                $join->on('p.estado', '=', 'sp_estado.id_sub_parametros')
                     ->where('sp_estado.id_parametros', '=', 4);
            })
            ->leftJoin('sub_parametros AS sp_marca', function($join) {
                $join->on('p.marca', '=', 'sp_marca.id_sub_parametros')
                     ->where('sp_marca.id_parametros', '=', 5);
            })
            ->leftJoin('sub_parametros AS sp_presentacion', function($join) {
                $join->on('p.presentacion', '=', 'sp_presentacion.id_sub_parametros')
                     ->where('sp_presentacion.id_parametros', '=', 6);
            })
            ->leftJoin('sub_parametros AS sp_categoria', function($join) {
                $join->on('p.categoria', '=', 'sp_categoria.id_sub_parametros')
                     ->where('sp_categoria.id_parametros', '=', 7);
            })
            ->where('p.id_producto', $id)
            ->select(
                'p.id_producto',
                'p.nombre AS nombre_producto',
                'p.cantidad AS cantidad',
                'p.descripcion',
                'p.recomendaciones_uso AS recomendacion',
                DB::raw("COALESCE(sp_color.descripcion, 'Sin color') AS color"),
                'ip.direccion_imagen AS imagen_producto',
                'sp_estado.descripcion AS estado',
                'sp_marca.descripcion AS marca',
                'sp_presentacion.descripcion AS presentacion',
                'sp_categoria.descripcion AS categoria',
                'p.cantidad',
                'p.precio',
                'p.detalle_medida'

            )
            ->first();
    
        if (!$producto) {
            return redirect()->back()->with('error', 'Producto no encontrado.');
        }
    
        return view('productoDetalle', ['producto' => $producto]);
    }
    
}
