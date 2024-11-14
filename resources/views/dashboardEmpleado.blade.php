<link rel="stylesheet" href="{{ asset('css/perfilAdministrador.css') }}">


<x-app-layout-EmpleadosDash :saludo="$saludo" :user="$user">
    <section class="contenedorDashAdmin">
         <x-Claudia.pageContentEmpleados :saludo="$saludo" 
         :user="$user" 
         :mensajeB="$mensajeB" 
         :cantidadDatos="$cantidadDatos" /> 
    </section>
</x-app-layout-EmpleadosDash >
