@props(['user', 'usuarios'])

<link rel="stylesheet" href="{{ asset('css/listaUsuarios.css') }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<style>
    .fil {
    background-color: var(--Morado); 
    padding: 12px 24px; 
    font-size: 1rem; 
    border: 2px solid transparent; 
    border-radius: 50px; 
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
    cursor: pointer; 
    transition: all 0.3s ease; 
    color: #fff;
    margin-bottom: 10px
}

.fil:hover {
    background-color: #c26abc; 
    color: var(--Blanco);
    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3);
    border: 2px solid #C9A8CB; 
}
.lim{
    background-color: var(--Morado); 
    padding: 12px 24px; 
    font-size: 1rem; 
    border: 2px solid transparent; 
    border-radius: 50px; 
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
    cursor: pointer;
    transition: all 0.3s ease; 
    color: #fff;
    margin-bottom: 10px
}

.lim:hover {
    background-color: #c26abc; 
    color: var(--Blanco);
    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3);
    border: 2px solid #C9A8CB; 
    text-decoration: none;
   
}

label
{
    margin-top: 20px;
}
    .coso{
    height: 3rem;
    border-radius: 31px;
    border: 1.5px solid #764C73;
    font-size: 1rem ;
    color: grey;
    font-family: 'Poppins', semi-bold;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 14px;
    padding-left: 5px; 
    box-sizing: border-box;
}
.generar
{
    width: 100%;
    display: flex;
    align-items: center;
    padding: 10px 0px 10px 20px;
    justify-content: start;
    border-top: #764C73 solid 2px;
}
    .pagination .page-item .page-link {
        background-color: whitesmoke; 
        color: #c26abc; 
        border-radius: 5px;
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
            <h1>REPORTES DE USUARIOS</h1>
        </div>
    </div>
   
    <form action="{{ route('usuarios.busqueda_usuario_rep', ['id' => auth()->user()->id]) }}" method="GET" class="mb-4">
        <div class="form-row">
            <div class="col-md-3">
                <label for="rol">Rol:</label>
                <select name="rol" id="rol" class="coso">
                    <option value="">Seleccionar Rol</option>
                    <option value="admin" {{ request('rol') == 'admin' ? 'selected' : '' }}>Administrador</option>
                    <option value="empleado" {{ request('rol') == 'empleado' ? 'selected' : '' }}>Empleado</option>
                    <option value="cliente" {{ request('rol') == 'cliente' ? 'selected' : '' }}>Cliente</option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="estado">Estado:</label>
                <select name="estado" id="estado" class="coso">
                    <option value="">Seleccionar Estado</option>
                    <option value="Activo" {{ request('estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                    <option value="Inactivo" {{ request('estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="fecha_inicio">Fecha Inicio:</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="coso" value="{{ request('fecha_inicio') }}">
            </div>
            <div class="col-md-3">
                <label for="fecha_fin">Fecha Fin:</label>
                <input type="date" name="fecha_fin" id="fecha_fin" class="coso" value="{{ request('fecha_fin') }}">
            </div>
        </div>

        <div class="form-row mt-3">
            <div class="col-md-12 text-right">
                <button type="submit" class="fil">Filtrar</button>
                <a href="{{ route('usuarios.busqueda_usuario_rep', ['id' => auth()->user()->id]) }}" class="lim">Limpiar</a>
            </div>
        </div>
    </form>
    <div class="generar">     
        <a href="{{ route('usuariospdf.pdf', ['id' => auth()->user()->id] + request()->all()) }}" 
        class="lim" target="_blank">
            Generar Reporte en PDF
        </a>
        <a href="{{ route('usuariosex.excel', ['id' => auth()->user()->id] + request()->all()) }}" 
        class="lim">
            Generar Reporte en Excel
        </a>
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
                    <th>Fecha de creacion</th>

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
                                {{ $usuario->estado }}
                    </td>
                    <td>{{ $usuario->created_at->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3 d-flex justify-content-center">
            {{ $usuarios->links('pagination::bootstrap-4') }}
        </div>
    </div>
</section>
