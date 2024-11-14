<link rel="stylesheet" href="{{ asset('css/perfilAdministrador.css') }}">


<x-app-layout-AdministradorDash :saludo="$saludo" :user="$user">
    <section class="contenedorDashAdmin">
         <x-Claudia.modCClientes.registrarCClientes /> 
    </section>
</x-app-layout-AdministradorDash >
