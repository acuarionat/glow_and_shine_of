<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto'; 
    protected $primaryKey = 'id_producto';
    public $timestamps = false;

  
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
        'precio',
        'detalle_medida'
    ];

    public function imagenProducto()
    {
        return $this->belongsTo(ImagenProducto::class, 'id_imagen_producto');
    }

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