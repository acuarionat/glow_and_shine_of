<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/registrarProducto.css') }}">
        <!-- Agrega los enlaces necesarios para SweetAlert -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>Registrar Producto</title>
</head>

<body>
    <h2 class="titulo_producto">Registrar Productos</h2>
    <x-Mikaela.botonesAccionProducto />

    <div class="container">
        <h2>Registrar Imagen producto</h2>
        <form action="{{ route('producto.store') }}" method="POST">
            @csrf
            <div class="registro_imagen_producto">
                <label for="direccion_imagen">Dirección de Imagen:</label>
                <input type="text" name="direccion_imagen"  class="llenar" id="direccion_imagen" required>
                <label for="descripcion_imagen">Descripción de Imagen:</label>
                <textarea name="descripcion_imagen" class="llenar" id="descripcion_imagen"></textarea>

            </div>

            <h2>Registrar Información producto</h2>
            <div class="registro_info_producto">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre"class="llenar" id="nombre" required>

                <label for="id_precio_mercado">ID Precio Mercado:</label>
                <input type="number" name="id_precio_mercado" class="llenar" id="id_precio_mercado">
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" id="descripcion" class="llenar"></textarea>

                <label for="recomendaciones_uso">Recomendaciones de Uso:</label>
                <textarea name="recomendaciones_uso" id="recomendaciones_uso" class="llenar"></textarea>

                <label for="marca">Marca:</label>
                <input type="number" name="marca" id="marca" class="llenar">

                <label for="categoria">Categoría:</label>
                <input type="number" name="categoria" id="categoria" class="llenar">

                <label for="color">Color:</label>
                <input type="number" name="color" id="color" class="llenar">

                <label for="presentacion">Presentación:</label>
                <input type="number" name="presentacion" id="presentacion" class="llenar">

                <label for="estado">Estado:</label>
                <input type="number" name="estado" id="estado" class="llenar">

                <label for="id_lote">ID Lote:</label>
                <input type="number" name="id_lote" id="id_lote" class="llenar">

                <label for="id_detalle_medida">ID Detalle Medida:</label>
                <input type="number" name="id_detalle_medida" id="id_detalle_medida" class="llenar">

                <label for="id_proveedor">ID Proveedor:</label>
                <input type="number" name="id_proveedor" id="id_proveedor" class="llenar">

                <label for="cantidad">Cantidad:</label>
                <input type="number" name="cantidad" id="cantidad" class="llenar">
            </div>

            <button type="submit" class="boton_busqueda">Guardar Producto</button>

        </form>
    </div>

