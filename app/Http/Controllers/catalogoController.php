<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class catalogoController extends Controller
{

    public function mostrarCatalogoMaquillaje()
    {
        $productos = DB::table('producto')
            ->join('precio_mercado', 'producto.id_precio_mercado', '=', 'precio_mercado.id_precio_mercado')
            ->join('imagen_producto', 'producto.id_imagen_producto', '=', 'imagen_producto.id_imagen_producto')
            ->join('sub_parametros as sp_color', 'producto.color', '=', 'sp_color.id_sub_parametros')
            ->join('sub_parametros as sp_categoria', 'producto.categoria', '=', 'sp_categoria.id_sub_parametros')
            ->where('sp_categoria.id_sub_parametros', 1)
            ->select(
                'producto.id_producto',
                'producto.nombre as nombre_producto',
                'precio_mercado.precio as precio_mercado',
                'sp_color.descripcion as color',
                'imagen_producto.direccion_imagen as direccion_imagen',
                'sp_categoria.descripcion as categoria'
            )
            ->get();

        return view('Maquillaje', ['productos' => $productos]);
    }

    public function mostrarCatalogoJoyeria()
    {
        $productos = DB::table('producto')
            ->join('precio_mercado', 'producto.id_precio_mercado', '=', 'precio_mercado.id_precio_mercado')
            ->join('imagen_producto', 'producto.id_imagen_producto', '=', 'imagen_producto.id_imagen_producto')
            ->join('sub_parametros as sp_color', 'producto.color', '=', 'sp_color.id_sub_parametros')
            ->join('sub_parametros as sp_categoria', 'producto.categoria', '=', 'sp_categoria.id_sub_parametros')
            ->where('sp_categoria.id_sub_parametros', 2)
            ->select(
                'producto.id_producto',
                'producto.nombre as nombre_producto',
                'precio_mercado.precio as precio_mercado',
                'sp_color.descripcion as color',
                'imagen_producto.direccion_imagen as direccion_imagen',
                'sp_categoria.descripcion as categoria'
            )
            ->get();

        return view('Joyeria', ['productos' => $productos]);
    }

    public function mostrarCatalogoSkinCare()
    {
        $productos = DB::table('producto')
            ->join('precio_mercado', 'producto.id_precio_mercado', '=', 'precio_mercado.id_precio_mercado')
            ->join('imagen_producto', 'producto.id_imagen_producto', '=', 'imagen_producto.id_imagen_producto')
            ->join('sub_parametros as sp_categoria', 'producto.categoria', '=', 'sp_categoria.id_sub_parametros')
            ->where('sp_categoria.id_sub_parametros', 5)
            ->select(
                'producto.id_producto',
                'producto.nombre as nombre_producto',
                'precio_mercado.precio as precio_mercado',
                'imagen_producto.direccion_imagen as direccion_imagen',
                'sp_categoria.descripcion as categoria'
            )
            ->get();

        return view('SkinCare', ['productos' => $productos]);
    }

    public function mostrarCatalogoCuidadoCapilar()
    {
        $productos = DB::table('producto')
            ->join('precio_mercado', 'producto.id_precio_mercado', '=', 'precio_mercado.id_precio_mercado')
            ->join('imagen_producto', 'producto.id_imagen_producto', '=', 'imagen_producto.id_imagen_producto')
            ->join('sub_parametros as sp_categoria', 'producto.categoria', '=', 'sp_categoria.id_sub_parametros')
            ->where('sp_categoria.id_sub_parametros', 3)
            ->select(
                'producto.id_producto',
                'producto.nombre as nombre_producto',
                'precio_mercado.precio as precio_mercado',
                'imagen_producto.direccion_imagen as direccion_imagen',
                'sp_categoria.descripcion as categoria'
            )
            ->get();

        return view('CuidadoCapilar', ['productos' => $productos]);
    }

    public function mostrarCatalogoFragancia()
    {
        $productos = DB::table('producto')
            ->join('precio_mercado', 'producto.id_precio_mercado', '=', 'precio_mercado.id_precio_mercado')
            ->join('imagen_producto', 'producto.id_imagen_producto', '=', 'imagen_producto.id_imagen_producto')
            ->join('sub_parametros as sp_categoria', 'producto.categoria', '=', 'sp_categoria.id_sub_parametros')
            ->where('sp_categoria.id_sub_parametros', 4)
            ->select(
                'producto.id_producto',
                'producto.nombre as nombre_producto',
                'precio_mercado.precio as precio_mercado',
                'imagen_producto.direccion_imagen as direccion_imagen',
                'sp_categoria.descripcion as categoria'
            )
            ->get();

        return view('Fragancia', ['productos' => $productos]);
    }


    public function mostrarDetalleProducto($id) {
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
    
        return view('producto', ['producto' => $producto]);
    }
    public function mostrarFavoritos()
{
    $favoritos = DB::table('favoritos')
    ->join('producto', 'favoritos.id_producto', '=', 'producto.id_producto')
    ->join('precio_mercado', 'producto.id_precio_mercado', '=', 'precio_mercado.id_precio_mercado')
    ->join('imagen_producto', 'producto.id_imagen_producto', '=', 'imagen_producto.id_imagen_producto')
    ->where('favoritos.id_usuario', Auth::id())
    ->select(
        'producto.id_producto',
        'producto.nombre as nombre_producto',
        'precio_mercado.precio as precio_mercado',
        'imagen_producto.direccion_imagen as direccion_imagen'
    )
    ->get();
    return view('Favoritos', ['favoritos' => $favoritos]);

}
}

