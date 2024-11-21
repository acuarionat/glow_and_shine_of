<link rel="stylesheet" href="{{ asset('css/tarjetaProductoEmpleado.css') }}">

<div class="contenedor_tarjeta_empleado">
<a href="{{ url('productoDetalle/' . auth()->user()->id . '/' . $producto->id_producto) }}">
    <div class="contenedor_imagen_tarjeta_empleado">
    <img src="{{ $producto->imagen_producto }}" alt="{{ $producto->nombre_producto }}" class="producto_catalogo">
    </div>
    <div class="contenedor_general_producto">
        <div class="contenedor_producto_1">
            <h2 class="titulo_producto">{{ $producto->nombre_producto }}</h2>
        </div>
        <div class="contenedor_producto_2">
            <h2 class="subtitulos_producto">ID Producto:</h2>
            <h2 class="info_producto">{{ $producto->id_producto }}</h2>
            <h2 class="subtitulos_producto">Color:</h2>
            <h2 class="info_producto">{{ $producto->color }}</h2>
            <h2 class="subtitulos_producto">Precio:</h2>
            <h2 class="info_producto">{{ $producto->precio}}</h2>
            <h2 class="subtitulos_producto">Marca:</h2>
            <h2 class="info_producto">{{ $producto->marca }}</h2>
            <h2 class="subtitulos_producto">Estado:</h2>
            <h2 class="info_producto">{{ $producto->estado }}</h2>
            <h2 class="subtitulos_producto">Disponibles:</h2>
            <h2 class="info_producto">{{ $producto->cantidad }}</h2>
        </div>
        <div class="contenedor_producto_3">
    <a href="{{ url('producto/' . auth()->user()->id . '/' . $producto->id_producto) . '/edit'}}" class="boton_actualizar">Editar</a>
</div>

    </div>
    </a>
</div>


