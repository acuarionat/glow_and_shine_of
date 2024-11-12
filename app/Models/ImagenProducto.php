<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagenProducto extends Model
{
    protected $table = 'imagen_producto';  // Especifica la tabla si no coincide con el nombre del modelo

    protected $primaryKey = 'id_imagen_producto';  // Define la clave primaria

    public $incrementing = true;  // Asegúrate de que autoincrementa
    public $timestamps = false;
    protected $fillable = [
        'id_imagen_producto',  // Permitir la asignación manual de este campo
        'direccion_imagen',
        'descripcion_imagen',
    ];

    public function producto()
    {
        return $this->hasOne(Producto::class, 'id_imagen_producto');
    }
}
