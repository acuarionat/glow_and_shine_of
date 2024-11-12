<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Empleado;
use App\Models\Persona;

class moduloEmpleadoController extends Controller
{
    public function detalles_empleados( $id){
        $user = DB::table('usuarios')->where('id', $id)->first();

        
        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }
        $saludo = 'Perfil del Administrador';

        $empleados = DB::table('empleados')
        ->join('persona', 'empleados.id_persona', '=', 'persona.id_persona') // Unión con persona
        ->join('sub_parametros', 'empleados.turno', '=', 'sub_parametros.id_sub_parametros') // Unión con sub_parametros
        ->join('parametros', 'sub_parametros.id_parametros', '=', 'parametros.id_parametros') // Unión con parametros
        ->select('empleados.id_empleado', 'persona.nombres', 'empleados.salario', 'empleados.fecha_contratacion', 'sub_parametros.descripcion AS turno') // Selección de columnas
        ->get();
        

        return view('empleadosLista' , compact('user','saludo','empleados'));
        
    }

    public function busqueda_empleado(Request $request, $id){
        $user = DB::table('usuarios')->where('id', $id)->first();

        
        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }
        $saludo = 'Perfil del Administrador';

        $busqueda = $request->input('busqueda');

        $empleados = DB::table('empleados')
        ->join('persona', 'empleados.id_persona', '=', 'persona.id_persona') // Unión con persona
        ->join('sub_parametros', 'empleados.turno', '=', 'sub_parametros.id_sub_parametros') // Unión con sub_parametros
        ->join('parametros', 'sub_parametros.id_parametros', '=', 'parametros.id_parametros') // Unión con parametros
        ->select('empleados.id_empleado', 'persona.nombres', 'empleados.salario', 'empleados.fecha_contratacion', 'sub_parametros.descripcion AS turno') // Selección de columnas
         ->when($busqueda, function ($query, $busqueda) {
            return $query->where('persona.nombres', 'like', '%' . $busqueda . '%');
        })
        ->get();
        

        
        return view('empleadosLista' , compact('user','saludo','empleados'));
        
    }

    public function registrar_empleado($id){
        $user = DB::table('usuarios')->where('id', $id)->first();

        
        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }
        $saludo = 'Perfil del Administrador';

        return view('empleadosRegistro' , compact('user','saludo'));
        
    }    

    public function verificarCorreo(Request $request)
    {
    $correo = $request->input('correo');
    $exists = DB::table('persona')->where('correo_electronico', $correo)->exists();

    return response()->json(['exists' => $exists]);
    }


    public function registrarEmpleado(Request $request)
    {
    $correo = $request->input('correo');

    // Verificar si la persona ya existe por su correo
    $persona = DB::table('persona')->where('correo_electronico', $correo)->first();
    $ultimoIdEmpleado = DB::table('empleados')->max('id_empleado');
        $nuevoIdEmpleado = $ultimoIdEmpleado + 1;

        if ($persona) {
            // Si la persona existe, actualizamos sus datos si están vacíos o nulos
            DB::table('persona')
                ->where('correo_electronico', $correo)
                ->update([
                    'nombres' => $request->input('nombres', $persona->nombres),
                    'apellido_paterno' => $request->input('apellido_paterno', $persona->apellido_paterno),
                    'apellido_materno' => $request->input('apellido_materno', $persona->apellido_materno),
                    'ci_persona' => $request->input('carnet_identidad', $persona->ci_persona),
                    'telefono' => $request->input('telefono', $persona->telefono)
                ]);
            
            // Usamos el ID de la persona existente
            $personaId = $persona->id_persona;
        } else {
            return redirect()->back()->with('error', 'El correo electrónico no está registrado. Debe crear un usuario primero.');
        }

   
    DB::table('empleados')->insert([
        'id_empleado' => $nuevoIdEmpleado,
        'id_persona' => $persona->id_persona,
        'fecha_contratacion' => $request->input('fecha_contratacion'),
        'salario' => $request->input('salario'),
        'turno' => $request->input('turno')
    ]);

    return redirect()->back()->with('success', 'Empleado registrado correctamente.');
    }

    public function editar_empleados($id)
    {
        $user = DB::table('usuarios')->where('id', $id)->first();

        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }

        $saludo = 'Edita tu información';

        return view('empleadosEditar', compact('user','saludo'));
    }




    public function editarEmpleado($id, $id_empleado)
    {
        $user = DB::table('usuarios')->where('id', $id)->first();
        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }
        $saludo = 'Perfil del Administrador';



       // Obtener la información del empleado por su ID
       $empleados = DB::table('empleados')
        ->join('persona', 'empleados.id_persona', '=', 'persona.id_persona')
        ->where('empleados.id_empleado', $id_empleado)
        ->select('empleados.*', 'persona.*')
        ->first();

    // Verificar si el empleado existe
    if (!$empleados) {
        return redirect()->back()->with('error', 'Empleado no encontrado.');
    }

    // Retornar vista de edición con los datos del empleado y el id del usuario
    return view('empleadosEditar', compact('empleados', 'user','saludo'));
    }


    public function actualizarEmpleado(Request $request)
{
    $id_empleado = $request->input('id_empleado');
    $user = $request->input('user_id');

    // Validar la entrada
    $request->validate([
        'correo' => 'required|email',
        'nombres' => 'required|string|max:255',
        'apellido_paterno' => 'required|string|max:255',
        'apellido_materno' => 'nullable|string|max:255',
        'carnet_identidad' => 'required|string|max:20',
        'fecha_contratacion' => 'required|date',
        'salario' => 'required|numeric',
        'turno' => 'required|in:44,45,46'
    ]);

    // Buscar al empleado en la base de datos
    $empleado = DB::table('empleados')->where('id_empleado', $id_empleado)->first();
    
    if (!$empleado) {
        return redirect()->back()->with('error', 'Empleado no encontrado.');
    }

    // Obtener el id_persona del empleado
    $id_persona = $empleado->id_persona;

    // Actualizar la información en la tabla persona
    DB::table('persona')->where('id_persona', $id_persona)->update([
        'correo_electronico' => $request->input('correo'),
        'nombres' => $request->input('nombres'),
        'apellido_paterno' => $request->input('apellido_paterno'),
        'apellido_materno' => $request->input('apellido_materno'),
        'ci_persona' => $request->input('carnet_identidad')
    ]);

    // Actualizar la información en la tabla empleados
    DB::table('empleados')->where('id_empleado', $id_empleado)->update([
        'fecha_contratacion' => $request->input('fecha_contratacion'),
        'salario' => $request->input('salario'),
        'turno' => $request->input('turno')
    ]);

    // Redirigir con un mensaje de éxito
    return redirect()->route('empleados.detalles', ['id' => $user])
                     ->with('success', 'Empleado actualizado correctamente.');
}





}
