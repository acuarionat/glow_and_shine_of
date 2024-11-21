
<link rel="stylesheet" href="{{ asset('css/listaEmpleados.css') }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<section class="container_lista_empleados">
    <div class="contenedor_Tmostrar">
        <div class="cotenedor_lista_e">
            <h1>LISTA DE EMPLEADOS</h1>
        </div>
        <div class="contenedor_busqueda">
            <form class="formulario_busqueda" id="formularioBusqueda" action="{{ route('empleados.busqueda_empleado', ['id' => $user->id]) }}" method="GET">
                
                <i class="fas fa-search fa-fw" id="iconoBuscar" style="cursor: pointer;" onclick="document.getElementById('formularioBusqueda').submit();"></i>
                <input class="buscar_empleado" type="text" name="busqueda"  placeholder="Nombre del empleado" required>

            </form>
        </div>
    </div>
           
    
    <div class="contenedor_tabla_empleados">
        <table class="estilo_tabla">
            <thead>
                <tr class="encabezado_table">
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Fecha contratación</th>
                    <th>Salario (Bs)</th>
                    <th>Turno</th>
                    <th>Opciones</th>
                    <th>Detalles</th>
                </tr>
            </thead>
            <tbody>
                @foreach($empleados as $empleado)
                    <tr class="text-center">
                        <td>{{ $empleado->id_empleado }}</td> 
                        <td>{{ $empleado->nombres }}</td>
                        <td>{{ $empleado->fecha_contratacion }}</td>
                        <td>{{ $empleado->salario }}</td>
                        <td>{{ $empleado->turno }}</td>
                        <td><a href="{{ url('editarPerfil/' . $user->id . '/' . $empleado->id_empleado) }}" class="editar_cuenta">Editar información</a></td>
                        <td><a href="{{ url('mostrarDetalles/' . $user->id . '/' . $empleado->id_empleado) }}" class="editar_cuenta">Mostrar más</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    

</section>

