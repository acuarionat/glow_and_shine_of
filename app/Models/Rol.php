<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $primaryKey = 'id_roles';
    public function permisos()
    {
        return $this->belongsToMany(Permiso::class, 'rol_permiso', 'id_roles', 'id_permisos');
    }
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'id_roles', 'id_roles'); 
    }
}
