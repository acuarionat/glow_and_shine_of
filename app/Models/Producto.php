<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto'; // Nombre de la tabla
    protected $primaryKey = 'id_producto';

    // Relación inversa (muchos a muchos) con Usuario
    public function users()
    {
        return $this->belongsToMany(
            Usuario::class,    // Modelo relacionado (Usuario)
            'favoritos',       // Nombre de la tabla intermedia
            'id_producto',     // Foreign key del producto en la tabla intermedia 'favoritos'
            'id_usuario'       // Foreign key del usuario en la tabla intermedia 'favoritos'
        );
    }
}