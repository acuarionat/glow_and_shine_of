<link rel="stylesheet" href="{{ asset('css/perfilAdministrador.css') }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<x-app-layout-AdministradorDash :saludo="$saludo" :user="$user">
    <section class="contenedorDashAdmin">
         <x-Natalia.listaUsuarios  :user="$user" :usuarios="$usuarios"/> 
    </section>
</x-app-layout-AdministradorDash >
@if(session('success'))
<script>
Swal.fire({
    title: 'Registro exitoso',
    text: '{{ session('success') }}',
    icon: 'success',
    confirmButtonText: 'Aceptar',
    customClass: {
        popup: 'custom-popup', 
        confirmButton: 'custom-confirm-button' 
    }
});

</script>
@endif

@if(session('error'))
<script>
Swal.fire({
    title: 'Error de Registro',
    text: '{{ session('error') }}',
    icon: 'error',
    confirmButtonText: 'Aceptar',
    customClass: {
        popup: 'custom-popup', 
        confirmButton: 'custom-confirm-button' 
    }
});


</script>
@endif
