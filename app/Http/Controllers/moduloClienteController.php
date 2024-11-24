<?php

namespace App\Http\Controllers;
use App\Models\Usuario;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class moduloClienteController extends Controller
{
    public function registrar_cliente($id){
        $user = DB::table('usuarios')->where('id', $id)->first();

        
        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }
        $user = Usuario::with('rol')->find($user->id);
        $saludo = match ($user->rol->nombre_rol) {
            'empleado' => 'Perfil de Empleado',
            'admin' => 'Perfil del Administrador'
        };


        return view('clientesRegistro' , compact('user','saludo'));
        
    }    

    public function verificarCorreo(Request $request)
    {
    $correo = $request->input('correo');
    $exists = DB::table('persona')->where('correo_electronico', $correo)->exists();

    return response()->json(['exists' => $exists]);
    }


    public function registrarCliente(Request $request)
    {
    $correo = $request->input('correo');

    $persona = DB::table('persona')->where('correo_electronico', $correo)->first();

        if ($persona) {
            DB::table('persona')
                ->where('correo_electronico', $correo)
                ->update([
                    'nombres' => $request->input('nombres', $persona->nombres),
                    'apellido_paterno' => $request->input('apellido_paterno', $persona->apellido_paterno),
                    'apellido_materno' => $request->input('apellido_materno', $persona->apellido_materno),
                    'ci_persona' => $request->input('carnet_identidad', $persona->ci_persona),
                    'telefono' => $request->input('telefono', $persona->telefono)
                ]);
            
            $personaId = $persona->id_persona;
        } else {
            return redirect()->back()->with('error', 'El correo electrónico no está registrado. Debe crear un usuario primero.');
        }

   
    DB::table('cliente')->insert([
        'id_persona' => $persona->id_persona,
        'tipo_cliente' => $request->input('tipo_cliente'),
        'porcentaje_descuento' => $request->input('porcentaje_descuento')
        
    ]);

    return redirect()->back()->with('success', 'Cliente registrado correctamente.');
    }


    public function detalles_cliente( $id){
        $user = DB::table('usuarios')->where('id', $id)->first();

        
        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }
        $user = Usuario::with('rol')->find($user->id);
        $saludo = match ($user->rol->nombre_rol) {
            'empleado' => 'Perfil de Empleado',
            'admin' => 'Perfil del Administrador'
        };

        $clientes = DB::table('cliente')
        ->join('persona', 'cliente.id_persona', '=', 'persona.id_persona') // Unión con la tabla persona
        ->join('sub_parametros', 'cliente.tipo_cliente', '=', 'sub_parametros.id_sub_parametros') // Unión con sub_parametros
        ->select(
            'cliente.id_cliente', 
            'persona.nombres', 
            'cliente.porcentaje_descuento', 
            'sub_parametros.descripcion AS tipo_cliente'
        ) 
        ->get();
        

        return view('clientesLista' , compact('user','saludo','clientes'));
        
    }

    public function busqueda_cliente(Request $request, $id)
    {
        $user = DB::table('usuarios')->where('id', $id)->first();


        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }
        $saludo = 'Perfil del Administrador';

        $busqueda = $request->input('busqueda');

        $clientes = DB::table('cliente')
            ->join('persona', 'cliente.id_persona', '=', 'persona.id_persona')
            ->join('sub_parametros', 'cliente.tipo_cliente', '=', 'sub_parametros.id_sub_parametros')
            ->select('cliente.id_cliente', 'persona.nombres', 'cliente.porcentaje_descuento','sub_parametros.descripcion AS tipo_cliente')
            ->when($busqueda, function ($query, $busqueda) {
                return $query->where('persona.nombres', 'like', '%' . $busqueda . '%');
            })
            ->get();

        return view('clientesLista', compact('user', 'saludo', 'clientes'));
    }
        public function editar_clientes($id)
    {
        $user = DB::table('usuarios')->where('id', $id)->first();

        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }

        $saludo = 'Edita tu información';

        return view('clientesEditar', compact('user','saludo'));
    }



    public function editarCliente($id, $id_cliente)
    {
        // Obtener el usuario logueado
        $user = DB::table('usuarios')->where('id', $id)->first();
        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }
        $user = Usuario::with('rol')->find($user->id);
        $saludo = match ($user->rol->nombre_rol) {
            'empleado' => 'Perfil de Empleado',
            'admin' => 'Perfil del Administrador'
        };
    
        // Obtener la información del cliente por su ID
        $clientes = DB::table('cliente')
            ->join('persona', 'cliente.id_persona', '=', 'persona.id_persona')
            ->where('cliente.id_cliente', $id_cliente)
            ->select('cliente.*', 'persona.*')
            ->first();
    
        // Verificar si el cliente existe
        if (!$clientes) {
            return redirect()->back()->with('error', 'Cliente no encontrado.');
        }
    
        // Retornar vista de edición con los datos del cliente y el id del usuario
        return view('clientesEditar', compact('clientes', 'user', 'saludo'));
    }
    
    public function actualizarCliente(Request $request)
    {
        $id_cliente = $request->input('id_cliente');
        $user = $request->input('user_id');
    
        // Validar la entrada
        $request->validate([
            'correo' => 'required|email',
            'nombres' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'carnet_identidad' => 'required|string|max:20',
            'porcentaje_descuento' => 'required|numeric|between:0,100', // Valor entre 0 y 100
            'tipo_cliente' => 'required|in:42,43,44' // Asegúrate de que estos valores sean correctos
        ]);
    
        // Buscar al cliente en la base de datos
        $cliente = DB::table('cliente')->where('id_cliente', $id_cliente)->first();
        
        if (!$cliente) {
            return redirect()->route('cliente.detalles', ['id' => $user])->with('error', 'Cliente no encontrado.');
        }
    
        // Obtener el id_persona del cliente
        $id_persona = $cliente->id_persona;
    
        // Actualizar la información en la tabla persona
        DB::table('persona')->where('id_persona', $id_persona)->update([
            'correo_electronico' => $request->input('correo'),
            'nombres' => $request->input('nombres'),
            'apellido_paterno' => $request->input('apellido_paterno'),
            'apellido_materno' => $request->input('apellido_materno'),
            'ci_persona' => $request->input('carnet_identidad')
        ]);
    
        // Actualizar la información en la tabla cliente
        DB::table('cliente')->where('id_cliente', $id_cliente)->update([
            'porcentaje_descuento' => $request->input('porcentaje_descuento'),
            'tipo_cliente' => $request->input('tipo_cliente')
        ]);
    
        return redirect()->route('cliente.detalles', ['id' => $user])
                         ->with('success', 'Cliente actualizado correctamente.');
    }
    

}
