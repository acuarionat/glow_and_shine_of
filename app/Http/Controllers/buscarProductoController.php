<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class buscarProductoController extends Controller
{
    public function buscarProducto(Request $request, $id)
    {
        $user = DB::table('usuarios')->where('id', $id)->first();

        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }

        $query = DB::table('producto')
            ->leftJoin('sub_parametros as sp_color', 'producto.color', '=', 'sp_color.id_sub_parametros')
            ->join('sub_parametros as sp_estado', 'producto.estado', '=', 'sp_estado.id_sub_parametros')
            ->join('sub_parametros as sp_marca', 'producto.marca', '=', 'sp_marca.id_sub_parametros')
            ->join('sub_parametros as sp_categoria', 'producto.categoria', '=', 'sp_categoria.id_sub_parametros')
            ->select(
                'producto.id_producto',
                'producto.nombre as nombre_producto',
                'producto.cantidad as cantidad',
                DB::raw("COALESCE(sp_color.descripcion, 'Sin color') as color"),
                'producto.url_imagen as imagen_producto',
                'sp_estado.descripcion as estado',
                'sp_marca.descripcion as marca',
                'sp_categoria.descripcion as categoria',
                'producto.precio',
                'producto.detalle_medida'
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

        return view('buscarProducto', compact('user', 'productos'));
    }
}
