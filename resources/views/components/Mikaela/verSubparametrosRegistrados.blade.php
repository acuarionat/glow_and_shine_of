<link rel="stylesheet" href="{{ asset('css/verSubparametrosRegistrados.css') }}">
<div class="contenedor_tabla_subparametros">
    <div class="cotenedor_lista_e">
        <h2 class="seccion_forms">Listado de Sub-parametros</h2>
    </div>
    <div class="contenedor_tabla_empleados">

        <div class="contenedor_datos2">
            <h3 class="subtitulo_Info" for="id_parametros">Parámetro:</h3>
            <select name="id_parametros" id="id_parametros" class="edit_informacion" required>
                <option value="">Seleccione un parámetro</option>
                @foreach($categorias as $categoria)
                <option value="{{ $categoria->id_parametros }}">{{ $categoria->nombre_parametro }}</option>
                @endforeach
            </select>

        </div>
        <table class="estilo_tabla" id="subparametros-table">
            <thead>
                <tr class="encabezado_table">
                    <th>ID</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                <!-- Se llenará dinámicamente -->
            </tbody>
        </table>

    </div>


</div>