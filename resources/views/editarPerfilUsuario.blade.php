<link rel="stylesheet" href="{{ asset('css/editarPerfilUsuario.css') }}">

<x-app-layout-Usuarios>
    <section class="container_perfil_usuario">
        <x-Claudia.encabezadoPerfil :saludo="$saludo" :user="$user"/>
        <x-Claudia.formularioEditarInfo :persona="$persona"/>
        
        
    </section>
</x-app-layout-Usuarios>