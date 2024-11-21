<?php

namespace App\Http\Controllers;
use App\Models\Usuario;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class comprasController extends Controller
{
    public function mostrarCompras($id)
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

        $compras = DB::table('inventario_compra as iv')
                ->select(
                    'iv.id_inventario_compra',
                    'p.nombre as producto',
                    'iv.cantidad',
                    'iv.costo_unitario as precio', 
                    'u.name as usuario',
                    'iv.fecha_compra'
                )
                ->join('producto as p', 'iv.id_producto', '=', 'p.id_producto')
                ->join('usuarios as u', 'iv.id_usuario', '=', 'u.id') 
                ->get();

        // Pasar los datos a la vista
        return view('mostrarCompras', compact('user','saludo','compras'));
    }
}
