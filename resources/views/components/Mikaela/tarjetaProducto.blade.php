<link rel="stylesheet" href="{{ asset('css/tarjetaProducto.css') }}">
<link rel="stylesheet" href="{{ asset('css/botonAnadirListaDeseos.css') }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
             @php
                $isFavorite = Auth::check() ? Auth::user()->favorites()->where('favoritos.id_producto', $producto->id_producto)->exists() : false;
            @endphp
            
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
            </div>
        </a>
    </div>
    @if(session('info'))
    <script>
        Swal.fire({
            title: 'Información',
            text: "{{ session('info') }}",  // Cambié las comillas
            icon: 'info',
            confirmButtonText: 'Aceptar',
            customClass: {
                popup: 'custom-popup', 
                confirmButton: 'custom-confirm-button' 
            }
        });
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            title: 'Error',
            text: "{{ session('error') }}",  // Cambié las comillas
            icon: 'error',
            confirmButtonText: 'Aceptar',
            customClass: {
                popup: 'custom-popup', 
                confirmButton: 'custom-confirm-button' 
            }
        });
    </script>
@endif

@if(session('success'))
    <script>
        Swal.fire({
            title: 'Éxito',
            text: "{{ session('success') }}",  // Cambié las comillas
            icon: 'success',
            confirmButtonText: 'Aceptar',
            customClass: {
                popup: 'custom-popup', 
                confirmButton: 'custom-confirm-button' 
            }
        });
    </script>
@endif