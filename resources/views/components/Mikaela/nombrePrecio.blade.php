<link rel="stylesheet" href="{{ asset('css/nombrePrecio.css') }}">
<link rel="stylesheet" href="{{ asset('css/botonAnadirListaDeseos.css') }}">

<div class="contenedor_nombre_producto_especifico">
    <div class="cora">
    <h1 class="nombre_producto_especifico">{{ $producto->nombre_producto }}</h1>
    @php
    $isFavorite = Auth::check() ? Auth::user()->favorites()->where('favoritos.id_producto', $producto->id_producto)->exists() : false;
@endphp

@if ($isFavorite)
<form  action="{{ route('favorites.remove', $producto->id_producto) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-link">
        <i class="fas fa-heart heart liked"></i> 
    </button>
</form>
@else
<form  action="{{ route('favorites.add', $producto->id_producto) }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-link">
        <i class="far fa-heart heart"></i> 
    </button>
</form>
@endif
</div>
    <h2 class="precio_producto">Bs.{{ $producto->precio_mercado }}</h2>
</div>