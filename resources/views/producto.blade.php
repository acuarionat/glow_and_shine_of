<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('css/producto.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>{{ $producto->nombre_producto }}</title>
</head>

<body>
    <x-app-layout>
     
        <div class="contenedor_total_producto">
            <div class="contenedor_detalle_producto">
                <x-imagenProducto :producto="$producto" />
                <div class="contenedor_informacion_producto">
                    <x-Mikaela.nombrePrecio :producto="$producto" />
                    <x-Mikaela.informacionProducto :producto="$producto" />
                    <x-Mikaela.botonAnadirListaDeseos :producto="$producto" />
@if(session('info'))
    <script>
        Swal.fire({
            title: 'Información',
            text: "{{ session('info') }}",  // Cambié las comillas
            icon: 'info',
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
            title: 'Error',
            text: "{{ session('error') }}",  // Cambié las comillas
            icon: 'error',
            confirmButtonText: 'Aceptar',
            customClass: {
                popup: 'custom-popup', 
                confirmButton: 'custom-confirm-button' 
            }
        });
    </script>
@endif

@if(session('success'))
    <script>
        Swal.fire({
            title: 'Éxito',
            text: "{{ session('success') }}",  // Cambié las comillas
            icon: 'success',
            confirmButtonText: 'Aceptar',
            customClass: {
                popup: 'custom-popup', 
                confirmButton: 'custom-confirm-button' 
            }
        });
    </script>
@endif
                </div>
            </div>
        </div>
        <x-Aldahir.TSubtitle>
            <span>★</span> DÉJANOS TU COMENTARIO <span>★</span>
        </x-Aldahir.TSubtitle>
        <div class="contenedor_total_producto">
            <x-Mikaela.calificaProducto :producto="$producto"/>
        </div>
        <x-Aldahir.TSubtitle>
            <span>★</span> RESEÑAS DEL PRODUCTO <span>★</span>
        </x-Aldahir.TSubtitle>
        <x-Aldahir.ScrollReview :resenas="$resenas" />
    </x-app-layout>
   

</body>

</html>