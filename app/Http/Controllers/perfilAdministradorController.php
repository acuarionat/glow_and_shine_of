<?php

namespace App\Http\Controllers;

use App\Models\Producto;
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
        $cantidadUsuarios = Usuario::count();
        $cantidadVentas = DB::table('inventario_venta')->count();
        $cantidadCompras = DB::table('inventario_compra')->count();
        $cantidadClientes = DB::table('cliente')->count();
        $cantidadEmpleados = DB::table('empleados')->count();
        $cantidadProductos = Producto::count();
        $saludo = 'Perfil del Administrador';
        $mensajeB = 'Este es tu panel personal, donde podras realizar tus tareas como administrad@r.';

         $cantidadDatos = [
            'Usuarios' => $cantidadUsuarios,
            'Ventas' => $cantidadVentas,
            'Compras' => $cantidadCompras,
            'Clientes' => $cantidadClientes,
            'Empleados' => $cantidadEmpleados,
            'Productos' => $cantidadProductos,
        ]; 

    
         
         return view('dashboardAdmin', compact('user','saludo','mensajeB','cantidadDatos'));
     }
}
