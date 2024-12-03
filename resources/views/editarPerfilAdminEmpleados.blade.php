
<link rel="stylesheet" href="{{ asset('css/perfilAdministrador.css') }}">


<x-app-layout-AdministradorDash :saludo="$saludo" :user="$user">
    <section class="contenedorDashAdmin">
        <x-Claudia.formEditInfoPersonalAdminE :persona="$persona" :datosAcademicos="$datosAcademicos"/>
    </section>
</x-app-layout-AdministradorDash >
