<?php

namespace App\Http\Controllers;

use App\Models\Usuario; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavoritoController extends Controller
{
   public function addToFavorites($productId)
{
    $user = Usuario::with('favorites')->find(Auth::id()); // Usamos Auth::id() para obtener el ID del usuario autenticado

    if (!$user) {
        return redirect()->back()->with('info', 'Debes registrarte para agregar productos a favoritos.');
    }

    $isFavorite = $user->favorites()->wherePivot('id_producto', $productId)->exists();

    if ($isFavorite) {
        return redirect()->back()->with('error', 'Este producto ya está en tu lista de favoritos.');
    }

    $user->favorites()->attach($productId);

    return redirect()->back()->with('success', 'Producto agregado a favoritos.');
}
public function removeFromFavorites($productId)
{
    $user = Usuario::with('favorites')->find(Auth::id());

 
    $user->favorites()->detach($productId);

    return redirect()->back()->with('success', 'Producto eliminado de tus favoritos.');
}



}

