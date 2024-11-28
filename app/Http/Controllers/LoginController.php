<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Persona;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }
   
    public function registroU($id)
    {
            $user = DB::table('usuarios')->where('id', $id)->first();
    
            
            if (!$user) {
                return redirect('/users')->with('error', 'Usuario no encontrado');
            }
            $saludo = 'Perfil del Administrador';
    
            return view('RegistrarUsuario' , compact('user','saludo'));
            
        }    
    

        public function authenticate() {
            $validator = Validator::make(request()->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);
        
            if ($validator->passes()) {
                if (Auth::attempt(['email' => request()->email, 'password' => request()->password])) {
                    $user = Auth::user();
                    $user = Usuario::with('rol')->find($user->id);
        
                    // Verifica si el usuario está inactivo
                    if ($user->estado === 'Inactivo') {
                        Auth::logout();  // Cierra la sesión si el usuario está inactivo
                        return redirect()->route('account.login')->with('error', 'Tu cuenta está inactiva. Contacta al administrador.');
                    }
        
                    if ($user && $user->rol) {
                        switch ($user->rol->nombre_rol) {
                            case 'admin':
                                return redirect()->intended(route('account.dashboardAdmin', ['id' => $user->id]))
                                    ->with('success', 'Inicio de Sesión realizado con éxito');
                            case 'empleado':
                                return redirect()->intended(route('account.dashboardEmpleado', ['id' => $user->id]))
                                    ->with('success', 'Inicio de Sesión realizado con éxito');
                            case 'cliente':
                                return redirect()->intended(route('account.dashboard', ['id' => $user->id]))
                                    ->with('success', 'Inicio de Sesión realizado con éxito');
                            default:
                                return redirect()->intended(route('account.dashboard', ['id' => $user->id]))
                                    ->with('success', 'Inicio de Sesión realizado con éxito');
                        }
                    } else {
                        return redirect()->route('account.login')->with('error', 'Usuario no autenticado.');
                    }
                } else {
                    return redirect()->route('account.login')->with('error', 'Email o contraseña incorrectos');
                }
            } else {
                return redirect()->route('account.login')
                    ->withInput()
                    ->withErrors($validator);
            }
        }
        
    
    

    public function register(){
        return view('register');
    }

    public function processRegistration(){
        $validator = Validator::make(request()->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/|unique:usuarios', 
            'password' => 'required|string|min:8|confirmed', 
        ], [
            'email.regex' => 'El correo electrónico debe ser una dirección Gmail válida.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ]);

        if ($validator->passes()) {
            $user = new Usuario();
            $user->name = request()->name;
            $user->email = request()->email;
            $user->password = Hash::make(request()->password);
            $user->id_roles = 1;
            $user->save();

            $persona = new Persona();
            $persona->id_usuario = $user->id; 
            $persona->nombres = $user->name;
            $persona->correo_electronico = $user->email;
            $persona->save();

            return redirect()->route('account.login')->with('success', 'Tu registro se realizó con éxito');
        } else {
            return redirect()->route('account.register')
                ->withInput()
                ->withErrors($validator);
        }
    }

    public function processRegistrationAdmin() {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/|unique:usuarios',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:1,2' 
        ], [
            'email.regex' => 'El correo electrónico debe ser una dirección Gmail válida.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
            'role.required' => 'Debe seleccionar un rol válido.',
            'role.in' => 'El rol seleccionado no es válido.',
        ]);
    
        if ($validator->passes()) {

            $user = new Usuario();
            $user->name = request()->name;
            $user->email = request()->email;
            $user->password = Hash::make(request()->password);
            $user->estado = 'Activo';
            $user->id_roles = request()->role; 
            $user->save();
    
            $persona = new Persona();
            $persona->id_usuario = $user->id; 
            $persona->nombres = $user->name;
            $persona->correo_electronico = $user->email;
            $persona->save();
    
           
            return redirect()->route('usuarios.listar', ['id' => Auth ::user()->id])->with('success', 'Usuario registrado exitosamente');
        } else {
            return redirect()->route('account.registerU', ['id' => Auth ::user()->id]) ->with('error', 'Registro de usuario no se pudo efectuar')
                ->withInput()
                ->withErrors($validator);
        }
    }
    
    public function logout(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('account.login');
    }
}
