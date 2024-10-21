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
    
    
    <!-- <button class="Registrar">Registrar venta </button>
    <button class="Catalogo">Ver catalogo</button>
    <button class="Crear_cuenta">Crear cuenta de usuario</button>
    <button class="Crear_cuenta_e">Crear cuenta de empleado</button>
    <button class="Lista_e">Lista de empleados</button>
    <button class="Anadir_p">Añadir producto</button> -->
</div>