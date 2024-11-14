<link rel="stylesheet" href="{{ asset('css/perfilAdministrador.css') }}">


<x-app-layout-AdministradorDash :saludo="$saludo" :user="$user">
    <section class="contenedorDashAdmin">
         <x-Claudia.modClientes.listaClientes :clientes="$clientes" :user="$user"/> 
    </section>
</x-app-layout-AdministradorDash >
</section>

@if(session('success'))
<script>
    Swal.fire({
        title: 'Registro exitoso',
        text: "{{ session('success') }}",
        icon: 'success',
        confirmButtonText: 'Aceptar',
        customClass: {
            popup: 'custom-popup',
            confirmButton: 'custom-confirm-button'
        }
    });
</script>
@endif
