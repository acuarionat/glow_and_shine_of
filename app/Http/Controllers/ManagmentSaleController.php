<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;


class ManagmentSaleController extends Controller
{


    public function ManagmentSale($id)
    {
        $user = DB::table('usuarios')->where('id', $id)->first();


        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }
        $saludo = 'Perfil del Administrador';


        return view('DashboardAdminSale', compact('user', 'saludo'));
    }

    public function buscarPersona($ci)
    {
        $persona = DB::table('persona')
            ->where('ci_persona', $ci)
            ->first();

        if ($persona) {
            return response()->json($persona);
        } else {
            return response()->json(['error' => 'Persona no encontrada'], 404);
        }
    }

    public function buscarProducto($nombre)
    {
        $productos = DB::table('producto')
            ->leftJoin('precio_mercado', 'producto.id_precio_mercado', '=', 'precio_mercado.id_precio_mercado')
            ->leftJoin('lote', 'producto.id_lote', '=', 'lote.id_lote')
            ->leftJoin('detalle_medida', 'producto.id_detalle_medida', '=', 'detalle_medida.id_detalle_medida')
            ->leftJoin('imagen_producto', 'producto.id_imagen_producto', '=', 'imagen_producto.id_imagen_producto')
            ->leftJoin('sub_parametros as marca', 'producto.marca', '=', 'marca.id_sub_parametros')
            ->leftJoin('sub_parametros as categoria', 'producto.categoria', '=', 'categoria.id_sub_parametros')
            ->leftJoin('sub_parametros as color', 'producto.color', '=', 'color.id_sub_parametros')
            ->leftJoin('sub_parametros as estado', 'producto.estado', '=', 'estado.id_sub_parametros')
            ->select(
                'producto.nombre as nombre_producto',
                'categoria.descripcion as categoria',
                'marca.descripcion as marca',
                'color.descripcion as color',
                'lote.codigo_lote as lote',
                'detalle_medida.valor as medida_valor',
                'detalle_medida.unidad_medida as unidad_medida',
                'precio_mercado.precio as precio_venta',
                'estado.descripcion as estado',
                'imagen_producto.direccion_imagen as imagen'
            )
            ->where('producto.nombre', 'like', "%$nombre%")
            ->get();

        return response()->json($productos);
    }
}
