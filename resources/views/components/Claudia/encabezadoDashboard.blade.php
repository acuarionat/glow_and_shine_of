<link rel="stylesheet" href="{{ asset('css/encabezadoDashboard.css') }}">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<div class="encabezado_p">
    <div class="toggle_btn" onclick="toggleNav()">
        <i class="fa-solid fa-bars"></i>
    </div>
    
    <h1 class="saludo">
        {{$saludo}} {{ $user->name }}
    </h1>
        
    
     <div class="cerrar_s">
            <a href="" class="action_btn">
                <i class="fas fa-user-cog"></i> <!-- Ícono de perfil -->
            </a>
            <a href="{{route('account.logout')}}" class="action_btn">
                <i class="fas fa-power-off"></i>
            </a>
    </div>
</div>

    <div class="contenedor_nav_lateral">
        <div class="logo_empresa">
            <img src="{{ asset('images/logosis.png') }}" alt="Logo">
            <h1 class="nombre_empresa">G&S System</h1>

        </div>
        <div class="contenedor-opcioness">
            <x-Claudia.opcionesNavLateral/>

        </div>
    
    </div>

<script>
    function toggleNav() {
        const navLateral = document.querySelector('.contenedor_nav_lateral');
        const encabezado = document.querySelector('.encabezado_p');

        const content = document.querySelector('.contenedorDashAdmin');

        navLateral.classList.toggle('visible');
        encabezado.classList.toggle('push');  

        content.classList.toggle('push');
    }
</script>
