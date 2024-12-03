<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostCreatedMail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class moduloClienteController extends Controller
{
    public function registrar_cliente($id)
    {
        $user = DB::table('usuarios')->where('id', $id)->first();


        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }
        $saludo = 'Perfil del Administrador';

        return view('clientesRegistro', compact('user', 'saludo'));
    }

    public function verificarCorreo(Request $request)
    {
        $correo = $request->input('correo');
        $exists = DB::table('persona')->where('correo_electronico', $correo)->exists();

        return response()->json(['exists' => $exists]);
    }


    public function registrarCliente(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'correo' => 'required|email|unique:persona,correo_electronico',
            'nombres' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'carnet_identidad' => 'required|numeric|digits_between:6,10|unique:persona,ci_persona',
            'telefono' => 'nullable|string|max:20',
            'tipo_cliente' => 'required|string|in:42,43,44',
            'porcentaje_descuento' => 'nullable|numeric|min:0|max:100',
        ], [
            // Mensajes de error personalizados
            'correo.required' => 'El campo correo es obligatorio.',
            'correo.email' => 'El formato del correo no es válido.',
            'correo.unique' => 'El correo ya está registrado.',
            'nombres.required' => 'El campo nombres es obligatorio.',
            'apellido_paterno.required' => 'El apellido paterno es obligatorio.',
            'carnet_identidad.required' => 'El carnet de identidad es obligatorio.',
            'carnet_identidad.numeric' => 'El carnet de identidad debe ser un número.',
            'carnet_identidad.digits_between' => 'El carnet de identidad debe tener entre 6 y 10 dígitos.',
            'tipo_cliente.required' => 'El tipo de cliente es obligatorio.',
            'tipo_cliente.in' => 'El tipo de cliente debe ser 42, 43 o 44.',
            'porcentaje_descuento.numeric' => 'El porcentaje de descuento debe ser un número.',
            'porcentaje_descuento.min' => 'El porcentaje de descuento no puede ser menor a 0.',
            'porcentaje_descuento.max' => 'El porcentaje de descuento no puede ser mayor a 100.',
        ]);
    
        // Generar una contraseña automáticamente
        $nombre = $request->input('nombres');
        $email = $request->input('correo');
        $parteEmail = explode('@', $email)[0];
        $randomNum = rand(100, 999);
        $contrasenaSugerida = substr($nombre, 0, 3) . substr($parteEmail, 0, 3) . $randomNum;

        // Crear el usuario y obtener su ID
        $nuevoIdUsuario = DB::table('usuarios')->insertGetId([
            'name' => $nombre,
            'email' => $email,
            'password' => bcrypt($contrasenaSugerida),
            'id_roles' => 1,
            'estado' => 'Activo',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $nuevoIdPersona = DB::table('persona')->insertGetId([
            'id_usuario' => $nuevoIdUsuario, 
            'correo_electronico' => $email,
            'nombres' => $nombre,
            'apellido_paterno' => $request->input('apellido_paterno'),
            'apellido_materno' => $request->input('apellido_materno'),
            'ci_persona' => $request->input('carnet_identidad'),
            'telefono' => $request->input('telefono'),
        ]);

        DB::table('cliente')->insert([
            'id_persona' => $nuevoIdPersona,
            'tipo_cliente' => $request->input('tipo_cliente'),
            'porcentaje_descuento' => $request->input('porcentaje_descuento'),
        ]);

        Mail::to($email)->send(new PostCreatedMail($nombre, $email, $contrasenaSugerida));

        return redirect()->back()->with('success', 'Cliente registrado correctamente.');
        }
    


        public function detalles_cliente($id)
        {
            $user = DB::table('usuarios')->where('id', $id)->first();
        
            if (!$user) {
                return redirect('/users')->with('error', 'Usuario no encontrado');
            }
            $saludo = 'Perfil del Administrador';
        
            $clientes = DB::table('cliente')
                ->join('persona', 'cliente.id_persona', '=', 'persona.id_persona')
                ->join('sub_parametros', 'cliente.tipo_cliente', '=', 'sub_parametros.id_sub_parametros')
                ->select(
                    'cliente.id_cliente',
                    'persona.nombres',
                    'cliente.porcentaje_descuento',
                    'sub_parametros.descripcion AS tipo_cliente'
                )
                ->paginate(10);  
        
            return view('clientesLista', compact('user', 'saludo', 'clientes'));
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
                ->select(
                    'cliente.id_cliente',
                    'persona.nombres',
                    'cliente.porcentaje_descuento',
                    'sub_parametros.descripcion AS tipo_cliente'
                )
                ->when($busqueda, function ($query, $busqueda) {
                    return $query->where(function($q) use ($busqueda) {
                        $q->where('persona.nombres', 'like', '%' . $busqueda . '%')
                          ->orWhere('cliente.porcentaje_descuento', 'like', '%' . $busqueda . '%')
                          ->orWhere('sub_parametros.descripcion', 'like', '%' . $busqueda . '%');
                    });
                })
                ->paginate(10); 
        
            return view('clientesLista', compact('user', 'saludo', 'clientes'));
        }
        
        

    public function editar_clientes($id)
    {
        $user = DB::table('usuarios')->where('id', $id)->first();

        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }

        $saludo = 'Edita tu información';

        return view('clientesEditar', compact('user', 'saludo'));
    }




    public function editarCliente($id, $id_cliente)
    {
        $user = DB::table('usuarios')->where('id', $id)->first();
        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }
        $saludo = 'Perfil del Administrador';



        $clientes = DB::table('cliente')
            ->join('persona', 'cliente.id_persona', '=', 'persona.id_persona')
            ->where('cliente.id_cliente', $id_cliente)
            ->select('cliente.*', 'persona.*')
            ->first();

        if (!$clientes) {
            return redirect()->back()->with('error', 'Cliente no encontrado.');
        }

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
