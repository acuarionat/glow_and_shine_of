<link rel="stylesheet" href="/css/Banner.css">

<div class="header_banner">
    <img src="https://richellebeauty.com/wp-content/uploads/2020/07/richelle-beauty-banner1.jpg" alt="Banner Image">
    {{-- <img src="{{ asset('imagenes/chiaPortada.png') }}" alt=""> --}}
    <div class="header_content">
        <h1>Bienvenido a Glow & Shine</h1>
        <p>Tu tienda de confianza.</p>
        @if (Auth::check())
       
    @else
    <x-Aldahir.Button>
        Iniciar Sesión
    </x-Aldahir.Button>
    @endif
       
    </div>
</div>
