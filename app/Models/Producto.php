<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto'; 
    protected $primaryKey = 'id_producto';
    protected $fillable = [
        'id_producto',
        'nombre',
        'id_precio_mercado',
        'descripcion',
        'recomendaciones_uso',
        'marca',
        'categoria',
        'color',
        'presentacion',
        'estado',
        'id_lote',
        'id_imagen_producto',
        'id_detalle_medida',
        'id_proveedor',
        'cantidad',
    ];

    public function imagenProducto()
    {
        return $this->belongsTo(ImagenProducto::class, 'id_imagen_producto');
    }

    // Relación inversa (muchos a muchos) con Usuario
    public function users()
    {
        return $this->belongsToMany(
            Usuario::class,    
            'favoritos',      
            'id_producto',    
            'id_usuario'       
        );
    }
}