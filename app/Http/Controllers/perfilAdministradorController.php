<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class perfilAdministradorController extends Controller
{
    public function recuperar_info_administrador($id) // Recibir el ID del usuario
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('account.dashboard')->with('error', 'Acceso denegado.');
        }

        // Recuperar el usuario específico usando DB::table()
        $user = DB::table('users')->where('id', $id)->first();

        // Verificar si el usuario existe
        if (!$user) {
            return redirect()->route('account.dashboard')->with('error', 'Usuario no encontrado');
        }

        $saludo = 'Perfil del Administrador';
        $mensajeB = 'Nos complace tenerte en nuestra comunidad como administrador. 
        Este es tu espacio personal, donde podrás gestionar la información de los usuarios,
        supervisar operaciones y acceder a herramientas clave para optimizar nuestro sistema. 
        ¡Aprovecha al máximo esta experiencia y gracias por tu valiosa contribución!';

        // Pasar los datos a la vista
        return view('dashboardAdmin', compact('user', 'saludo', 'mensajeB'));
    }
}
