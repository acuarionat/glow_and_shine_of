<link rel="stylesheet" href="{{ asset('css/perfilAdministrador.css') }}">

<x-app-layout-sesion>
    <section class="container_perfil_administrador">
        <x-Claudia.encabezadoPerfil :saludo="$saludo" :user="$user"/>
        <x-Claudia.mensajeBienvenida :mensajeB="$mensajeB" :user="$user"/>
        <x-Claudia.informacionPerfilU :user="$user"/>
        <x-Claudia.editarPerfil :user="$user"/>
        <x-Claudia.opcionesAdministrador/>   
    </section>
</x-app-layout-sesion>