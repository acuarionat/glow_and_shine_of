<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resena;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class catalogoController extends Controller
{
    public function mostrarCatalogoMaquillaje()
    {
        $productos = DB::table('producto')
            ->join('sub_parametros as sp_color', 'producto.color', '=', 'sp_color.id_sub_parametros')
            ->join('sub_parametros as sp_categoria', 'producto.categoria', '=', 'sp_categoria.id_sub_parametros')
            ->where('sp_categoria.id_sub_parametros', 1)
            ->select(
                'producto.id_producto',
                'producto.nombre as nombre_producto',
                'producto.precio',
                'producto.url_imagen',
                'sp_color.descripcion as color',
                'sp_categoria.descripcion as categoria'
            )
            ->get();

        return view('Maquillaje', ['productos' => $productos]);
    }

    public function mostrarCatalogoJoyeria()
    {
        $productos = DB::table('producto')
            ->join('sub_parametros as sp_color', 'producto.color', '=', 'sp_color.id_sub_parametros')
            ->join('sub_parametros as sp_categoria', 'producto.categoria', '=', 'sp_categoria.id_sub_parametros')
            ->where('sp_categoria.id_sub_parametros', 2)
            ->select(
                'producto.id_producto',
                'producto.nombre as nombre_producto',
                'producto.precio',
                'producto.url_imagen',
                'sp_color.descripcion as color',
                'sp_categoria.descripcion as categoria'
            )
            ->get();

        return view('Joyeria', ['productos' => $productos]);
    }

    public function mostrarCatalogoSkinCare()
    {
        $productos = DB::table('producto')
            ->join('sub_parametros as sp_categoria', 'producto.categoria', '=', 'sp_categoria.id_sub_parametros')
            ->where('sp_categoria.id_sub_parametros', 5)
            ->select(
                'producto.id_producto',
                'producto.nombre as nombre_producto',
                'producto.precio',
                'producto.url_imagen',
                'sp_categoria.descripcion as categoria'
            )
            ->get();

        return view('SkinCare', ['productos' => $productos]);
    }

    public function mostrarCatalogoCuidadoCapilar()
    {
        $productos = DB::table('producto')
            ->join('sub_parametros as sp_categoria', 'producto.categoria', '=', 'sp_categoria.id_sub_parametros')
            ->where('sp_categoria.id_sub_parametros', 3)
            ->select(
                'producto.id_producto',
                'producto.nombre as nombre_producto',
                'producto.precio',
                'producto.url_imagen',
                'sp_categoria.descripcion as categoria'
            )
            ->get();

        return view('CuidadoCapilar', ['productos' => $productos]);
    }

    public function mostrarCatalogoFragancia()
    {
        $productos = DB::table('producto')
            ->join('sub_parametros as sp_categoria', 'producto.categoria', '=', 'sp_categoria.id_sub_parametros')
            ->where('sp_categoria.id_sub_parametros', 4)
            ->select(
                'producto.id_producto',
                'producto.nombre as nombre_producto',
                'producto.precio',
                'producto.url_imagen',
                'sp_categoria.descripcion as categoria'
            )
            ->get();

        return view('Fragancia', ['productos' => $productos]);
    }

    public function mostrarDetalleProducto($id)
    {
        $producto = DB::table('producto AS p')
            ->leftJoin('sub_parametros AS sp', function ($join) {
                $join->on('p.color', '=', 'sp.id_sub_parametros')
                     ->where('sp.id_parametros', '=', 3);
            })
            ->where('p.id_producto', $id)
            ->select(
                'p.id_producto',
                'p.nombre AS nombre_producto',
                'p.descripcion',
                'p.precio',
                'sp.descripcion AS color',
                'p.url_imagen AS imagen_producto'
            )
            ->first();

        $resenas = Resena::where('id_producto', $id)->orderBy('fecha_resena', 'desc')->take(7)->get();

        return view('producto', [
            'producto' => $producto,
            'resenas' => $resenas
        ]);
    }

    public function mostrarFavoritos()
    {
        $favoritos = DB::table('favoritos')
            ->join('producto', 'favoritos.id_producto', '=', 'producto.id_producto')
            ->where('favoritos.id_usuario', Auth::id())
            ->select(
                'producto.id_producto',
                'producto.nombre as nombre_producto',
                'producto.precio',
                'producto.url_imagen'
            )
            ->get();

        return view('Favoritos', ['favoritos' => $favoritos]);
    }
}
