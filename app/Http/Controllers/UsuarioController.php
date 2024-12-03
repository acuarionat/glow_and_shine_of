<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Usuario;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Exports\UsuariosExport;
use Maatwebsite\Excel\Facades\Excel;


class UsuarioController extends Controller
{
    public function listarUsuarios($id)
    {
        $user = Usuario::with('rol')->find($id);
    
        if (!$user) {
            return redirect('/users')->with('error', 'Usuario no encontrado');
        }
    
        $usuarios = Usuario::join('roles', 'usuarios.id_roles', '=', 'roles.id_roles')
            ->select('usuarios.id', 'usuarios.name', 'usuarios.email', 'usuarios.created_at', 'roles.nombre_rol as rol_name', 'usuarios.estado')
            ->paginate(10); 
    
        $saludo = match ($user->rol->nombre_rol) {
            'empleado' => 'Perfil de Empleado',
            'admin' => 'Perfil del Administrador',
            default => 'Perfil de Usuario'
        };
    
        return view('usuariosLista', compact('user', 'saludo', 'usuarios'));
    }

    public function cambiarEstado($id)
    {
        $usuario = Usuario::find($id);
    
        if (!$usuario) {
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }
    
        $nuevoEstado = $usuario->estado === 'Activo' ? 'Inactivo' : 'Activo';
        $usuario->estado = $nuevoEstado;
        $usuario->save();
    
        return redirect()->back()->with('success', "Estado del usuario cambiado a $nuevoEstado");
    }
    

    public function busqueda_usuario(Request $request, $id)
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
    
        $busqueda = $request->input('busqueda');
        $usuarios = Usuario::join('roles', 'usuarios.id_roles', '=', 'roles.id_roles')
        ->select('usuarios.id', 'usuarios.name', 'usuarios.email', 'usuarios.created_at', 'roles.nombre_rol as rol_name', 'usuarios.estado')
        ->when($busqueda, function ($query, $busqueda) {
            return $query->where('usuarios.name', 'like', '%' . $busqueda . '%')
                ->orWhere('usuarios.email', 'like', '%' . $busqueda . '%')
                ->orWhere('roles.nombre_rol', 'like', '%' . $busqueda . '%')
                ->orWhere('usuarios.estado', 'like', $busqueda . '%');
        })
        ->paginate(10)
        ->appends($request->only('busqueda'));
       
        return view('usuariosLista', compact('user', 'saludo', 'usuarios'));
    }
    
    public function GenerarPDF(Request $request)
    {
        $query = Usuario::with('rol');
    
        if ($request->filled('rol')) {
            $query->whereHas('rol', function ($query) use ($request) {
                $query->where('nombre_rol', $request->rol);
            });
        }
    
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }
    
        if ($request->filled('search')) {
            $query->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%')
                      ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }
    
        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('created_at', [
                Carbon::parse($request->fecha_inicio)->startOfDay(),
                Carbon::parse($request->fecha_fin)->endOfDay(),
            ]);
        }
    
        $usuarios = $query->get();
        $usuariosPorPagina = 30;
        $paginas = $usuarios->chunk($usuariosPorPagina);

  
    
        $pdf = PDF::loadView('usuariospdf.pdf', compact('paginas'))
                  ->setPaper('letter'); 
    
        return $pdf->download('reporte_usuarios_filtrado.pdf');
    }

  public function GenerarExcel(Request $request)
{
    $query = Usuario::with('rol');

    if ($request->filled('rol')) {
        $query->whereHas('rol', function ($query) use ($request) {
            $query->where('nombre_rol', $request->rol);
        });
    }

    if ($request->filled('estado')) {
        $query->where('estado', $request->estado);
    }

    if ($request->filled('search')) {
        $query->where(function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
        });
    }

    if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
        $query->whereBetween('created_at', [
            Carbon::parse($request->fecha_inicio)->startOfDay(),
            Carbon::parse($request->fecha_fin)->endOfDay(),
        ]);
    }
    $query = Usuario::with('rol');
    $usuarios = $query->get();

    return Excel::download(new UsuariosExport($usuarios), 'reporte_usuarios_filtrado.xlsx');
}

public function listarUsuariosRep($id)
{
    $user = Usuario::with('rol')->find($id);

    if (!$user) {
        return redirect('/users')->with('error', 'Usuario no encontrado');
    }

    $usuarios = Usuario::join('roles', 'usuarios.id_roles', '=', 'roles.id_roles')
        ->select('usuarios.id', 'usuarios.name', 'usuarios.email', 'usuarios.created_at', 'roles.nombre_rol as rol_name', 'usuarios.estado')
        ->paginate(10); 

    $saludo = match ($user->rol->nombre_rol) {
        'empleado' => 'Perfil de Empleado',
        'admin' => 'Perfil del Administrador',
        default => 'Perfil de Usuario'
    };

    return view('repUsuarios', compact('user', 'saludo', 'usuarios'));
}

public function busquedaUsuarioRep(Request $request, $id)
{
    $user = Usuario::with('rol')->find($id);

    if (!$user) {
        return redirect('/users')->with('error', 'Usuario no encontrado');
    }

    $saludo = match ($user->rol->nombre_rol ?? 'default') {
        'empleado' => 'Perfil de Empleado',
        'admin' => 'Perfil del Administrador',
        default => 'Perfil de Usuario',
    };

    $query = Usuario::query()->join('roles', 'usuarios.id_roles', '=', 'roles.id_roles')
        ->select('usuarios.id', 'usuarios.name', 'usuarios.email', 'usuarios.created_at', 'roles.nombre_rol as rol_name', 'usuarios.estado');

    if ($request->filled('busqueda')) {
        $query->where(function ($q) use ($request) {
            $q->where('usuarios.name', 'like', '%' . $request->busqueda . '%')
              ->orWhere('usuarios.email', 'like', '%' . $request->busqueda . '%');
        });
    }

    if ($request->filled('rol')) {
        $query->where('roles.nombre_rol', $request->rol);
    }

    if ($request->filled('estado')) {
        $query->where('usuarios.estado', $request->estado);
    }

    if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
        $query->whereBetween('usuarios.created_at', [$request->fecha_inicio, $request->fecha_fin]);
    }

    $usuarios = $query->paginate(10);

    $usuarios->appends($request->all());

    return view('repUsuarios', compact('usuarios', 'saludo', 'user'));
}
    
}
