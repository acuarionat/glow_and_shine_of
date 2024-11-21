<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<title>Registrar Producto</title>
<link rel="stylesheet" href="{{ asset('css/moduloProducto.css') }}">

<x-app-layout-AdministradorDash :saludo="$saludo" :user="$user">
    <section class="contenedorDashAdmin">
        <x-Mikaela.registrarInformacionProducto
            :user="$user"
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
        title: 'Producto Registrado',
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
        title: 'Error de Registro',
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