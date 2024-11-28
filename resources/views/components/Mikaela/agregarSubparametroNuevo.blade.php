<link rel="stylesheet" href="{{ asset('css/verSubparametrosRegistrados.css') }}">
<form action="{{ route('categorias.subparametros.store', ['id' => $user->id]) }}" method="POST">
    @csrf

    <div  class="contenedor_tabla_subparametros">
    <div class="cotenedor_lista_e">
        <h2 class="seccion_forms">Agregar Nuevo Sub-parametro</h2>
    </div>
    <div class="contenedor_tabla_empleados">
    <div class="contenedor_datos2">
        <h3 class="subtitulo_Info" for="id_parametros_form">Categoría:</h3>
    <select class="edit_informacion" name="id_parametros" id="id_parametros_form" required>
        <option value="">Seleccione una categoría</option>
        @foreach($categorias as $categoria)
        <option value="{{ $categoria->id_parametros }}">{{ $categoria->nombre_parametro }}</option>
        @endforeach
    </select>

        </div>
    <div class="contenedor_datos2">
    <h3 class="subtitulo_Info" for="descripcion">Descripción:</h3>
    <input class="edit_informacion" type="text" name="descripcion" id="descripcion" maxlength="100" required>

    </div>
    </div>
       
    <div class="boton_guardar_actualizar_productos">
            <button type="submit" class="boton_busqueda">Guardar</button>
        </div>
    </div>
    
</form>
