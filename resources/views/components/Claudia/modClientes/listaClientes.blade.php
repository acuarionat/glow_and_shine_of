
<link rel="stylesheet" href="{{ asset('css/listaEmpleados.css') }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>

    .pagination .page-item .page-link {
        background-color: whitesmoke; 
        color: #c26abc; 
        border-radius: 5px;
    }
    .pagination {
    display: flex;  
    list-style-type: none;  
    flex-direction: row;
    padding: 0;
    margin: 0;
}

    .pagination .page-item.active .page-link {
        background-color: #764C73; 
        border-color: #764C73;
        color: white;
    }
</style>
<section class="container_lista_empleados">
    <div class="contenedor_Tmostrar">
        <div class="cotenedor_lista_e">
            <h1>LISTA DE CLIENTES</h1>
        </div>
        <div class="contenedor_busqueda">
            <form class="formulario_busqueda" id="formularioBusqueda" action="{{ route('cliente.busqueda_cliente', ['id' => $user->id]) }}" method="GET">
                
                <i class="fas fa-search fa-fw" id="iconoBuscar" style="cursor: pointer;" onclick="document.getElementById('formularioBusqueda').submit();"></i>
                <input class="buscar_empleado" type="text" name="busqueda"  placeholder="Parametro deseado" required>


            </form>
        </div>
    </div>
           
    
    <div class="contenedor_tabla_empleados">
        <table class="estilo_tabla">
            <thead>
                <tr class="encabezado_table">
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Tipo Cliente</th>
                    <th>Porcentaje Descuento(%)</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clientes as $cliente)
                    <tr class="text-center">
                        <td>{{ $cliente->id_cliente }}</td> 
                        <td>{{ $cliente->nombres }}</td>
                        <td>{{ $cliente->tipo_cliente }}</td>
                        <td>{{ $cliente->porcentaje_descuento }}</td>
                        <td><a href="{{ url('editarPerfilCliente/' . $user->id . '/' . $cliente->id_cliente) }}" class="editar_cuenta">Editar información</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <div class="pagination">
        {{ $clientes->links('pagination::bootstrap-4') }} 
    </div>
</section>

@if(session('success'))
<script>
    Swal.fire({
        title: 'Actualizacion Exitosa',
        text: "{{ session('success') }}",
        icon: 'success',
        confirmButtonText: 'Aceptar',
        customClass: {
            popup: 'custom-popup',
            confirmButton: 'custom-confirm-button'
        }
    });
</script>
@endif


</section>

