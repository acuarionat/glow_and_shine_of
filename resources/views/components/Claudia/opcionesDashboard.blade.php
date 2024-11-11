<link rel="stylesheet" href="{{ asset('css/opcionesDashboard.css') }}">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<div class="contenedor_opciones_administrador">
    <a href="#">
        <div class="primera_seccion">
            <h1 class="titulo">{{ $titulo }}</h1>
            <img class="imagen_button" src="{{ asset($imagen) }}" alt="">
        </div>
        <div class="segunda_seccion">
            <p class="detalles">{{ $cantidad}}</p>
        </div>

    </a>
    
</div>