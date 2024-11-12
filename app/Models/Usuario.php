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
            Producto::class,   
            'favoritos',        
             'id_usuario',       
            'id_producto'       
        );
    }

    public function resenas()
    {
        return $this->hasMany(Resena::class, 'id_usuario');
    }
}
