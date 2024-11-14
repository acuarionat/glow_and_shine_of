<link rel="stylesheet" href="{{ asset('css/opcionesEmpleado.css') }}">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

@props(['titulo', 'imagen', 'cantidad'])

<div class="contenedor_opciones_dashboard">
    <div class="primera_seccion">
        <h1 class="titulo">{{ $titulo }}</h1>
        <img class="imagen_button" src="{{ asset($imagen) }}" alt="">
    </div>
    <div class="segunda_seccion">
        <p class="detalles">{{ $cantidad }} Registrados</p>
    </div>
</div>