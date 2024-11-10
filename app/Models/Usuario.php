<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Authenticatable 
{
    use HasFactory;

    protected $table = 'usuarios';
      protected $primaryKey = 'id';

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_roles','id_roles');
    }
    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(
            Producto::class,    // Modelo relacionado (Producto)
            'favoritos',        // Nombre de la tabla intermedia
             'id_usuario',       // Foreign key del usuario en la tabla intermedia 'favoritos'
            'id_producto'       // Foreign key del producto en la tabla intermedia 'favoritos'
        );
    }
}
