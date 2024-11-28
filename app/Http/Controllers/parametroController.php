<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parametro;
use App\Models\Subparametro;
use Illuminate\Support\Facades\DB;

class parametroController extends Controller
{

    public function index($id)
    {
        $user = DB::table('usuarios')->where('id', $id)->first();

        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }

        $saludo = 'Perfil del Administrador';
        $categorias = Parametro::with('subparametros')->get();
        return view('registrarNuevaCategoria', compact('user', 'saludo', 'categorias'));
    }

    public function getSubparametros($id_parametros)
{
    $subparametros = Subparametro::where('id_parametros', $id_parametros)->get();
    return response()->json($subparametros);
}

public function create($id)
{
    $user = DB::table('usuarios')->where('id', $id)->first();

    if (!$user) {
        return redirect('/users')->with('error', 'Usuario no encontrado');
    }

    $saludo = 'Perfil del Administrador';
    $categorias = Parametro::all(); // Mostrar todas las categorías
    return view('agregarSubparametro', compact('user', 'saludo', 'categorias'));
}

public function storeSubparametro(Request $request, $id)
{
    $user = DB::table('usuarios')->where('id', $id)->first();

        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }

        $saludo = 'Perfil del Administrador';

    $request->validate([
        'id_parametros' => 'required|exists:parametros,id_parametros',
        'descripcion' => 'required|string|max:100',
    ]);

    Subparametro::create([
        'id_parametros' => $request->id_parametros,
        'descripcion' => $request->descripcion,
    ]);

    return redirect()->route('categorias.subparametros.create' , ['id' => $id])
                     ->with('success', 'Subparametro registrada con éxito.');
}


}
