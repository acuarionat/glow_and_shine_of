<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ManagmentBuyController extends Controller
{

    public function ManagmentBuy($id)
    {
        $user = DB::table('usuarios')->where('id', $id)->first();


        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }
        $saludo = 'Perfil del Administrador';


        return view('DashboardAdminBuy', compact('user', 'saludo'));
    }

    public function obtenerProveedores()
    {
        $proveedores = DB::table('proveedores')
            ->join('sub_parametros', 'proveedores.tipo_proveedor', '=', 'sub_parametros.id_sub_parametros')
            ->select('proveedores.id_proveedor', 'proveedores.empresa_proveedor', 'sub_parametros.descripcion as tipo_proveedor')
            ->get();

        return response()->json($proveedores);
    }

    public function buscarProducto($nombre = null)
    {
        $productos = DB::table('producto')
            /*             ->leftJoin('imagen_producto', 'producto.id_imagen_producto', '=', 'imagen_producto.id_imagen_producto') */
            ->leftJoin('sub_parametros as marca', 'producto.marca', '=', 'marca.id_sub_parametros')
            ->leftJoin('sub_parametros as categoria', 'producto.categoria', '=', 'categoria.id_sub_parametros')
            ->leftJoin('sub_parametros as color', 'producto.color', '=', 'color.id_sub_parametros')
            ->leftJoin('sub_parametros as estado', 'producto.estado', '=', 'estado.id_sub_parametros')
            ->leftJoin('lote', 'producto.id_lote', '=', 'lote.id_lote')
            ->select(
                'producto.nombre as nombre_producto',
                'categoria.descripcion as categoria',
                'marca.descripcion as marca',
                'producto.detalle_medida as medida_valor',
                'lote.codigo_lote as lote',
                'producto.url_imagen as imagen',
                'color.descripcion as color',
                'producto.precio as precio_venta',
                'producto.cantidad  as cantidad',
                'estado.descripcion as estado',
                /* 'imagen_producto.direccion_imagen as imagen' */
            );
        // Filtrar productos si se proporciona un nombre
        if (!empty($nombre)) {
            $productos->where('producto.nombre', 'like', "%$nombre%");
        }

        return response()->json($productos->get());
    }

    public function registrarProcesoCompra(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'id_empleado' => 'required|integer|exists:empleados,id_empleado',
            'id_proveedor' => 'required|integer|exists:proveedores,id_proveedor',
        ]);

        // Insertar el registro en proceso_venta
        DB::table('proceso_compra')->insert([
            'id_empleado' => $request->id_empleado,
            'id_proveedor' => $request->id_proveedor,
        ]);

        return response()->json(['success' => 'Proceso de compra registrado exitosamente.']);
    }

    public function registrarCompra(Request $request, $id)
    {
        $user = DB::table('usuarios')->where('id', $id)->first();
        $id_proceso_compra = DB::table('proceso_compra')->max('id_proceso_compra');
        $tipo_evento = 55; // Tipo de evento para compras
        $id_usuario_accion = $user->id;
    
        try {
            DB::beginTransaction(); // Inicia una transacción
    
            foreach ($request->input('productos', []) as $producto) {
                // Verificar que los datos necesarios están presentes
                if (!isset($producto['nombre'], $producto['cantidad'], $producto['precio'])) {
                    return response()->json([
                        'error' => 'Faltan datos requeridos en uno o más productos.'
                    ], 400);
                }
    
                if ($producto['cantidad'] <= 0 || $producto['precio'] < 0) {
                    return response()->json([
                        'error' => "La cantidad o el precio no son válidos para el producto: {$producto['nombre']}."
                    ], 400);
                }
    
                // Buscar el producto en la base de datos
                $productoDB = DB::table('producto')
                    ->where('nombre', $producto['nombre'])
                    ->first();
    
                if (!$productoDB) {
                    return response()->json([
                        'error' => "No se encontró el producto en la base de datos: {$producto['nombre']}."
                    ], 404);
                }
    
                // Insertar los datos en la tabla inventario_compra
                DB::table('inventario_compra')->insert([
                    'id_proceso_compra' => $id_proceso_compra,
                    'tipo_evento' => $tipo_evento,
                    'id_producto' => $productoDB->id_producto,
                    'cantidad' => $producto['cantidad'],
                    'costo_unitario' => $producto['precio'],
                    'id_usuario' => $id_usuario_accion,
                    'fecha_compra' => DB::raw('GETDATE()'),
                ]);
    
                // Calcular la nueva cantidad y el estado
                $nuevaCantidad = $productoDB->cantidad + $producto['cantidad'];
                $nuevoEstado = $nuevaCantidad < 3 ? 30 : 29; // 30 = agotado, 29 = disponible
    
                // Actualizar la tabla producto con la nueva cantidad y estado
                DB::table('producto')
                    ->where('id_producto', $productoDB->id_producto)
                    ->update([
                        'cantidad' => $nuevaCantidad,
                        'estado' => $nuevoEstado,
                    ]);
            }
    
            DB::commit(); // Confirma la transacción
    
            return redirect()->back()->with('success', 'La compra fue registrada exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack(); // Revierte los cambios en caso de error
            return redirect()->back()->with('error', 'Hubo un problema al registrar la compra: ' . $e->getMessage());
        }
    }
    
}
