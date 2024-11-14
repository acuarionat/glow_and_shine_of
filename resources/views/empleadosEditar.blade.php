<link rel="stylesheet" href="{{ asset('css/perfilAdministrador.css') }}">
<link rel="stylesheet" href="{{ asset('css/editarInfoClient.css') }}">

<x-app-layout-AdministradorDash :saludo="$saludo" :user="$user">
    <section class="contenedorDashAdmin">
         <x-Claudia.modEmpleados.formularioEditarInfoEmpleados :empleados="$empleados" :user="$user"/> 
    </section>
</x-app-layout-AdministradorDash >
