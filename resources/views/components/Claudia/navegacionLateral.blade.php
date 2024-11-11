<link rel="stylesheet" href="{{ asset('css/navLateral.css') }}">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

    <div class="contenedor_nav_lateral">
        <div class="logo_empresa">
            <img src="{{ asset('images/logosis.png') }}" alt="Logo">
            <h1 class="nombre_empresa">G&S System</h1>

        </div>
        <div class="contenedor-opcioness">
            <x-Claudia.opcionesNavLateral/>

        </div>
    
    </div>