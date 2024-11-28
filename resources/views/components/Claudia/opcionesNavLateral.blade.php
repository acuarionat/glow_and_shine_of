<link rel="stylesheet" href="{{ asset('css/opcionesNavLateral.css') }}">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
@php
    $role = auth()->user()->rol->nombre_rol;
@endphp
<div class="contenedor_opciones_navLateral">
    <ul>
        <li class="menu-item">
            <label>
                <i class="fab fa-dashcube fa-fw"></i>
                @if($role == 'admin')
                    <a class="opc_dashboard" href="{{ url('/account/dashboardAdmin/' . auth()->user()->id) }}" class="active"> Dashboard</a>
                @else
                    <a lass="opc_dashboard" href="{{ url('/account/dashboardEmpleado/' . auth()->user()->id) }}" class="active"> Dashboard</a>
                @endif
            </label>
        </li>

        <li class="menu-item">
            <input type="checkbox" id="productos-checkbox">
            <label for="productos-checkbox" class="menu-link">
                <i class="fas fa-box"></i>
                Productos
                <i class="fas fa-chevron-right arrow-icon"></i>
            </label>
            <ul class="submenu">
                <li><a href="{{ url('registrarProducto/' . auth()->user()->id) }}" class="active"><i class="fas fa-plus"></i> Registrar Productos</a></li>
                <li><a href="{{ url('buscarProducto/' . auth()->user()->id) }}" class="active"><i class="fas fa-plus"></i> Mostrar Productos</a></li>
            </ul>
        </li>
        <li class="menu-item">
            <input type="checkbox" id="subparametros-checkbox">
            <label for="subparametros-checkbox" class="menu-link">
                <i class="fas fa-chart-bar"></i>
                Subparametros
                <i class="fas fa-chevron-right arrow-icon"></i>
            </label>
            
            <ul class="submenu">
                <li><a href=" {{ url('categorias/' . auth()->user()->id) }}" class="active"><i class="fas fa-plus"></i> Mostrar Subparametros</a></li>
                <li><a href=" {{ url('categorias/subparametros/create/' . auth()->user()->id) }}" class="active"><i class="fas fa-plus"></i> Agregar Subparametro</a></li>
            </ul>
        </li>
        <li class="menu-item">
            <input type="checkbox" id="ventas-checkbox">
            <label for="ventas-checkbox" class="menu-link">
                <i class="fas fa-hand-holding-usd fa-fw"></i>
                Ventas
                <i class="fas fa-chevron-right arrow-icon"></i>
            </label>
            <ul class="submenu">
                <li><a href="{{ url('msale/' . auth()->user()->id) }}" class="active"><i class="fas fa-plus"></i> Registrar venta</a></li>
                <li><a href="{{ url('ventas/' . auth()->user()->id) }}" class="active"><i class="fas fa-plus"></i> Historia de ventas</a></li>
            </ul>
        </li>

        @if($role == 'admin')
        <li class="menu-item">
            <input type="checkbox" id="compras-checkbox">
            <label for="compras-checkbox" class="menu-link">
                <i class="fas fa-shopping-cart"></i>
                Compras
                <i class="fas fa-chevron-right arrow-icon"></i>
            </label>
            <ul class="submenu">
                <li><a href="{{ url('registrarCompras/' . auth()->user()->id) }}"  class="active"><i class="fas fa-plus"></i> Registrar Compra</a></li>
                <li><a href="{{ url('compras/' . auth()->user()->id) }}" class="active"><i class="fas fa-plus"></i> Historia de Compra</a></li>
            </ul>
        </li>
        @endif

        @if($role == 'admin')
        <li class="menu-item">
            <input type="checkbox" id="empleados-checkbox">
            <label for="empleados-checkbox" class="menu-link">
                <i class="fas fa-users"></i>
                Empleados
                <i class="fas fa-chevron-right arrow-icon"></i>
            </label>
            <ul class="submenu">
                <li><a href="{{ url('registrarEmpleados/' . auth()->user()->id) }}" class="active"><i class="fas fa-plus"></i> Registrar Empleados</a></li>
                <li><a href="{{ url('listaEmpleados/' . auth()->user()->id) }}" class="active"><i class="fas fa-plus"></i> Mostrar Empleados</a></li>
            </ul>
        </li>
        @endif

        @if($role == 'admin')
        <li class="menu-item">
            <input type="checkbox" id="usuarios-checkbox">
            <label for="usuarios-checkbox" class="menu-link">
                <i class="fas fa-users"></i>
                Usuarios
                <i class="fas fa-chevron-right arrow-icon"></i>
            </label>
            <ul class="submenu">
                <li><a href="{{ url('listarUsuarios/' . auth()->user()->id) }}" class="active"><i class="fas fa-plus"></i> Mostrar usuarios</a></li>
            </ul>
        </li>
        @endif
        <li class="menu-item">
            <input type="checkbox" id="clientes-checkbox">
            <label for="clientes-checkbox" class="menu-link">
                <i class="fas fa-users"></i>
                Clientes
                <i class="fas fa-chevron-right arrow-icon"></i>
            </label>
            <ul class="submenu">
                <li><a href="{{ url('registrarCliente/' . auth()->user()->id) }}" class="active"><i class="fas fa-plus"></i> Registrar Clientes</a></li>
                <li><a href="{{ url('listaClientes/' . auth()->user()->id) }}" class="active"><i class="fas fa-plus"></i> Mostrar Clientes</a></li>
            </ul>
        </li>
        @if($role == 'admin')
        <li class="menu-item">
            <input type="checkbox" id="informes-checkbox">
            <label for="informes-checkbox" class="menu-link">
                <i class="fas fa-chart-line"></i>
                Informes y reportes
                <i class="fas fa-chevron-right arrow-icon"></i>
            </label>
            <ul class="submenu">
                <li><a href="#" class="active"><i class="fas fa-plus"></i> Reportes de productos</a></li>
                <li><a href="#" class="active"><i class="fas fa-plus"></i> Reportes de ventas</a></li>
                <li><a href="#" class="active"><i class="fas fa-plus"></i> Reportes de compras</a></li>
                <li><a href="#" class="active"><i class="fas fa-plus"></i> Reportes de empleados</a></li>
                <li><a href="#" class="active"><i class="fas fa-plus"></i> Reportes de clientes</a></li>
                <li><a href="{{ url('listarUsuariosRep/' . auth()->user()->id) }}" class="active"><i class="fas fa-plus"></i> Reportes de usuarios</a></li>
            </ul>
        </li> 
        @endif
    </ul>
</div>
