<?php

namespace App\Http\Controllers;

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
            'url_imagen' => 'required|url',
            'descripcion' => 'nullable|string',
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
            'url_imagen' => $request->url_imagen, 
            'id_proveedor' => $request->id_proveedor,
            'cantidad' => $request->cantidad,
            'precio' => $request->precio,
            'detalle_medida' => $request->detalle_medida,
        ]);

        return redirect()->route('producto.create', ['id' => $id])
            ->with('success', 'Producto creado correctamente');
    }

    public function update(Request $request, $id_user, $id)
    {
        $user = DB::table('usuarios')->where('id', $id_user)->first();

        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }

        $producto = Producto::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:100',
            'url_imagen' => 'required|url',
            'descripcion' => 'nullable|string',
        ]);

        $producto->update([
            'url_imagen' => $request->url_imagen, 
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
        ]);

        return redirect()->route('producto.update', ['id' => $producto->id_producto, 'id_user' => $id_user])
            ->with('success', 'Producto actualizado correctamente');
    }
}
