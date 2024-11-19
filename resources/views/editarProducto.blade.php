<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/moduloProducto.css') }}">
<!-- Agrega los enlaces necesarios para SweetAlert -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<title>Editar Producto</title>
<x-app-layout-AdministradorDash :saludo="$saludo" :user="$user">
    <section class="contenedorDashAdmin">
        <x-Mikaela.editarInformacionProducto
            :user="$user"
            :producto="$producto"
            :imagenProducto="$imagenProducto"
            :subparametrosMarca="$subparametrosMarca"
            :subparametrosCategorias="$subparametrosCategorias"
            :subparametrosColor="$subparametrosColor"
            :subparametrosPresentacion="$subparametrosPresentacion"
            :subparametrosEstado="$subparametrosEstado"
            :lote="$lote"
            :proveedores="$proveedores" />
    </section>
</x-app-layout-AdministradorDash>

@if(session('success'))
<script>
    Swal.fire({
        title: 'Cambios guardados',
        text: '{{ session("success") }}',
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
        title: 'Error al guardar cambios',
        text: '{{ session("error") }}',
        icon: 'error',
        confirmButtonText: 'Aceptar',
        customClass: {
            popup: 'custom-popup',
            confirmButton: 'custom-confirm-button'
        }
    });
</script>
@endif