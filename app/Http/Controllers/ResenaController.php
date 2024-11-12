<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Resena;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;




class ResenaController extends Controller
{

    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'id_producto' => 'required|exists:producto,id_producto',
            'rating' => 'required|integer|min:1|max:5',
            'comentario' => 'required|string',
        ]);
    
        $usuario = Auth::user();

        if (!$usuario) {
            return redirect()->back()->with('info', 'Debes registrarte para realizar una reseña.');
        }

        $reseña = Resena::where('id_usuario', $usuario->id)
                        ->where('id_producto', $request->id_producto)
                        ->first();
        
        if ($reseña) {
            $reseña->calificacion = $request->rating;
            $reseña->comentario = $request->comentario;
            $reseña->fecha_resena = now(); 
            $reseña->save();  
            return redirect()->back()->with('success', '¡Tu reseña ha sido actualizada!');
        }
        
        $reseña = new Resena();
        $reseña->id_producto = $request->id_producto;
        $reseña->id_usuario = $usuario->id; 
        $reseña->calificacion  = $request->rating;
        $reseña->comentario = $request->comentario;
        $reseña->fecha_resena = now(); 
        $reseña->save();
    
        return redirect()->back()->with('success', '¡Gracias por tu reseña!');
    }
 
}
