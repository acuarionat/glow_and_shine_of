<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/buscarProducto.css') }}">
</head>

<body>

<div class="contenedor_buscador_general">
<h2 class="titulo_producto">Buscar Productos</h2>
<x-Mikaela.botonesAccionProducto/>

<div class="contenedor_catalogo">
    <div class="contenedor_buscador">
    <form method="GET" action="{{ route('buscarProducto') }}">
        <input type="text" name="search" class = "edit_info" placeholder="Buscar productos" value="{{ request('search') }}">
        <button type="submit" class="boton_busqueda">Buscar</button>
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