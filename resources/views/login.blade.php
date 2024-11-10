<link rel="stylesheet" href="{{ asset('css/inicioSesion.css') }}">
<x-app-layout-log-reg>
        <x-Natalia.inicioSesion.cabecera/>
        <x-Natalia.inicioSesion.formulario-inicio-sesion/>
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


</x-app-layout-log-reg>
