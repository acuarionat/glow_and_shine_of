<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class comprasController extends Controller
{
    public function mostrarCompras($id)
    {

        $user = DB::table('usuarios')->where('id', $id)->first();

        
        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }
        $user = Usuario::with('rol')->find($user->id);
        $saludo = match ($user->rol->nombre_rol) {
            'empleado' => 'Perfil de Empleado',
            'admin' => 'Perfil del Administrador'
        };
        $compras = DB::table('inventario_compra as iv')
                ->select(
                    'iv.id_inventario_compra',
                    'p.nombre as producto',
                    'iv.cantidad',
                    'iv.costo_unitario as precio', 
                    'u.name as usuario',
                    'iv.fecha_compra'
                )
                ->join('producto as p', 'iv.id_producto', '=', 'p.id_producto')
                ->join('usuarios as u', 'iv.id_usuario', '=', 'u.id')
                ->get();

        // Pasar los datos a la vista
        return view('mostrarCompras', compact('user','saludo','compras'));
    }


    public function ManagmentBuy($id)
    {
        $user = DB::table('usuarios')->where('id', $id)->first();


        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }
        $saludo = 'Perfil del Administrador';


        return view('DashboardAdminBuy', compact('user', 'saludo'));
    }

    public function buscarPersona($ci)
    {
        $persona = DB::table('proveedores')
                    ->where('empresa_proveedor', $ci)
                    ->first();

        if ($persona) {
            return response()->json($persona);
        } else {
            return response()->json(['error' => 'Empresa no encontrada'], 404);
        }
    }

    public function mostrarProducto()
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
                'precio_mercado.precio as precio_mercado',
                DB::raw("COALESCE(sp_color.descripcion, 'Sin color') as color"),
                'imagen_producto.direccion_imagen as direccion_imagen',
                'sp_estado.descripcion as estado',
                'sp_marca.descripcion as marca',
                'sp_categoria.descripcion as categoria'
            )
            ->get();

        // Retornar los productos en formato JSON
        return response()->json($productos);
    }

}
