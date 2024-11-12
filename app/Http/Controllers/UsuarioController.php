<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Usuario;


class UsuarioController extends Controller
{
    public function listarUsuarios($id)
    {
        // Obtener el usuario por su ID
        $user = DB::table('usuarios')->where('id', $id)->first();
    
        // Verificar si el usuario existe
        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }

        // Consultar la lista de usuarios con sus roles
        $usuarios = DB::table('usuarios')
            ->join('roles', 'usuarios.id_roles', '=', 'roles.id_roles') 
            ->select('usuarios.id', 'usuarios.name', 'usuarios.email', 'usuarios.created_at', 'roles.nombre_rol as rol_name')
            ->get();
        
        // Definir el saludo
        $saludo = 'Perfil del Administrador';

        // Pasar los datos a la vista
        return view('usuariosLista', compact('user', 'saludo', 'usuarios'));
    }
    public function busqueda_usuario(Request $request, $id)
{
    // Obtener el usuario actual
    $user = DB::table('usuarios')->where('id', $id)->first();

    // Verificar si el usuario existe
    if (!$user) {
        return redirect('/users')->with('error', 'Usuario no encontrado');
    }

    // Definir saludo
    $saludo = 'Perfil del Administrador';

    // Obtener el término de búsqueda desde la solicitud
    $busqueda = $request->input('busqueda');

    // Realizar la búsqueda de usuarios
    $usuarios = DB::table('usuarios')
        ->join('roles', 'usuarios.id_roles', '=', 'roles.id_roles')
        ->select('usuarios.id', 'usuarios.name', 'usuarios.email', 'usuarios.created_at', 'roles.nombre_rol as rol_name')
        ->when($busqueda, function ($query, $busqueda) {
            return $query->where('usuarios.name', 'like', '%' . $busqueda . '%')
            ->orWhere('usuarios.email', 'like', '%' . $busqueda . '%'); 
        })
        ->get();

    // Pasar datos a la vista
    return view('usuariosLista', compact('user', 'saludo', 'usuarios'));
}
}
