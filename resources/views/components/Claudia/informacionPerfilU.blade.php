<link rel="stylesheet" href="{{ asset('css/informacionPU.css') }}">
@props(['user']) 
<div class="container_informacion">

    <!-- <label for="name">Nombre</label> -->
    <p class="info_name">{{ $user->name }}</p> <!-- Mostrar el nombre del usuario -->
    
    <!-- <label for="email">Correo Electrónico</label> -->
    <p class="info_email">{{ $user->email }}</p>
   <!--  <label for="1">Nombre</label>
    <p>Apellido Paterno</p>
    <p>Apellido Materno</p>
    <p>Correo electronico</p>
    <p>fecha de nacimiento</p> -->
        
   
</div>