<link rel="stylesheet" href="{{ asset('css/perfilAdministrador.css') }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<x-app-layout-AdministradorDash :saludo="$saludo" :user="$user">
    <section class="contenedorDashAdmin">
         <x-Natalia.listaUsuariosRep  :user="$user" :usuarios="$usuarios"/> 
    </section>
</x-app-layout-AdministradorDash >