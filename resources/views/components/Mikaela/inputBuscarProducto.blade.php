<link rel="stylesheet" href="{{ asset('css/inputBuscarProducto.css') }}">
<div class="contenedor_barra_busqueda">
    <div class="contenedor_busqueda_producto">
        <form class="formulario_busqueda_producto" id="buscarProducto" action="{{ route('buscarProducto', ['id' => $user->id]) }}" method="GET">
            <i class="fas fa-search fa-fw" id="iconoBuscar" style="cursor: pointer;" onclick="document.getElementById('buscarProducto').submit();"></i>
            <input class="buscar_producto" type="text" name="search" placeholder="Buscar un producto" value="{{ request('search') }}">
        </form>
    </div>
</div>
