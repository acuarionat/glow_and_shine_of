<link rel="stylesheet" href="{{ asset('css/tarjetaProducto.css') }}">
    <div class="contenedor_tarjeta">
        <a href="/producto/{{ $producto->id_producto }}">
            <div class="contenedor_imagen_tarjeta">
                <img src="{{ $producto->direccion_imagen }}" alt="{{ $producto->nombre_producto }}" class="producto_catalogo">
            </div>
            <div class="contenedor_nombre_producto">
                <h3 class="nombre_producto_tarjeta">{{ $producto->nombre_producto }}</h3>
            </div>
            <div class="contenedor_precio_producto">
                <h3 class="precio_producto_tarjeta">Bs. {{ $producto->precio_mercado}}</h3>
            </div>
        </a>
    </div>