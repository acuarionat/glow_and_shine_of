<link rel="stylesheet" href="{{ asset('css/nombrePrecio.css') }}">
<div class="contenedor_nombre_producto_especifico">
    <h1 class="nombre_producto_especifico">{{ $producto->nombre_producto }}</h1>
    <h2 class="precio_producto">Bs.{{ $producto->precio_mercado }}</h2>
</div>