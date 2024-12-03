@props(['user', 'usuarios'])

<link rel="stylesheet" href="{{ asset('css/listaUsuarios.css') }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
<section class="container_lista_usuarios">
    <div class="contenedor_Tmostrar">
        <div class="cotenedor_lista_u">
            <h1>LISTA DE USUARIOS</h1>
        </div>
        <div class="contenedor_busqueda">
            <form class="formulario_busqueda" id="formularioBusqueda" action="{{ route('usuarios.busqueda_usuario', ['id' => auth()->user()->id]) }}" method="GET">
                <i class="fas fa-search fa-fw" id="iconoBuscar" style="cursor: pointer;" onclick="document.getElementById('formularioBusqueda').submit();"></i>
                <input class="buscar_usuario" type="text" name="busqueda" placeholder="Parametro deseado" required>
            </form>
        </div>
    </div>
    
    <div class="contenedor_tabla_usuarios">
        <table class="estilo_tabla">
            <thead>
                <tr class="encabezado_table">
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                <tr class="text-center">
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>
                        @if ($usuario->rol_name == 'admin')
                            administrador
                        @else
                            {{ $usuario->rol_name }}
                        @endif
                    </td>
                <td>
                    @if ($usuario->rol_name == 'admin')
                  
                    @else
                    <form action="{{ route('cambiarEstado', $usuario->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" 
                            class="btn btn-sm estado-btn {{ $usuario->estado === 'Activo' ? 'btn-success' : 'btn-danger' }}">
                            {{ $usuario->estado }}
                        </button>
                    </form>
                    @endif 
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
              
    </div>
    <div class="mt-3 d-flex justify-content-center">
        {{ $usuarios->links('pagination::bootstrap-4') }}
    </div>
</section>
