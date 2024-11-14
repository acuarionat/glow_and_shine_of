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
    public function create()
    {
        $subparametrosCategorias = Subparametro::where('id_parametros', 1)->get();
        $subparametrosMarca = Subparametro::where('id_parametros', 2)->get();
        $subparametrosColor = Subparametro::where('id_parametros', 3)->get();
        $subparametrosPresentacion = Subparametro::where('id_parametros', 4)->get();
        $subparametrosEstado = Subparametro::where('id_parametros', 5)->get();
        $proveedores = Proveedores::all();
        $lote = Lote::all();
        return view('registrarProducto', compact('subparametrosCategorias', 'subparametrosMarca', 'subparametrosColor', 'subparametrosPresentacion', 'subparametrosEstado', 'proveedores', 'lote'));
    }

    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'nombre' => 'required|string|max:100',
            'direccion_imagen' => 'required|string',
            'descripcion_imagen' => 'nullable|string',
        ]);

        $idProductoImagen = DB::table('producto')->max('id_producto') + 1;

        // Crear una imagen asociada con el ID generado manualmente (que es el mismo id_producto)
        $imagen = ImagenProducto::create([
            'id_imagen_producto' => $idProductoImagen,  // Asegúrate que id_imagen_producto sea bigint
            'direccion_imagen' => $request->direccion_imagen,
            'descripcion_imagen' => $request->descripcion_imagen,
        ]);

        // Crear el producto en la tabla 'producto'
        Producto::create([
            'id_producto' => $idProductoImagen,  // Usando el mismo id generado
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'recomendaciones_uso' => $request->recomendaciones_uso,
            'marca' => $request->marca,
            'categoria' => $request->categoria,
            'color' => $request->color,
            'presentacion' => $request->presentacion,
            'estado' => $request->estado,
            'id_lote' => $request->id_lote,
            'id_imagen_producto' => $idProductoImagen,  // Asegúrate de usar el mismo id
            'id_proveedor' => $request->id_proveedor,
            'cantidad' => $request->cantidad,
            'precio' => $request->precio,
            'detalle_medida' => $request->detalle_medida
        ]);

        // Redirigir a la lista de productos con un mensaje de éxito
        return redirect()->route('producto.create')->with('success', 'Producto creado correctamente');
    }

    public function edit($id)
{
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
        'producto',
        'imagenProducto',  // Pasamos la imagen asociada
        'subparametrosCategorias',
        'subparametrosMarca',
        'subparametrosColor',
        'subparametrosPresentacion',
        'subparametrosEstado',
        'proveedores',
        'lote'
    ));
}

    public function update(Request $request, $id)

    {
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
        if ($request->has('direccion_imagen') && $request->has('descripcion_imagen')) {
            // Crear o actualizar la entrada en imagen_producto
            $imagen = ImagenProducto::updateOrCreate(
                ['direccion_imagen' => $request->direccion_imagen],  // Condiciones para encontrar la imagen
                ['descripcion_imagen' => $request->descripcion_imagen] // Valores para actualizar o crear
            );

            // Asigna el ID de la imagen al producto
            $producto->id_imagen_producto = $imagen->id_imagen_producto;
        }


        // Luego, actualiza los demás campos del producto
        $producto->update([
            'direccion_imagen' => $request->direccion_imagen,
            'descripcion_imagen' => $request->descripcion_imagen,
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
            'detalle_medida' => $request->detalle_medida
        ]);

        // Redirigir al listado de productos con un mensaje de éxito
        return redirect()->route('producto.update', ['id' => $producto->id_producto])->with('success', 'Producto actualizado correctamente');
    }
}
