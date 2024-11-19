<?php

namespace App\Http\Controllers;

use App\Models\ImagenProducto;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Subparametro;
use App\Models\Proveedores;
use App\Models\Lote;

class registrarProductoController extends Controller
{
    public function create($id)
    {
        $user = DB::table('usuarios')->where('id', $id)->first();


        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }

        $saludo = 'Perfil del Administrador';
        $subparametrosCategorias = Subparametro::where('id_parametros', 1)->get();
        $subparametrosMarca = Subparametro::where('id_parametros', 2)->get();
        $subparametrosColor = Subparametro::where('id_parametros', 3)->get();
        $subparametrosPresentacion = Subparametro::where('id_parametros', 4)->get();
        $subparametrosEstado = Subparametro::where('id_parametros', 5)->get();
        $proveedores = Proveedores::all();
        $lote = Lote::all();
        return view('registrarProducto', compact('user', 'saludo', 'subparametrosCategorias', 'subparametrosMarca', 'subparametrosColor', 'subparametrosPresentacion', 'subparametrosEstado', 'proveedores', 'lote'));
    }

   public function store(Request $request, $id)
{
    $user = DB::table('usuarios')->where('id', $id)->first();

    if (!$user) {
        return redirect('/users')->with('error', 'Usuario no encontrado');
    }

    $request->validate([
        'nombre' => 'required|string|max:100',
        'direccion_imagen' => 'required|string',
        'descripcion_imagen' => 'nullable|string',
    ]);
    $nextIdI = DB::table('imagen_producto')->max('id_imagen_producto') + 1;
    // Evita duplicar imágenes
    $imagen = ImagenProducto::firstOrCreate(
        ['id_imagen_producto' => $nextIdI],
        ['direccion_imagen' => $request->direccion_imagen],
        ['descripcion_imagen' => $request->descripcion_imagen]
    );

    // Crear el producto asociado
    $nextId = DB::table('producto')->max('id_producto') + 1;

    Producto::create([
        'id_producto' => $nextId,
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'recomendaciones_uso' => $request->recomendaciones_uso,
        'marca' => $request->marca,
        'categoria' => $request->categoria,
        'color' => $request->color,
        'presentacion' => $request->presentacion,
        'estado' => $request->estado,
        'id_lote' => $request->id_lote,
        'id_imagen_producto' => $imagen->id_imagen_producto,
        'id_proveedor' => $request->id_proveedor,
        'cantidad' => $request->cantidad,
        'precio' => $request->precio,
        'detalle_medida' => $request->detalle_medida,
    ]);

    return redirect()->route('producto.create', ['id' => $id])
        ->with('success', 'Producto creado correctamente');
}

    public function edit($id_user, $id)
    {
        $user = DB::table('usuarios')->where('id', $id_user)->first();


        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }

        $saludo = 'Perfil del Administrador';

        $producto = Producto::findOrFail($id);

        // Obtener los datos de la imagen asociada al producto
        $imagenProducto = ImagenProducto::find($producto->id_imagen_producto);

        // Obtener los subparametros y otros datos necesarios
        $subparametrosCategorias = Subparametro::where('id_parametros', 1)->get();
        $subparametrosMarca = Subparametro::where('id_parametros', 2)->get();
        $subparametrosColor = Subparametro::where('id_parametros', 3)->get();
        $subparametrosPresentacion = Subparametro::where('id_parametros', 4)->get();
        $subparametrosEstado = Subparametro::where('id_parametros', 5)->get();
        $proveedores = Proveedores::all();
        $lote = Lote::all();

        // Pasar la imagen a la vista
        return view('editarProducto', compact(
            'user',
            'saludo',
            'producto',
            'imagenProducto', 
            'subparametrosCategorias',
            'subparametrosMarca',
            'subparametrosColor',
            'subparametrosPresentacion',
            'subparametrosEstado',
            'proveedores',
            'lote'
        ));
        
    }

    public function update(Request $request, $id_user, $id)
    {
        $user = DB::table('usuarios')->where('id', $id_user)->first();
    
        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }
    
        $saludo = 'Perfil del Administrador';
    
        // Validar los datos
        $request->validate([
            'nombre' => 'required|string|max:100',
            'direccion_imagen' => 'required|string',
            'descripcion_imagen' => 'nullable|string',
            'descripcion' => 'nullable|string',
            // Agregar validaciones para otros campos según sea necesario
        ]);
    
        // Encontrar el producto existente
        $producto = Producto::findOrFail($id);
    
        // Verificar si la URL de la imagen ha cambiado
        if ($request->has('direccion_imagen') && $request->direccion_imagen !== $producto->imagenProducto->direccion_imagen) {
            // Verificar si la imagen ya existe en la tabla `imagen_producto`
            $imagen = ImagenProducto::where('direccion_imagen', $request->direccion_imagen)->first();
    
            if (!$imagen) {
                $nextIdI = DB::table('imagen_producto')->max('id_imagen_producto') + 1;
                $imagen = ImagenProducto::firstOrCreate(
                    ['id_imagen_producto' => $nextIdI],
                    ['direccion_imagen' => $request->direccion_imagen],
                    ['descripcion_imagen' => $request->descripcion_imagen]
                );
            } else {
                $imagen->update([
                    'descripcion_imagen' => $request->descripcion_imagen,
                ]);
            }
    
            // Asignar el nuevo ID de la imagen al producto
            $producto->id_imagen_producto = $imagen->id_imagen_producto;
        } elseif ($request->has('descripcion_imagen')) {
            // Si la URL no cambia pero hay una nueva descripción, actualizarla
            $producto->imagenProducto->update([
                'descripcion_imagen' => $request->descripcion_imagen,
            ]);
        }
    
        // Actualizar los campos del producto
        $producto->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'id_precio_mercado' => $request->id_precio_mercado,
            'recomendaciones_uso' => $request->recomendaciones_uso,
            'marca' => $request->marca,
            'categoria' => $request->categoria,
            'color' => $request->color,
            'presentacion' => $request->presentacion,
            'estado' => $request->estado,
            'id_lote' => $request->id_lote,
            'id_detalle_medida' => $request->id_detalle_medida,
            'id_proveedor' => $request->id_proveedor,
            'cantidad' => $request->cantidad,
            'precio' => $request->precio,
            'detalle_medida' => $request->detalle_medida,
        ]);
    
        // Redirigir al listado de productos con un mensaje de éxito
        return redirect()->route('producto.update', ['id' => $producto->id_producto, 'id_user' => $id_user])
            ->with('success', 'Producto actualizado correctamente');
    }
    
    
}
