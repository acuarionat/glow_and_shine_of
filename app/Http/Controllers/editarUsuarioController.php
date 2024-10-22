<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class editarUsuarioController extends Controller
{
    //
    public function perfilUsuario()
    {
        return view('perfilUsuario');

    }
    public function editar_perfil_usuario($id)
    {
        $user = DB::table('users')->where('id', $id)->first();

        // Verificar si el usuario existe
        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }

        $saludo = 'Edita tu información';

        // Pasar los datos a la vista
       
        return view('editarPerfilUsuario', compact('user','saludo'));

    }
    
    /* public function p()
    {
        return view('components.app-layout');

    } */
}
