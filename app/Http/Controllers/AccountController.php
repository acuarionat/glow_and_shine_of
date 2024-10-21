<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AccountController extends Controller
{
    public function processRegistration(Request $request)
    {
        // Reglas de validación
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/', // solo gmail
            'password' => 'required|string|min:8|confirmed', // mínimo 8 caracteres y debe ser confirmado
        ];

        // Mensajes de error personalizados
        $messages = [
            'email.regex' => 'El correo electrónico debe ser una dirección Gmail válida.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ];

        // Validación
        $validator = Validator::make($request->all(), $rules, $messages);

        // Si la validación falla, redirige de vuelta con los errores
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Si la validación es correcta, continuar con el registro (lógica a implementar)
        // Por ejemplo, podrías crear el usuario en la base de datos.

        return redirect()->route('some.route')->with('success', '¡Registro exitoso!');
    }
}
