<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Usuario;


class UsuarioController extends Controller
{
    public function listarUsuarios($id)
    {
        $user = DB::table('usuarios')->where('id', $id)->first();
    
        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }

        $usuarios = DB::table('usuarios')
            ->join('roles', 'usuarios.id_roles', '=', 'roles.id_roles') 
            ->select('usuarios.id', 'usuarios.name', 'usuarios.email', 'usuarios.created_at', 'roles.nombre_rol as rol_name')
            ->get();
        
            $user = Usuario::with('rol')->find($user->id);
            $saludo = match ($user->rol->nombre_rol) {
                'empleado' => 'Perfil de Empleado',
                'admin' => 'Perfil del Administrador'
            };
    

        return view('usuariosLista', compact('user', 'saludo', 'usuarios'));
    }

    
    public function busqueda_usuario(Request $request, $id)
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


    $busqueda = $request->input('busqueda');

    $usuarios = DB::table('usuarios')
        ->join('roles', 'usuarios.id_roles', '=', 'roles.id_roles')
        ->select('usuarios.id', 'usuarios.name', 'usuarios.email', 'usuarios.created_at', 'roles.nombre_rol as rol_name')
        ->when($busqueda, function ($query, $busqueda) {
            return $query->where('usuarios.name', 'like', '%' . $busqueda . '%')
            ->orWhere('usuarios.email', 'like', '%' . $busqueda . '%'); 
        })
        ->get();

    return view('usuariosLista', compact('user', 'saludo', 'usuarios'));
}
}
