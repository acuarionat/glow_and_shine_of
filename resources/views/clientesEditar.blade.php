<link rel="stylesheet" href="{{ asset('css/perfilAdministrador.css') }}">


<x-app-layout-AdministradorDash :saludo="$saludo" :user="$user">
    <section class="contenedorDashAdmin">
         <x-Claudia.modClientes.formularioEditarInfoClientes :clientes="$clientes" :user="$user"/> 
    </section>
</x-app-layout-AdministradorDash >
