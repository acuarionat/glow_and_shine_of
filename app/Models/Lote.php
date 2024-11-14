<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    use HasFactory;

    protected $table = 'lote'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id_lote'; // Llave primaria

    public $timestamps = false; // Si la tabla no tiene columnas 'created_at' y 'updated_at'

    protected $fillable = [
        'id_lote',
        'codigo_lote',
        'fecha_produccion',
        'fecha_vencimiento'
    ];
    
    // Relación con la tabla 'sub_parametros'
    public function producto()
    {
        return $this->hasMany(Producto::class, 'id_lote');
    }
}
