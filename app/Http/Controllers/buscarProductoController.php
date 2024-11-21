<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
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
        $user = Usuario::with('rol')->find($user->id);
        $saludo = match ($user->rol->nombre_rol) {
            'empleado' => 'Perfil de Empleado',
            'admin' => 'Perfil del Administrador',
            default => 'Perfil de Usuario',
        };

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

        return view('buscarProducto', compact('user', 'productos','saludo'));
    }
    public function mostrarDetalleProductoAdmin($id_user, $id)
    {
        $user = DB::table('usuarios')->where('id', $id_user)->first();
    
        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }
        
        $user = Usuario::with('rol')->find($user->id);
        $saludo = match ($user->rol->nombre_rol) {
            'empleado' => 'Perfil de Empleado',
            'admin' => 'Perfil del Administrador',
            default => 'Perfil de Usuario',
        };

    
        $producto = DB::table('producto AS p')
            ->leftJoin('sub_parametros AS sp_color', function ($join) {
                $join->on('p.color', '=', 'sp_color.id_sub_parametros')
                    ->where('sp_color.id_parametros', '=', 3);
            })
            ->leftJoin('sub_parametros AS sp_estado', function ($join) {
                $join->on('p.estado', '=', 'sp_estado.id_sub_parametros')
                    ->where('sp_estado.id_parametros', '=', 4);
            })
            ->leftJoin('sub_parametros AS sp_marca', function ($join) {
                $join->on('p.marca', '=', 'sp_marca.id_sub_parametros')
                    ->where('sp_marca.id_parametros', '=', 5);
            })
            ->leftJoin('sub_parametros AS sp_presentacion', function ($join) {
                $join->on('p.presentacion', '=', 'sp_presentacion.id_sub_parametros')
                    ->where('sp_presentacion.id_parametros', '=', 6);
            })
            ->leftJoin('sub_parametros AS sp_categoria', function ($join) {
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
                'p.url_imagen AS imagen_producto', 
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
    
        return view('productoDetalle', compact('user', 'saludo', 'producto'));
    }
    
}
