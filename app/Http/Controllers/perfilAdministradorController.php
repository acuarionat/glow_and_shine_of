<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Usuario;


class perfilAdministradorController extends Controller
{
    //
    public function recuperar_info_administrador($id) 
    {
        
        $user = DB::table('usuarios')->where('id', $id)->first();
        
        
        if (!$user) {
            return redirect('account.login')->with('error', 'Usuario no encontrado');
        }
        $cantidad = Usuario::count();
        $saludo = 'Perfil del Administrador';
        $mensajeB = 'Nos complace tenerte en nuestra comunidad como administradora. 
        Este es tu espacio personal, donde podrás gestionar la información de los usuarios,
         supervisar operaciones y acceder a herramientas clave para optimizar nuestro sistema. 
         ¡Aprovecha al máximo esta experiencia y gracias por tu valiosa contribución!';

        
        return view('dashboardAdmin', compact('user','saludo','mensajeB','cantidad'));
        return view('registrarUsuario', compact('user','saludo'));
    }
}
