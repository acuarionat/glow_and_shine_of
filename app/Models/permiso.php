<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permiso extends Model
{
    use HasFactory;

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'rol_permiso', 'id_roles', 'id_roles');
    }
}
