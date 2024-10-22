<link rel="stylesheet" href="{{ asset('css/editarPerfilUsuario.css') }}">

<x-app-layout-sesion>
    <section class="container_perfil_usuario">
        <x-Claudia.encabezadoPerfil :saludo="$saludo" :user="$user"/>
        <x-Claudia.formularioEditarInfo :user="$user"/>   
    </section>
</x-app-layout-sesion>