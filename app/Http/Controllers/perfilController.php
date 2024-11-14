<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class perfilController extends Controller
{
    //
    public function datos_perfil($id)
    {
        $user = DB::table('usuarios')->where('id', $id)->first();

        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }

        $saludo = 'Perfil del Administrador';

        return view('perfilPersona', compact('user', 'saludo'));
    }
}
