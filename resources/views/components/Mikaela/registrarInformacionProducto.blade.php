<link rel="stylesheet" href="{{ asset('css/registrarProducto.css') }}">

<div class="contenedor_registrar_editar_producto">

    <form action="{{ route('producto.store', ['id' => $user->id]) }}" method="POST">
        @csrf
        <h2 class="seccion_forms">Registrar Imagen producto</h2>
        <div class="registro_imagen_producto">
            <div class="contenedor_datos">
                <h3 class="subtitulo_Info">Subir Imagen del Producto:</h3>
                <input type="file" name="imagen" id="imagen" class="edit_informacion" accept="image/png, image/jpeg" onchange="previewImage(event)">
            </div>
            <div class="contenedor_imagen_previsualizacion">
                <div id="preview-container">
                    <img id="preview" src="#" alt="Previsualización de imagen" style=" width: 200px; height: auto; border: 1px solid #ccc;">
                </div>
                <input type="hidden" name="url_imagen" id="url_imagen">
            </div>
            <script>
                // Previsualización de imagen
                function previewImage(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const preview = document.getElementById('preview');
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                        };
                        reader.readAsDataURL(file);
                    }
                }
            </script>
            <script>
                document.getElementById('imagen').addEventListener('change', function(event) {
                    const formData = new FormData();
                    formData.append('imagen', event.target.files[0]);

                    fetch('{{ route("upload.image") }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.url) {
                                document.getElementById('url_imagen').value = data.url;
                                // alert('Imagen subida correctamente.');
                            } else {
                                alert('Error al subir la imagen: ' + (data.error || 'desconocido'));
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('No se pudo subir la imagen.');
                        });
                });
            </script>


        </div>

        <h2 class="seccion_forms">Registrar Información producto</h2>
        <div class="registro_info_producto">
            <div class="contenedor_datos">
                <h3 class="subtitulo_Info">Nombre del Producto:</h3>
                <input type="text" name="nombre" class="edit_informacion" id="nombre" placeholder="Ingrese Nombre del Producto" required>
            </div>

            <div class="contenedor_datos">
                <h3 class="subtitulo_Info">Descripcion del producto:</h3>
                <textarea name="descripcion" id="descripcion" class="edit_informacion" placeholder="Ingrese descripcion del producto"></textarea>
            </div>
            <div class="contenedor_datos">
                <h3 class="subtitulo_Info">Recomendaciones de Uso:</h3>
                <textarea name="recomendaciones_uso" id="recomendaciones_uso" class="edit_informacion" placeholder="Ingrese recomendaciones"></textarea>
            </div>
            <div class="contenedor_datos">
                <h3 class="subtitulo_Info">Seleccione una marca:</h3>
                <select name="marca" id="marca" class="edit_informacion">
                    @foreach ($subparametrosMarca as $subparametro)
                    <option value="{{ $subparametro->id_sub_parametros }}">{{ $subparametro->descripcion }}</option>
                    @endforeach
                </select>
            </div>

            <div class="contenedor_datos">
                <h3 class="subtitulo_Info">Seleccione una categoría:</h3>
                <select name="categoria" id="categoria" class="edit_informacion">
                    @foreach ($subparametrosCategorias as $subparametro)
                    <option value="{{ $subparametro->id_sub_parametros }}">{{ $subparametro->descripcion }}</option>
                    @endforeach
                </select>
            </div>
            <div class="contenedor_datos">
                <h3 class="subtitulo_Info">Seleccione un color:</h3>

                <select name="color" id="color" class="edit_informacion">
                    @foreach ($subparametrosColor as $subparametro)
                    <option value="{{ $subparametro->id_sub_parametros }}">{{ $subparametro->descripcion }}</option>
                    @endforeach
                </select>
            </div>
            <div class="contenedor_datos">
                <h3 class="subtitulo_Info">Seleccione una presentación:</h3>
                <select name="presentacion" id="presentacion" class="edit_informacion">
                    @foreach ($subparametrosPresentacion as $subparametro)
                    <option value="{{ $subparametro->id_sub_parametros }}">{{ $subparametro->descripcion }}</option>
                    @endforeach
                </select>
            </div>
            <div class="contenedor_datos">
                <h3 class="subtitulo_Info">Seleccione el estado del producto:</h3>
                <select name="estado" id="estado" class="edit_informacion">
                    @foreach ($subparametrosEstado as $subparametro)
                    <option value="{{ $subparametro->id_sub_parametros }}">{{ $subparametro->descripcion }}</option>
                    @endforeach
                </select>
            </div>

            <div class="contenedor_datos">
                <h3 class="subtitulo_Info">Seleccione un Lote:</h3>
                <select name="id_lote" id="id_lote" class="edit_informacion">
                    @foreach ($lote as $lotes)
                    <option value="{{ $lotes->id_lote }}">{{ $lotes->codigo_lote}}</option>
                    @endforeach
                </select>
            </div>

            <div class="contenedor_datos">
                <h3 class="subtitulo_Info">Seleccione un proveedor:</h3>
                <select name="id_proveedor" id="id_proveedor" class="edit_informacion">
                    @foreach ($proveedores as $proveedor)
                    <option value="{{ $proveedor->id_proveedor }}">{{ $proveedor->empresa_proveedor }}</option>
                    @endforeach
                </select>
            </div>
            <div class="contenedor_datos">
                <h3 class="subtitulo_Info">Cantidad:</h3>
                <input type="number" name="cantidad" id="cantidad" class="edit_informacion" placeholder="Ingrese cantidad">
            </div>

            <div class="contenedor_datos">
                <h3 class="subtitulo_Info">Precio:</h3>
                <input type="text" name="precio" class="edit_informacion" id="precio" placeholder="Ingrese el precio del producto" required>
            </div>
            <div class="contenedor_datos">
                <h3 class="subtitulo_Info">Detalle del contenido:</h3>
                <input type="text" name="detalle_medida" class="edit_informacion" id="detalle_medida" placeholder="Ingrese contenido" required>
            </div>
        </div>
        <div class="boton_guardar_actualizar_productos">
            <button type="submit" class="boton_busqueda">Guardar Producto</button>
        </div>
    </form>
</div>