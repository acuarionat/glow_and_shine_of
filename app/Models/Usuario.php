<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Authenticatable 
{
    use HasFactory;

    protected $table = 'usuarios';

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_roles','id_roles');
    }
}
