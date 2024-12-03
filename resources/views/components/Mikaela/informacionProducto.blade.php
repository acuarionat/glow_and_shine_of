<link rel="stylesheet" href="{{ asset('css/informacionProducto.css') }}">

<div class="contenedor_descripcion_productos">
    <div class="informacion_datos_producto">
        <h4 class="texto_subtitulos_productos">Tono disponible:</h4>
        <h4 class="texto_contenido_subtitulos">{{ $producto->color }}</h4>
        <h4 class="texto_subtitulos_productos">Marca:</h4>
        <h4 class="texto_contenido_subtitulos">{{ $producto->marca}}</h4>
        <h4 class="texto_subtitulos_productos">Presentación:</h4>
        <h4 class="texto_contenido_subtitulos">{{ $producto->presentacion}}</h4>
        <h4 class="texto_subtitulos_productos">Contenido:</h4>
        <h4 class="texto_contenido_subtitulos">{{ $producto->detalle_medida}}</h4>
    </div>


    <h4 class="texto_subtitulos_productos_largo">Descripción</h4>
    <h4 class="texto_contenido_subtitulos">{{ $producto->descripcion }}</h4>
    <h4 class="texto_subtitulos_productos_largo">Recomendaciones de uso:</h4>
    <h4 class="texto_contenido_subtitulos">{{ $producto->recomendacion }}</h4>
</div>