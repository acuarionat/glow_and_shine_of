<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use App\Models\Producto;
use App\Models\InventarioVenta; // Modelo relacionado con la tabla inventario_venta
use App\Models\Usuario;

use Carbon\Carbon;



class ManagmentSaleController extends Controller
{

    public function ManagmentSale($id)
    {
        $user = Usuario::with('rol')->find($id);

        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }
    
        $saludo = match ($user->rol->nombre_rol) {
            'empleado' => 'Perfil de Empleado',
            'admin' => 'Perfil del Administrador',
            default => 'Perfil de Usuario'
        };


        return view('DashboardAdminSale', compact('user', 'saludo'));
    }

    public function buscarPersona($ci)
    {
        $ciPersona = DB::table('persona')
            ->where('ci_persona', $ci)
            ->first();
    

        if ($ciPersona) {
         
            return response()->json($ciPersona);
        } else {
        
            return response()->json(['error' => 'Persona no encontrada'], 404);
        }
    }

    public function buscarCliente($ci)
    {
        $idCliente = DB::table('cliente')
            ->join('persona', 'cliente.id_persona', '=', 'persona.id_persona')
            ->where('persona.ci_persona', $ci)
            ->value('cliente.id_cliente');
    
        if ($idCliente) {
            return response()->json(['id_cliente' => $idCliente]);
        } else {
            return response()->json(['error' => 'Cliente no encontrado.'], 404);
        }
    }
    
    
    public function buscarProducto($nombre = null)
    {
        $productos = DB::table('producto')
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
                'producto.cantidad as cantidad',
                'producto.nombre  as estado',
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
    
        try {
            DB::beginTransaction(); // Inicia una transacción para garantizar la atomicidad.
    
            foreach ($request->input('productos', []) as $producto) {
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
    
                $productoDB = DB::table('producto')
                    ->where('nombre', $producto['nombre'])
                    ->first();
    
                if (!$productoDB) {
                    return response()->json([
                        'error' => "No se encontró el producto en la base de datos: {$producto['nombre']}."
                    ], 404);
                }
    
                // Verifica que haya suficiente cantidad en inventario
                if ($productoDB->cantidad < $producto['cantidad']) {
                    return response()->json([
                        'error' => "Cantidad insuficiente para el producto: {$producto['nombre']}."
                    ], 400);
                }
    
                // Inserta el registro en inventario_venta
                DB::table('inventario_venta')->insert([
                    'id_proceso_venta' => $id_proceso_venta,
                    'tipo_evento' => $tipo_evento,
                    'id_producto' => $productoDB->id_producto,
                    'cantidad' => $producto['cantidad'],
                    'id_usuario_accion' => $id_usuario_accion,
                    'fecha_venta' => DB::raw('GETDATE()'),
                ]);
    
                $nuevaCantidad = $productoDB->cantidad - $producto['cantidad'];
                $nuevoEstado = $nuevaCantidad < 3 ? 30 : 29; 
    
          
                DB::table('producto')
                    ->where('id_producto', $productoDB->id_producto)
                    ->update([
                        'cantidad' => $nuevaCantidad,
                        'estado' => $nuevoEstado,
                    ]);
            }
    
            DB::commit(); 
    
            return redirect()->back()->with('success', 'La venta fue registrada exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Hubo un problema al registrar la venta: ' . $e->getMessage());
        }
    }
    
    
}
