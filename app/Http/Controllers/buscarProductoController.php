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
            'precio_mercado.precio as precio_mercado',
            DB::raw("COALESCE(sp_color.descripcion, 'Sin color') as color"),
            'imagen_producto.direccion_imagen as direccion_imagen',
            'sp_estado.descripcion as estado',
            'sp_marca.descripcion as marca',
            'sp_categoria.descripcion as categoria'
        );

    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->where('producto.nombre', 'LIKE', "%{$search}%")
                ->orWhere('precio_mercado.precio', 'LIKE', "%{$search}%")
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
        ->join('imagen_producto AS ip', 'p.id_imagen_producto', '=', 'ip.id_imagen_producto')
        ->join('precio_mercado AS pm', 'p.id_precio_mercado', '=', 'pm.id_precio_mercado')
        ->leftJoin('sub_parametros AS sp', function($join) {
            $join->on('p.color', '=', 'sp.id_sub_parametros')
                 ->where('sp.id_parametros', '=', 3);
        })
        ->where('p.id_producto', $id)
        ->select(
            'p.id_producto',
            'p.nombre AS nombre_producto',
            'p.descripcion',
            'pm.precio AS precio_mercado',
            'sp.descripcion AS color',
            'ip.direccion_imagen AS imagen_producto'
        )
        ->first();

    return view('productoDetalle', ['producto' => $producto]);
}

}
