<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use App\Models\Producto;
use App\Models\InventarioVenta; // Modelo relacionado con la tabla inventario_venta

use Carbon\Carbon;



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

    public function buscarCliente($ci)
    {
        $cliente = DB::table('cliente')
            ->join('persona', 'cliente.id_persona', '=', 'persona.id_persona')
            ->where('persona.ci_persona', $ci)
            ->select('cliente.id_cliente')
            ->first();

        if ($cliente) {
            return response()->json($cliente);
        } else {
            return response()->json(['error' => 'Cliente no encontrado.'], 404);
        }
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
                'estado.descripcion as estado',
                /* 'imagen_producto.direccion_imagen as imagen' */
            );
        // Filtrar productos si se proporciona un nombre
        if (!empty($nombre)) {
            $productos->where('producto.nombre', 'like', "%$nombre%");
        }

        return response()->json($productos->get());
    }

    public function registrarProcesoVenta(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'id_empleado' => 'required|integer|exists:empleados,id_empleado',
            'id_cliente' => 'required|integer|exists:cliente,id_cliente',
        ]);

        // Insertar el registro en proceso_venta
        DB::table('proceso_venta')->insert([
            'id_empleado' => $request->id_empleado,
            'id_cliente' => $request->id_cliente,
        ]);

        return response()->json(['success' => 'Proceso de venta registrado exitosamente.']);
    }

    public function registrarVenta(Request $request, $id)
    {
        $user = DB::table('usuarios')->where('id', $id)->first();
        $id_proceso_venta = DB::table('proceso_venta')->max('id_proceso_venta');
        $tipo_evento = 54;
        $id_usuario_accion = $user->id;
        $fecha_venta = Carbon::now();

        try {
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

                // Buscar el id_producto y id_precio_mercado en la base de datos
                $productoDB = DB::table('producto')
                    ->where('nombre', $producto['nombre'])
                    ->first();

                if (!$productoDB) {
                    return response()->json([
                        'error' => "No se encontró el producto en la base de datos: {$producto['nombre']}."
                    ], 404);
                }


                // Insertar los datos en la tabla inventario_venta
                DB::table('inventario_venta')->insert([

                    'id_proceso_venta' => $id_proceso_venta,
                    'tipo_evento' => $tipo_evento,
                    'id_producto' => $productoDB->id_producto,
                    'cantidad' => $producto['cantidad'],
                    'id_usuario_accion' => $id_usuario_accion,
                    'fecha_venta' => $fecha_venta,
                ]);
            }

            return redirect()->back()->with('success', 'La venta fue registrada exitosamente.');
        } catch (\Exception $e) {
            // Manejo de errores
            return redirect()->back()->with('error', 'Hubo un problema al registrar la venta: ' . $e->getMessage());
        }
    }
}
