<link rel="stylesheet" href="{{ asset('css/mensajeBienvenida.css') }}">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<div class="mensaje_contenedor">
    <h1 class="encabezado_B">
        ¡Bienvenida, {{ $user->name }}!
    </h1>
    <p class="mensaje_B">
        {{$mensajeB}}
    </p>
</div>