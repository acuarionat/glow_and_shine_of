<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;


class perfilController extends Controller
{
    //
    public function datos_perfil($id)
    {
        $user = Usuario::with('rol')->find($id);

        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }
    
        $saludo = match ($user->rol->nombre_rol) {
            'empleado' => 'Perfil de Empleado',
            'admin' => 'Perfil del Administrador',
            default => 'Perfil de Usuario'
        };

        return view('perfilPersona', compact('user', 'saludo'));
    }


    public function editar_perfilPersona($id)
    {
        $user = Usuario::with('rol')->find($id);

        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }
    
        $saludo = match ($user->rol->nombre_rol) {
            'empleado' => 'Perfil de Empleado',
            'admin' => 'Perfil del Administrador',
            default => 'Perfil de Usuario'
        };
        $correo = $user->email;
        $persona = DB::table('persona')->where('correo_electronico', $correo)->first();
        if (!$persona) {
           
            return view('perfilPersona', compact('saludo', 'user'))->with('error', 'No se encontró información relacionada con este usuario.');
        }
        $empleado = DB::table('empleados')->where('id_persona', $persona->id_persona)->first();

        if (!$empleado) {
            return view('perfilPersona', compact('saludo', 'user'))->with('error', 'No se encontró un empleado relacionado con este usuario.');
        }

        $datosAcademicos = DB::table('datos_academicos')
            ->where('id_empleado', $empleado->id_empleado)
            ->first();
        if (!$datosAcademicos) {
            $datosAcademicos = (object) [
                'nivel_academico' => null,
                'especialidad_academica' => null
            ];
        }

        return view('editarPerfilAdminEmpleados', compact('user', 'persona', 'saludo', 'datosAcademicos'));
    }

    public function actualizar_datos(Request $request)
    {
        
        $user = Auth::user();
        $correo = $user->email;

        
        $request->validate([
            'nombre' => 'required|string|max:100|regex:/^[\pL\s\-]+$/u',
            'apellido_paterno' => 'nullable|string|max:100|regex:/^[\pL\s\-]+$/u',
            'apellido_materno' => 'nullable|string|max:100|regex:/^[\pL\s\-]+$/u',
            'ci' => 'nullable|numeric|digits_between:6,20',
            'fecha_nacimiento' => 'nullable|date',
            'correo_electronico' => 'required|email|max:200|unique:persona,correo_electronico,' . $correo . ',correo_electronico',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|numeric|digits_between:7,15',
            'genero' => 'nullable|integer|in:45,46,47',
            'estado_civil' => 'nullable|integer|in:48,49,50',
            'nivel_academico' => 'nullable|integer|in:37,38,39',
            'especialidad_academica' => 'nullable|integer|in:40,41',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de caracteres.',
            'apellido_paterno.required' => 'El campo apellido paterno es obligatorio.',
            'apellido_paterno.string' => 'El apellido paterno debe ser una cadena de caracteres.',
            'ci.required' => 'El campo carnet de identidad es obligatorio.',
            'ci.numeric' => 'El carnet de identidad debe ser numérico.',
            'ci.digits_between' => 'El carnet de identidad debe tener entre 6 y 20 dígitos.',
            'ci.unique' => 'Este carnet de identidad ya está registrado.',
            'telefono.numeric' => 'El teléfono debe ser numérico.',
            'telefono.digits_between' => 'El teléfono debe tener entre 7 y 15 dígitos.',
            'correo_electronico.required' => 'El campo correo electrónico es obligatorio.',
            'correo_electronico.email' => 'El correo electrónico debe ser un correo válido.',
            'correo_electronico.unique' => 'Este correo electrónico ya está registrado.',
            'fecha_nacimiento.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'direccion.string' => 'La dirección debe ser una cadena de caracteres.',
            'genero.in' => 'El género seleccionado no es válido.',
            'estado_civil.in' => 'El estado civil seleccionado no es válido.',
        ]);

        
        DB::table('persona')
            ->where('correo_electronico', $correo)
            ->update([
                'nombres' => $request->nombre,
                'apellido_paterno' => $request->apellido_paterno,
                'apellido_materno' => $request->apellido_materno,
                'ci_persona' => $request->ci,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'correo_electronico' => $request->correo_electronico,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'genero' => $request->genero,
                'estado_civil' => $request->estado_civil,
            ]);
        $persona = DB::table('persona')->where('correo_electronico', $correo)->first();
        if (!$persona) {
          
            return view('perfilPersona', compact('saludo', 'user'))->with('error', 'No se encontró información relacionada con este usuario.');
        }
        $empleado = DB::table('empleados')->where('id_persona', $persona->id_persona)->first();

        if ($empleado) {
         
          
            DB::table('datos_academicos')->updateOrInsert(
                ['id_empleado' => $empleado->id_empleado], 
                [
                    
                    'nivel_academico' => $request->nivel_academico,
                    'especialidad_academica' => $request->especialidad_academica,
                ]
            );
        }

        return redirect("/editarPerfilPersona/{$user->id}")->with('success', 'Información actualizada correctamente.');
    }
}
