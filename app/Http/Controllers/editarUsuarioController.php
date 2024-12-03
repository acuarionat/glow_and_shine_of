<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class editarUsuarioController extends Controller
{
    //
    public function perfilUsuario()
    {
        return view('perfilUsuario');
    }

    public function editar_perfil_usuario($id)
    {
        // Obtener el correo del usuario logueado
        $user = DB::table('usuarios')->where('id', $id)->first();
        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }
        // Asegúrate de que Auth esté configurado correctamente
        $correo = $user->email;

        // Buscar la persona en base al correo
        $persona = DB::table('persona')->where('correo_electronico', $correo)->first();

        // Verificar si se encontró la persona
        if (!$persona) {
            return redirect('/perfilUsuario')->with('error', 'No se encontró información relacionada con este usuario.');
        }

        $saludo = 'Edita tu información';

        return view('editarPerfilUsuario', compact('user', 'persona', 'saludo'));
    }

    public function actualizar(Request $request)
    {
        // Obtener el correo del usuario logueado
        $user = Auth::user();
        $correo = $user->email;

        // Validación de los datos enviados desde el formulario
        $request->validate([
            'nombre' => 'required|string|max:100|regex:/^[\pL\s\-]+$/u',
            'apellido_paterno' => 'nullable|string|max:100|regex:/^[\pL\s\-]+$/u',
            'apellido_materno' => 'nullable|string|max:100|regex:/^[\pL\s\-]+$/u',
            'ci' => 'nullable|numeric|digits_between:6,20',
            'fecha_nacimiento' => 'nullable|date',
            'correo_electronico' => 'required|email|max:200|unique:persona,correo_electronico,' . $correo . ',correo_electronico',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|numeric|digits_between:7,15',
            'genero' => 'nullable|integer|in:55,56,57',
            'estado_civil' => 'nullable|integer|in:58,59,60',
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

        // Actualizar los datos en la tabla `persona` basándose en el correo
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

        return redirect("dashboard/editarPerfil/{$user->id}")->with('success', 'Información actualizada correctamente.');
    }
}
