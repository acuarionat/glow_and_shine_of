<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Usuario;


class ManagmentSaleController extends Controller
{
    public function ManagmentSale($id)
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
            ->leftJoin('sub_parametros as marca', 'producto.marca', '=', 'marca.id_sub_parametros')
            ->leftJoin('sub_parametros as categoria', 'producto.categoria', '=', 'categoria.id_sub_parametros')
            ->leftJoin('sub_parametros as color', 'producto.color', '=', 'color.id_sub_parametros')
            ->leftJoin('sub_parametros as estado', 'producto.estado', '=', 'estado.id_sub_parametros')
            ->select(
                'producto.id_producto',
                'producto.nombre as nombre_producto',
                'categoria.descripcion as categoria',
                'marca.descripcion as marca',
                'color.descripcion as color',
                'producto.precio as precio_venta',
                'estado.descripcion as estado',
                'producto.url_imagen as imagen'
            )
            ->where('producto.nombre', 'like', "%$nombre%")
            ->get();

        return response()->json($productos);
    }

    public function registrarVenta(Request $request, $id)
    {
        $user = DB::table('usuarios')->where('id', $id)->first();

        $id_proceso_venta = 5; // Dato fijo
        $tipo_evento = 70;     // Dato fijo
        $id_usuario_accion =  $user; // ID del usuario autenticado
        $fecha_venta = Carbon::now();

        try {
            foreach ($request->input('productos', []) as $producto) {
                if (!isset($producto['id_producto'], $producto['cantidad'], $producto['precio'])) {
                    return response()->json(['error' => 'Datos incompletos para uno o más productos'], 400);
                }

                if ($producto['cantidad'] <= 0 || $producto['precio'] < 0) {
                    return response()->json(['error' => "Cantidad o precio inválidos para el producto {$producto['id_producto']}"], 400);
                }

                DB::table('inventario_venta')->insert([
                    'id_proceso_venta' => $id_proceso_venta,
                    'tipo_evento' => $tipo_evento,
                    'id_producto' => $producto['id_producto'],
                    'cantidad' => $producto['cantidad'],
                    'id_usuario_accion' => $id_usuario_accion,
                    'fecha_venta' => $fecha_venta,
                ]);
            }

            return response()->json(['success' => 'Venta registrada correctamente']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al registrar la venta: ' . $e->getMessage()], 500);
        }
    }
}
