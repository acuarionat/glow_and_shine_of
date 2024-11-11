<link rel="stylesheet" href="{{ asset('css/perfilAdministrador.css') }}">


<x-app-layout-AdministradorDash :saludo="$saludo" :user="$user">
    <section class="contenedorDashAdmin">
         <x-Claudia.pageContent :saludo="$saludo" :user="$user" :mensajeB="$mensajeB" :cantidad="$cantidad" /> 
    </section>
</x-app-layout-AdministradorDash >
