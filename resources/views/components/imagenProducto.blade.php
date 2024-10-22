<link rel="stylesheet" href="{{ asset('css/imagenProducto.css') }}">

@if(isset($producto))
<div class="contenedor_imagen_producto">
    <img src="{{ $producto->direccion_imagen }}" alt="{{ $producto->nombre }}" class="imagen_producto">
</div>
@else
<p>Producto no encontrado</p>
@endif