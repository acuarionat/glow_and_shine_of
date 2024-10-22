<link rel="stylesheet" href="{{ asset('css/nombrePrecio.css') }}">
<div class="contenedor_nombre_producto_especifico">
    <h1 class="nombre_producto_especifico">{{ $producto->nombre }}</h1>
    <h2 class="precio_producto">Bs.{{ $producto->precio }}</h2>
</div>