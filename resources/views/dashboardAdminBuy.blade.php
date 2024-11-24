<link rel="stylesheet" href="/css/perfilAdministrador.css">

<x-app-layout-AdministradorDash :saludo="$saludo" :user="$user">
    <section class="contenedorDashAdmin">
         <x-Aldahir.ManagmentBuy :user="$user"/> 
    </section>
</x-app-layout-AdministradorDash>