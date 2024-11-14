<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subparametro extends Model
{
    use HasFactory;

    protected $table = 'sub_parametros'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id_sub_parametros'; // Llave primaria

    public $timestamps = false; // Si la tabla no tiene columnas 'created_at' y 'updated_at'

    protected $fillable = [
        'id_parametros',
        'descripcion'
    ];

    // Relación con la tabla 'parametros'
    public function parametro()
    {
        return $this->belongsTo(Parametro::class, 'id_parametros');
    }
}
