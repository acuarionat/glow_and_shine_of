<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class perfilUsuarioController extends Controller
{
    public function recuperar_info($id)
    {
        if (Auth::user()->role !== 'cliente') {
            return redirect()->route('account.dashboard')->with('error', 'Acceso denegado.');
        }

        $user = DB::table('users')->where('id', $id)->first();

        if (!$user) {
            return redirect()->route('account.dashboard')->with('error', 'Usuario no encontrado');
        }

        $saludo = 'Perfil de';
        $mensajeB = 'Nos alegra que formes parte de nuestra 
        comunidad. Este es tu espacio personal, 
        donde podrás añadir tu información, 
        explorar nuestros productos y más. 
        ¡Disfruta de la experiencia!';


        return view('dashboard', compact('user', 'saludo', 'mensajeB'));
        dd(compact('user', 'saludo', 'mensajeB'));
    }

    

}
