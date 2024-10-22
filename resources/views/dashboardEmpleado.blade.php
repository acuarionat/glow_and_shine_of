
    <link rel="stylesheet" href="{{ asset('css/perfilEmpleado.css') }}">

    <x-app-layout-sesion>
        <section class="container_perfil_empleado">
            <x-Claudia.encabezadoPerfil :saludo="$saludo" :user="$user"/>
            <x-Claudia.mensajeBienvenida :mensajeB="$mensajeB" :user="$user"/>
            <x-Claudia.informacionPerfilU :user="$user"/>
            <x-Claudia.editarPerfil :user="$user"/>
            <x-Claudia.opcionesEmpleado/>   
        </section>
    </x-app-layout-sesion>

