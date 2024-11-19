<link rel="stylesheet" href="{{ asset('css/contenidoInformacionProducto.css') }}">
<div class="contenedor_total_producto">
    <div class="contenedor_detalle_producto">
        <img src="{{ $producto->imagen_producto }}" alt="{{ $producto->nombre_producto }}" class="producto_catalogo">
    </div>
    <div class="contenedor_informacion_producto">
        <h4 class="texto_subtitulos_productos">Nombre producto:</h4>
        <h4 class="texto_contenido_subtitulos">{{ $producto->nombre_producto}}</h4>
        <h4 class="texto_subtitulos_productos">Precio:</h4>
        <h4 class="texto_contenido_subtitulos">{{ $producto->precio }} Bs.</h4>
        <h4 class="texto_subtitulos_productos">Cantidad:</h4>
        <h4 class="texto_contenido_subtitulos">{{ $producto->cantidad }} Unidades</h4>
        <h4 class="texto_subtitulos_productos">Color:</h4>
        <h4 class="texto_contenido_subtitulos">{{ $producto->color }}</h4>
        <h4 class="texto_subtitulos_productos">Descripción</h4>
        <h4 class="texto_contenido_subtitulos">{{ $producto->descripcion }}</h4>
        <h4 class="texto_subtitulos_productos">Recomendacion</h4>
        <h4 class="texto_contenido_subtitulos">{{ $producto->recomendacion }}</h4>

    </div>