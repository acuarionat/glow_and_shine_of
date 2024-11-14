<link rel="stylesheet" href="/css/perfilAdministrador.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/js/buscarProducto.js"></script>
<script src="/js/ciPersona.js"></script>
<script src="/js/registrarTablaVenta.js"></script>

<x-app-layout-AdministradorDash :saludo="$saludo" :user="$user">
    <section class="contenedorDashAdmin">
         <x-Aldahir.ManagmentSale :user="$user"/> 
    </section>
</x-app-layout-AdministradorDash>

