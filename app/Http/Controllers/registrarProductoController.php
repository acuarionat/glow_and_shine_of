<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Subparametro;
use App\Models\Proveedores;
use App\Models\Lote;
use Illuminate\Support\Facades\Storage;

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
        $subparametrosPresentacion = Subparametro::where('id_parametros', operator: 4)->get();
        $subparametrosEstado = Subparametro::where('id_parametros', 5)->get();
        $proveedores = Proveedores::all();
        $lote = Lote::all();
        return view('registrarProducto', compact(
            'user',
            'saludo',
            'subparametrosCategorias',
            'subparametrosMarca',
            'subparametrosColor',
            'subparametrosPresentacion',
            'subparametrosEstado',
            'proveedores',
            'lote'
        ));
    }

    public function store(Request $request, $id)
    {
        $user = DB::table('usuarios')->where('id', $id)->first();

        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }

        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'url_imagen' => 'required|string', // Valida que el campo `url_imagen` exista
        ]);

        Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'recomendaciones_uso' => $request->recomendaciones_uso,
            'marca' => $request->marca,
            'categoria' => $request->categoria,
            'color' => $request->color,
            'presentacion' => $request->presentacion,
            'estado' => $request->estado,
            'id_lote' => $request->id_lote,
            'url_imagen' => $request->url_imagen, // Usa la URL generada previamente
            'id_proveedor' => $request->id_proveedor,
            'cantidad' => $request->cantidad,
            'precio' => $request->precio,
            'detalle_medida' => $request->detalle_medida,
        ]);


        return redirect()->route('producto.create', ['id' => $id])
            ->with('success', 'Producto creado correctamente');
    }


    public function uploadImage(Request $request)
    {
        $request->validate([
            'imagen' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $path = $file->store('imagenes_productos', 'public'); // Guarda en 'storage/app/public/imagenes_productos'
            $url = Storage::url($path); // Genera la URL pública de la imagen

            return response()->json(['url' => $url]);
        }

        return response()->json(['error' => 'No se pudo subir la imagen'], 400);
    }
    public function update(Request $request, $id_user, $id)
    {
        // Verifica el usuario
        $user = DB::table('usuarios')->where('id', $id_user)->first();
    
        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }
    
        // Busca el producto
        $producto = Producto::findOrFail($id);
    
        // Valida la entrada
        $request->validate([
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            // Resto de validaciones...
        ]);
    
        // Procesar la imagen si existe
        if ($request->hasFile('imagen')) {
            // Elimina la imagen anterior si existe
            if ($producto->url_imagen && Storage::exists('public/' . $producto->url_imagen)) {
                Storage::delete('public/' . $producto->url_imagen);
            }
        
            $path = $request->file('imagen')->store('imagenes_productos', 'public');
            $producto->url_imagen = '/storage/' . $path; // Genera la URL pública
        } else {
            $producto->url_imagen = $request->url_imagen; // Mantén la URL actual si no hay nueva imagen
        }
        
    
        // Actualiza los demás campos
        $producto->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'recomendaciones_uso' => $request->recomendaciones_uso,
            'marca' => $request->marca,
            'categoria' => $request->categoria,
            'color' => $request->color,
            'presentacion' => $request->presentacion,
            'estado' => $request->estado,
            'id_lote' => $request->id_lote,
            'id_proveedor' => $request->id_proveedor,
            'cantidad' => $request->cantidad,
            'precio' => $request->precio,
            'detalle_medida' => $request->detalle_medida,
            'url_imagen' => $producto->url_imagen, // Incluye la URL de la imagen
        ]);
    
        return redirect()->route('producto.edit', ['id_user' => $id_user, 'id' => $producto->id_producto])
            ->with('success', 'Producto actualizado correctamente');
    }
    

    public function edit($id_user, $id)
    {
        $user = DB::table('usuarios')->where('id', $id_user)->first();

        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }

        $saludo = 'Perfil del Administrador';


        $producto = Producto::findOrFail($id);


        $subparametrosCategorias = Subparametro::where('id_parametros', 1)->get();
        $subparametrosMarca = Subparametro::where('id_parametros', 2)->get();
        $subparametrosColor = Subparametro::where('id_parametros', 3)->get();
        $subparametrosPresentacion = Subparametro::where('id_parametros', 4)->get();
        $subparametrosEstado = Subparametro::where('id_parametros', 5)->get();


        $proveedores = Proveedores::all();
        $lote = Lote::all();
        $imagenProducto = $producto->url_imagen ?? asset('images/default-placeholder.png');


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
}
