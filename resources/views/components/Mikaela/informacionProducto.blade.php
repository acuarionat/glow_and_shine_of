<link rel="stylesheet" href="{{ asset('css/informacionProducto.css') }}">

<div class="contenedor_descripcion_productos">
    <h4 class="texto_subtitulos_productos">Tono disponible:</h4>
    <h4 class="texto_contenido_subtitulos">{{ $producto->color }}</h4>
    <h4 class="texto_subtitulos_productos">Descripción</h4>
    <h4 class="texto_contenido_subtitulos">{{ $producto->descripcion }}</h4>
</div>