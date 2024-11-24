<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function listarUsuarios($id)
    {
        $user = Usuario::with('rol')->find($id);

        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }

        $usuarios = Usuario::join('roles', 'usuarios.id_roles', '=', 'roles.id_roles')
            ->select('usuarios.id', 'usuarios.name', 'usuarios.email', 'usuarios.created_at', 'roles.nombre_rol as rol_name', 'usuarios.estado')
            ->get();

        $saludo = match ($user->rol->nombre_rol) {
            'empleado' => 'Perfil de Empleado',
            'admin' => 'Perfil del Administrador',
            default => 'Perfil de Usuario'
        };

        return view('usuariosLista', compact('user', 'saludo', 'usuarios'));
    }

    public function cambiarEstado($id)
    {
        $usuario = Usuario::find($id);
    
        if (!$usuario) {
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }
    
        $nuevoEstado = $usuario->estado === 'Activo' ? 'Inactivo' : 'Activo';
        $usuario->estado = $nuevoEstado;
        $usuario->save();
    
        return redirect()->back()->with('success', "Estado del usuario cambiado a $nuevoEstado");
    }
    

    public function busqueda_usuario(Request $request, $id)
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
    
        $busqueda = $request->input('busqueda');
        $usuarios = Usuario::join('roles', 'usuarios.id_roles', '=', 'roles.id_roles')
            ->select('usuarios.id', 'usuarios.name', 'usuarios.email', 'usuarios.created_at', 'roles.nombre_rol as rol_name', 'usuarios.estado')
            ->when($busqueda, function ($query, $busqueda) {
                return $query->where('usuarios.name', 'like', '%' . $busqueda . '%')
                    ->orWhere('usuarios.email', 'like', '%' . $busqueda . '%')
                    ->orWhere('roles.nombre_rol', 'like', '%' . $busqueda . '%') 
                    ->orWhere('usuarios.estado', 'like',  $busqueda . '%'); 
            })
            ->get();
    
        return view('usuariosLista', compact('user', 'saludo', 'usuarios'));
    }
    
}
