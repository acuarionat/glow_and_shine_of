<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/moduloProducto.css') }}">
<title>Buscar Producto</title>


<x-app-layout-AdministradorDash :saludo="$saludo" :user="$user">
    <section class="contenedorDashAdmin">
        <x-Mikaela.inputBuscarProducto :user="$user" />
        <div class="contenedor_buscador_general">
            @foreach($productos as $producto)
            <x-Mikaela.tarjetaProductoEmpleado :producto="$producto" />
            @endforeach
        </div>
    </section>
</x-app-layout-AdministradorDash>