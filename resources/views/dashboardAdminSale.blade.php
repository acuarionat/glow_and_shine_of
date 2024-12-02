<link rel="stylesheet" href="/css/perfilAdministrador.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<x-app-layout-AdministradorDash :saludo="$saludo" :user="$user">
    <section class="contenedorDashAdmin">
         <x-Aldahir.ManagmentSale :user="$user"/> 
    </section>
</x-app-layout-AdministradorDash>

