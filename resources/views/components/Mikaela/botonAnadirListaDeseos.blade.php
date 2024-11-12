{{-- <link rel="stylesheet" href="{{ asset('css/botonAnadirListaDeseos.css') }}">

@php
    $isFavorite = Auth::check() ? Auth::user()->favorites()->where('favoritos.id_producto', $producto->id_producto)->exists() : false;
@endphp

<!-- Corazón bordado o lleno -->
@if ($isFavorite)
    <form action="{{ route('favorites.remove', $producto->id_producto) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-link">
            <i class="fas fa-heart heart liked"></i> <!-- Corazón lleno -->
        </button>
    </form>
@else
    <form action="{{ route('favorites.add', $producto->id_producto) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-link">
            <i class="far fa-heart heart"></i> <!-- Corazón bordeado -->
        </button>
    </form>
@endif
 --}}