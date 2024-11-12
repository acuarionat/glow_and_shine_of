<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto'; 
    protected $primaryKey = 'id_producto';

    // Relación inversa (muchos a muchos) con Usuario
    public function users()
    {
        return $this->belongsToMany(
            Usuario::class,    
            'favoritos',      
            'id_producto',    
            'id_usuario'       
        );
    }
}