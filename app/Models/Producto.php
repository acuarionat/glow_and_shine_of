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
        'precio',
        'descripcion',
        'recomendaciones_uso',
        'marca',
        'categoria',
        'color',
        'presentacion',
        'estado',
        'id_lote',
        'url_imagen',
        'detalle_medida',
        'id_proveedor',
        'cantidad',
        'precio'
    ];


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