<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    use HasFactory;

    protected $table = 'proveedores'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id_proveedor'; // Llave primaria

    public $timestamps = false; // Si la tabla no tiene columnas 'created_at' y 'updated_at'

    protected $fillable = [
        'id_proveedor',
        'id_persona',
        'empresa_proveedor',
        'fecha_inicio_relacion_comercial',
        'condiciones_pago',
        'tipo_proveedor'
    ];
    
    // Relación con la tabla 'sub_parametros'
    public function producto()
    {
        return $this->hasMany(Producto::class, 'id_proveedor');
    }
}
