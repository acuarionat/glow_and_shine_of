<link rel="stylesheet" href="{{ asset('css/perfilAdministrador.css') }}">

<x-app-layout-AdministradorDash :saludo="$saludo" :user="$user">
<section class="contenedorDashAdmin">
        <x-Natalia.inicioSesion.formulario-registro-admin/>
      </section>
  </x-app-layout-AdministradorDash >