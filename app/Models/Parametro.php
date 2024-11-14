<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    use HasFactory;

    protected $table = 'parametros'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id_parametros'; // Llave primaria

    public $timestamps = false; // Si la tabla no tiene columnas 'created_at' y 'updated_at'

    protected $fillable = [
        'nombre_parametro',
        'abreviacion',
        'descripcion',
        'estado',
        'fecha_creacion',
        'id_user_creacion'
    ];
    
    // Relación con la tabla 'sub_parametros'
    public function subparametros()
    {
        return $this->hasMany(Subparametro::class, 'id_parametros');
    }
}
