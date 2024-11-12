@props(['user', 'usuarios'])

<link rel="stylesheet" href="{{ asset('css/listaUsuarios.css') }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<section class="container_lista_usuarios">
    <div class="contenedor_Tmostrar">
        <div class="cotenedor_lista_u">
            <h1>LISTA DE USUARIOS</h1>
        </div>
        <div class="contenedor_busqueda">
            <form class="formulario_busqueda" id="formularioBusqueda" action="{{ route('usuarios.busqueda_usuario', ['id' => auth()->user()->id]) }}" method="GET">
                <i class="fas fa-search fa-fw" id="iconoBuscar" style="cursor: pointer;" onclick="document.getElementById('formularioBusqueda').submit();"></i>
                <input class="buscar_usuario" type="text" name="busqueda" placeholder="Nombre del usuario" required>
            </form>
        </div>
    </div>
    
    <div class="contenedor_tabla_usuarios">
        <table class="estilo_tabla">
            <thead>
                <tr class="encabezado_table">
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Fecha de creación</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                    <tr class="text-center">
                        <td>{{ $usuario->id }}</td> 
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->created_at }}</td>
                        <td>{{ $usuario->rol_name }}</td> 
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
