<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/productoDetalle.css') }}">
    <title>{{ $producto->nombre_producto }}</title>
</head>

<body>
<h2 class="titulo_producto">Ver Producto</h2>
<x-Mikaela.botonesAccionProducto/>
    
    <div class="contenedor_total_producto">

        <div class="contenedor_detalle_producto">
        <img src="{{ $producto->imagen_producto }}" alt="{{ $producto->nombre_producto }}" class="producto_catalogo">
        </div>
        <div class="contenedor_informacion_producto">
            <h4 class="texto_subtitulos_productos">Nombre producto:</h4>
            <h4 class="texto_contenido_subtitulos">{{ $producto->nombre_producto}}</h4>
            <h4 class="texto_subtitulos_productos">Precio:</h4>
            <h4 class="texto_contenido_subtitulos">{{ $producto->precio }}</h4>
            <h4 class="texto_subtitulos_productos">Cantidad:</h4>
            <h4 class="texto_contenido_subtitulos">{{ $producto->cantidad }}</h4>
            <h4 class="texto_subtitulos_productos">Color:</h4>
            <h4 class="texto_contenido_subtitulos">{{ $producto->color }}</h4>
            <h4 class="texto_subtitulos_productos">Descripción</h4>
            <h4 class="texto_contenido_subtitulos">{{ $producto->descripcion }}</h4>
            <h4 class="texto_subtitulos_productos">Recomendacion</h4>
            <h4 class="texto_contenido_subtitulos">{{ $producto->recomendacion }}</h4>
        </div>
    </div>
</body>

</html>