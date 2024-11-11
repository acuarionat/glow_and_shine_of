<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'persona';
    const CREATED_AT = 'fecha_registro'; 
    const UPDATED_AT = null; 

    protected $fillable = ['id_usuario', 'nombres', 'correo_electronico']; 

    public function usuario() {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}
