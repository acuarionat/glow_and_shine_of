<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/imagenProducto.css') }}">
    <title>{{ $producto->nombre_producto ?? 'Producto' }}</title>
</head>

<body>
    @if(isset($producto))
    <div class="contenedor_imagen_producto">
        <img src="{{ $producto->imagen_producto }}" alt="{{ $producto->nombre_producto }}" class="imagen_producto">
    </div>
    @else
    <p>Producto no encontrado</p>
    @endif
</body>

</html>
