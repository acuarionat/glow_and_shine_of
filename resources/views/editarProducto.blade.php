<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/registrarProducto.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>Editar Producto</title>
</head>

<body>
    <h2 class="titulo_producto">Editar Producto</h2>
    <x-Mikaela.botonesAccionProducto />

    <div class="container">



        <form action="{{ route('producto.update', $producto->id_producto) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- <h2>Registrar Imagen producto</h2>
    <div class="registro_imagen_producto">
    <label for="direccion_imagen">Dirección de la Imagen:</label>
    <input type="text" id="direccion_imagen" name="direccion_imagen" class="llenar" value="{{ $producto->direccion_imagen }}">

    <label for="descripcion_imagen">Descripción de la Imagen:</label>
    <input type="text" id="descripcion_imagen" name="descripcion_imagen" class="llenar" value="{{ $producto->descripcion_imagen }}">
</div> -->

            <h2>Registrar Información producto</h2>
            <div class="registro_info_producto">
                <label for="nombre">Nombre del Producto:</label>
                <input type="text" id="nombre" name="nombre" class="llenar" value="{{ $producto->nombre }}">

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" class="llenar">{{ $producto->descripcion }}</textarea>

                <label for="id_precio_mercado">ID Precio Mercado:</label>
                <input type="number" id="id_precio_mercado" name="id_precio_mercado" class="llenar" value="{{ $producto->id_precio_mercado }}">

                <label for="recomendaciones_uso">Recomendaciones de Uso:</label>
                <textarea id="recomendaciones_uso" name="recomendaciones_uso" class="llenar">{{ $producto->recomendaciones_uso }}</textarea>

                <label for="marca">Marca:</label>
                <input type="text" id="marca" name="marca" class="llenar" value="{{ $producto->marca }}">

                <label for="categoria">Categoría:</label>
                <input type="text" id="categoria" name="categoria" class="llenar" value="{{ $producto->categoria }}">

                <label for="color">Color:</label>
                <input type="text" id="color" name="color" class="llenar" value="{{ $producto->color }}">

                <label for="presentacion">Presentación:</label>
                <input type="text" id="presentacion" name="presentacion" class="llenar" value="{{ $producto->presentacion }}">

                <label for="estado">Estado:</label>
                <input type="text" id="estado" name="estado" class="llenar" value="{{ $producto->presentacion }}">

                <label for="id_lote">ID Lote:</label>
                <input type="number" id="id_lote" name="id_lote" class="llenar" value="{{ $producto->id_lote }}">

                <label for="id_detalle_medida">ID Detalle Medida:</label>
                <input type="number" id="id_detalle_medida" class="llenar" name="id_detalle_medida" value="{{ $producto->id_detalle_medida }}">

                <label for="id_proveedor">ID Proveedor:</label>
                <input type="number" id="id_proveedor" class="llenar" name="id_proveedor" value="{{ $producto->id_proveedor }}">

                <label for="cantidad">Cantidad:</label>
                <input type="number" id="cantidad" class="llenar" name="cantidad" value="{{ $producto->cantidad }}">
            </div>
            <button type="submit" class="boton_busqueda">Actualizar Producto</button>
        </form>
    </div>