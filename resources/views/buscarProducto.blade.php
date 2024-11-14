<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/buscarProducto.css') }}">
    <title>Buscar Producto</title>
</head>

<body>

<div class="contenedor_buscador_general">
<h2 class="titulo_producto">Buscar Productos</h2>

<div class="contenedor_catalogo">
    <div class="contenedor_busqueda">
        <form id="buscarProducto" action="{{ route('buscarProducto') }}" method="GET">
            <i class="fas fa-search fa-fw" id="iconoBuscar" style="cursor: pointer;" onclick="document.getElementById('buscarProducto').submit();"></i>
                <input class="buscar_empleado" type="text" name="search" class = "edit_info" placeholder="Busque un producto" value="{{ request('search') }}">
            </form>
        </div>
   

    <div class="contenedor_catalogo_productos">
        @foreach($productos as $producto)
            <x-Mikaela.tarjetaProductoEmpleado :producto="$producto" />
        @endforeach
    </div>
</div>

</div>

</body>

</html>