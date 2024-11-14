<link rel="stylesheet" href="{{ asset('css/informacionPE.css') }}">
@props(['user'])
<div class="contenedor_perfil">
    <h1 class="titulo_ip">INFORMACIÓN PERSONAL</h1>
    <div class="container_informacion">

        <!-- <label for="name">Nombre</label> -->
        <p class="info_name">{{ $user->name }}</p> <!-- Mostrar el nombre del usuario -->

        <!-- <label for="email">Correo Electrónico</label> -->
        <p class="info_email">{{ $user->email }}</p>


    </div>
    <div class="contenedor_opcion">
       <a href="{{ url('editarPerfil/' . $user->id ) }}" class="editar_cuenta">Editar información</a>
    </div>
</div>