<?php

namespace App\Http\Controllers;

use App\Mail\PostCreatedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Empleado;
use App\Models\Persona;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Mail;

class moduloEmpleadoController extends Controller
{

    public function detalles_empleados($id)
    {
        $user = DB::table('usuarios')->where('id', $id)->first();


        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }
        $saludo = 'Perfil del Administrador';

        $empleados = DB::table('empleados')
            ->join('persona', 'empleados.id_persona', '=', 'persona.id_persona') 
            ->join('sub_parametros', 'empleados.turno', '=', 'sub_parametros.id_sub_parametros')
            ->join('parametros', 'sub_parametros.id_parametros', '=', 'parametros.id_parametros')  
            ->select('empleados.id_empleado', 'persona.nombres', 'empleados.salario', 'empleados.fecha_contratacion', 'sub_parametros.descripcion AS turno') // Selección de columnas
            ->get();


        return view('empleadosLista', compact('user', 'saludo', 'empleados'));
    }

    public function busqueda_empleado(Request $request, $id)
    {
        $user = DB::table('usuarios')->where('id', $id)->first();


        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }
        $saludo = 'Perfil del Administrador';

        $busqueda = $request->input('busqueda');

        $empleados = DB::table('empleados')
            ->join('persona', 'empleados.id_persona', '=', 'persona.id_persona')
            ->join('sub_parametros', 'empleados.turno', '=', 'sub_parametros.id_sub_parametros') 
            ->join('parametros', 'sub_parametros.id_parametros', '=', 'parametros.id_parametros') 
            ->select('empleados.id_empleado', 'persona.nombres', 'empleados.salario', 'empleados.fecha_contratacion', 'sub_parametros.descripcion AS turno') 
            ->when($busqueda, function ($query, $busqueda) {
                return $query->where('persona.nombres', 'like', '%' . $busqueda . '%');
            })

            ->when($busqueda, function ($query, $busqueda) {
                $query->where('persona.nombres', 'like', '%' . $busqueda . '%');
            })

            ->get();

        return view('empleadosLista', compact('user', 'saludo', 'empleados'));
    }

    public function registrar_empleado($id)
    {
        $user = DB::table('usuarios')->where('id', $id)->first();


        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }
        $saludo = 'Perfil del Administrador';

        return view('empleadosRegistro', compact('user', 'saludo'));
    }

    public function verificarCorreo(Request $request)
    {
        $correo = $request->input('correo');
        $exists = DB::table('persona')->where('correo_electronico', $correo)->exists();

        return response()->json(['exists' => $exists]);
    }


    public function registrarEmpleado(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'carnet_identidad' => 'required|numeric|digits_between:6,10|unique:persona,ci_persona',
            'telefono' => 'nullable|numeric|digits_between:7,15',
            'correo' => 'required|email|unique:persona,correo_electronico',
            'fecha_contratacion' => 'required|date',
            'salario' => 'required|numeric|min:0',
            'turno' => 'required|string|in:35,36,37',
        ], [
            'nombres.required' => 'El campo nombres es obligatorio.',
            'apellido_paterno.required' => 'El campo apellido paterno es obligatorio.',
            'apellido_paterno.string' => 'El apellido paterno debe ser llenado por letras',
            'carnet_identidad.required' => 'El carnet de identidad es obligatorio.',
            'carnet_identidad.numeric' => 'El carnet de identidad debe ser un número.',
            'carnet_identidad.digits_between' => 'El carnet de identidad debe tener entre 6 y 10 dígitos.',
            'carnet_identidad.unique' => 'Este carnet de identidad ya está registrado.',
            'telefono.numeric' => 'El teléfono debe ser numérico.',
            'telefono.digits_between' => 'El teléfono debe tener entre 7 y 15 dígitos.',
            'correo.required' => 'El campo correo es obligatorio.',
            'correo.email' => 'El correo debe ser un correo válido.',
            'correo.unique' => 'Este correo ya está registrado.',
            'fecha_contratacion.required' => 'La fecha de contratación es obligatoria.',
            'fecha_contratacion.date' => 'La fecha de contratación debe ser una fecha válida.',
            'salario.required' => 'El salario es obligatorio.',
            'salario.numeric' => 'El salario debe ser un valor numérico.',
            'salario.min' => 'El salario debe ser mayor o igual a 0.',
            'turno.required' => 'El turno es obligatorio.',
            'turno.in' => 'El turno seleccionado no es válido.',
        ]);
    
        $nuevoIdPersona = DB::table('persona')->insertGetId([
            'nombres' => $request->input('nombres'),
            'apellido_paterno' => $request->input('apellido_paterno'),
            'apellido_materno' => $request->input('apellido_materno'),
            'ci_persona' => $request->input('carnet_identidad'),
            'telefono' => $request->input('telefono'),
            'correo_electronico' => $request->input('correo'),
            'fecha_registro' => now()->format('Y-m-d H:i:s'),
        ]);
    
        DB::table('empleados')->insert([
            'id_persona' => $nuevoIdPersona,
            'fecha_contratacion' => $request->input('fecha_contratacion'),
            'salario' => $request->input('salario'),
            'turno' => $request->input('turno'),
        ]);
    
    
        $nombre = $request->input('nombres');
        $email = $request->input('correo');
        $parteEmail = explode('@', $email)[0];
        $randomNum = rand(100, 999); 
        $contrasenaSugerida = substr($nombre, 0, 3) . substr($parteEmail, 0, 3) . $randomNum;
    
        DB::table('usuarios')->insert([
            'name' => $nombre,
            'email' => $email,
            'password' => bcrypt($contrasenaSugerida),
            'id_roles' => 2, 
            'estado' => 'Activo', 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Mail::to($email)->send(new PostCreatedMail($nombre, $email, $contrasenaSugerida));
        
        return redirect()->back()->with('success', 'Empleado registrado correctamente.');
    }
    


    public function editar_empleados($id)
    {
        $user = DB::table('usuarios')->where('id', $id)->first();

        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }

        $saludo = 'Edita tu información';

        return view('empleadosEditar', compact('user', 'saludo'));
    }




    public function editarEmpleado($id, $id_empleado)
    {
        $user = DB::table('usuarios')->where('id', $id)->first();
        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }
        $saludo = 'Perfil del Administrador';

        $empleados = DB::table('empleados')
            ->join('persona', 'empleados.id_persona', '=', 'persona.id_persona')
            ->where('empleados.id_empleado', $id_empleado)
            ->select('empleados.*', 'persona.*')
            ->first();

        if (!$empleados) {
            return redirect()->back()->with('error', 'Empleado no encontrado.');
        }

        return view('empleadosEditar', compact('empleados', 'user', 'saludo'));
    }


    public function actualizarEmpleado(Request $request)
    {
        $id_empleado = $request->input('id_empleado');
        $user = $request->input('user_id');

        $request->validate([
            'correo' => 'required|email',
            'nombres' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'carnet_identidad' => 'required|string|max:20',
            'fecha_contratacion' => 'required|date',
            'salario' => 'required|numeric',
            'turno' => 'required|in:34,35,36'
        ]);

        $empleado = DB::table('empleados')->where('id_empleado', $id_empleado)->first();

        if (!$empleado) {
            return redirect()->back()->with('error', 'Empleado no encontrado.');
        }

        $id_persona = $empleado->id_persona;

        DB::table('persona')->where('id_persona', $id_persona)->update([
            'correo_electronico' => $request->input('correo'),
            'nombres' => $request->input('nombres'),
            'apellido_paterno' => $request->input('apellido_paterno'),
            'apellido_materno' => $request->input('apellido_materno'),
            'ci_persona' => $request->input('carnet_identidad')
        ]);

        DB::table('empleados')->where('id_empleado', $id_empleado)->update([
            'fecha_contratacion' => $request->input('fecha_contratacion'),
            'salario' => $request->input('salario'),
            'turno' => $request->input('turno')
        ]);

        return redirect()->route('empleados.informacion', ['id' => $user])
            ->with('success', 'Empleado actualizado correctamente.');
    }


    public function mostrarDetalle($id, $id_empleado)
    {
        $user = DB::table('usuarios')->where('id', $id)->first();
        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }
        $saludo = 'Perfil del Administrador';

        $empleados = DB::table('empleados')
            ->join('persona', 'empleados.id_persona', '=', 'persona.id_persona')
            ->leftJoin('dbo.sub_parametros as genero', 'persona.genero', '=', 'genero.id_sub_parametros') 
            ->leftJoin('dbo.sub_parametros as estadoCivil', 'persona.estado_civil', '=', 'estadoCivil.id_sub_parametros') 
            ->where('empleados.id_empleado', $id_empleado)
            ->select(
                'empleados.*',
                'persona.*',
                'genero.descripcion as genero_descripcion',
                'estadoCivil.descripcion as estado_civil_descripcion'
            )
            ->first();

        $datosAcademicos = DB::table('datos_academicos')
            ->join('sub_parametros as nivel', 'datos_academicos.nivel_academico', '=', 'nivel.id_sub_parametros')
            ->join('sub_parametros as especialidad', 'datos_academicos.especialidad_academica', '=', 'especialidad.id_sub_parametros')
            ->where('datos_academicos.id_empleado', $id_empleado)
            ->select(
                'datos_academicos.id_datos_academicos',
                'nivel.descripcion as nivel_academico_descripcion',
                'especialidad.descripcion as especialidad_academica_descripcion'
            )
            ->first();

        if (!$empleados) {
            return redirect()->back()->with('error', 'Empleado no encontrado.');
        }

        return view('empleadosDetalle', compact('empleados', 'user', 'saludo', 'datosAcademicos'));
    }
}
