<link rel="stylesheet" href="{{ asset('css/registrarProducto.css') }}">
<div class="contenedor_registrar_editar_producto">
    <form action="{{ route('producto.update', ['id_user' => $user->id, 'id' => $producto->id_producto]) }}" method="POST">
        @csrf
        @method('PUT')
        <h2 class="seccion_forms">Editar Imagen producto</h2>
        <div class="registro_imagen_producto">
            <div class="contenedor_datos">
                <h3 class="subtitulo_Info">URL de la Imagen:</h3>
                <input type="text" name="direccion_imagen" class="edit_informacion" id="direccion_imagen" value="{{ old('direccion_imagen', $imagenProducto->direccion_imagen ?? '') }}" required>
            </div>
            <div class="contenedor_datos">
                <h3 class="subtitulo_Info">Descripción de la imagen:</h3>
                <textarea name="descripcion_imagen" class="edit_informacion" id="descripcion_imagen">{{ old('descripcion_imagen', $imagenProducto->descripcion_imagen ?? '') }}</textarea>
            </div>
        </div>

        <h2 class="seccion_forms">Editar Información producto</h2>
        <div class="registro_info_producto">
            <div class="contenedor_datos">
                <h3 class="subtitulo_Info">Nombre del Producto:</h3>
                <input type="text" name="nombre" class="edit_informacion" id="nombre" value="{{ $producto->nombre }}" required>
            </div>

            <div class="contenedor_datos">
                <h3 class="subtitulo_Info">Descripcion del producto:</h3>
                <textarea name="descripcion" id="descripcion" class="edit_informacion">{{ $producto->descripcion }}</textarea>
            </div>
            <div class="contenedor_datos">
                <h3 class="subtitulo_Info">Recomendaciones de Uso:</h3>
                <textarea name="recomendaciones_uso" id="recomendaciones_uso" class="edit_informacion">{{ $producto->recomendaciones_uso }}</textarea>
            </div>
            <div class="contenedor_datos">
                <h3 class="subtitulo_Info">Seleccione una marca:</h3>
                <select name="marca" id="marca" class="edit_informacion">
                    @foreach ($subparametrosMarca as $subparametro)
                    <option value="{{ $subparametro->id_sub_parametros }}" @selected($producto->marca == $subparametro->id_sub_parametros)>
                        {{ $subparametro->descripcion }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="contenedor_datos">
                <h3 class="subtitulo_Info">Seleccione una categoría:</h3>
                <select name="categoria" id="categoria" class="edit_informacion">
                    @foreach ($subparametrosCategorias as $subparametro)
                    <option value="{{ $subparametro->id_sub_parametros }}" @selected($producto->categoria == $subparametro->id_sub_parametros)>
                        {{ $subparametro->descripcion }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="contenedor_datos">
                <h3 class="subtitulo_Info">Seleccione un color:</h3>
                <select name="color" id="color" class="edit_informacion">
                    @foreach ($subparametrosColor as $subparametro)
                    <option value="{{ $subparametro->id_sub_parametros }}" @selected($producto->color == $subparametro->id_sub_parametros)>
                        {{ $subparametro->descripcion }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="contenedor_datos">
                <h3 class="subtitulo_Info">Seleccione una presentación:</h3>
                <select name="presentacion" id="presentacion" class="edit_informacion">
                    @foreach ($subparametrosPresentacion as $subparametro)
                    <option value="{{ $subparametro->id_sub_parametros }}" @selected($producto->presentacion == $subparametro->id_sub_parametros)>
                        {{ $subparametro->descripcion }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="contenedor_datos">
                <h3 class="subtitulo_Info">Seleccione el estado del producto:</h3>
                <select name="estado" id="estado" class="edit_informacion">
                    @foreach ($subparametrosEstado as $subparametro)
                    <option value="{{ $subparametro->id_sub_parametros }}" @selected($producto->estado == $subparametro->id_sub_parametros)>
                        {{ $subparametro->descripcion }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="contenedor_datos">
                <h3 class="subtitulo_Info">Seleccione un Lote:</h3>
                <select name="id_lote" id="id_lote" class="edit_informacion">
                    @foreach ($lote as $lotes)
                    <option value="{{ $lotes->id_lote }}" @selected($producto->id_lote == $lotes->id_lote)>
                        {{ $lotes->codigo_lote }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="contenedor_datos">
                <h3 class="subtitulo_Info">Seleccione un proveedor:</h3>
                <select name="id_proveedor" id="id_proveedor" class="edit_informacion">
                    @foreach ($proveedores as $proveedor)
                    <option value="{{ $proveedor->id_proveedor }}" @selected($producto->id_proveedor == $proveedor->id_proveedor)>
                        {{ $proveedor->empresa_proveedor }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="contenedor_datos">
                <h3 class="subtitulo_Info">Cantidad:</h3>
                <input type="number" name="cantidad" id="cantidad" class="edit_informacion" value="{{ $producto->cantidad }}">
            </div>

            <div class="contenedor_datos">
                <h3 class="subtitulo_Info">Precio:</h3>
                <input type="text" name="precio" class="edit_informacion" id="precio" value="{{ $producto->precio }}" placeholder="Ingrese el precio del producto" required>
            </div>
            <div class="contenedor_datos">
                <h3 class="subtitulo_Info">Detalle del contenido:</h3>
                <input type="text" name="detalle_medida" class="edit_informacion" id="detalle_medida" value="{{ $producto->detalle_medida }}" placeholder="Detalle del contenido" required>
            </div>
        </div>
        <div class="boton_guardar_actualizar_productos">
            <button type="submit" class="boton_busqueda">Guardar Producto</button>
        </div>

    </form>
</div>