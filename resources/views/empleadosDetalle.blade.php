<link rel="stylesheet" href="{{ asset('css/perfilAdministrador.css') }}">


<x-app-layout-AdministradorDash :saludo="$saludo" :user="$user">
    <section class="contenedorDashAdmin">
         <x-Claudia.modEmpleados.mostrarDetallesE :empleados="$empleados" :user="$user" :datosAcademicos="$datosAcademicos"/> 
    </section>
</x-app-layout-AdministradorDash >
