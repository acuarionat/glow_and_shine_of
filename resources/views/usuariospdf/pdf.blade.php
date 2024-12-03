<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container_lista_usuarios {
            width: 90%;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            margin-top: 10px;
        }

        /* Cabecera */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            background-color: #f7f2f9;
            border-bottom: 3px solid #925487;
            margin-bottom: 20px;
        }

        .header .logo img {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }

        .header .title {
            flex-grow: 1;
            text-align: center;
            font-family: "Poppins", sans-serif;
        }

        .header .title h1 {
            font-size: 1.8em;
            color: #925487;
            margin: 0;
        }

        .header .title h2 {
            font-size: 1em;
            color: #6c757d;
            margin: 5px 0 0;
            font-weight: normal;
        }

        .contenedor_tabla_usuario {
            overflow-x: auto;
        }

        .estilo_tabla {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .encabezado_table th {
            background-color: #925487;
            color: #ffffff;
            padding: 12px 15px;
            text-align: center;
            font-size: 0.9em;
            font-family: "Poppins", sans-serif;
        }

        .estilo_tabla td {
            padding: 10px 15px;
            text-align: center;
            color: #495057;
            font-size: 0.9em;
            border-bottom: 1px solid #dee2e6;
        }

        .estilo_tabla tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .estilo_tabla tr:hover {
            background-color: #e9ecef;
            cursor: pointer;
        }

        .firmas {
            margin-top: 30px;
            text-align: center;
        }

        .fecha-generacion {
            text-align: right;
            font-size: 0.9em;
            margin-top: 20px;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <!-- Encabezado que solo aparece una vez -->
    <div class="header">
        <div class="logo">
            <img src="{{ public_path('images/log.png') }}" alt="Logo G&S">
        </div>
        <div class="title">
            <h1>Lista de Usuarios</h1>
            <h2>Glow and Shine System</h2>
        </div>
    </div>

    <!-- Aquí se imprimen las páginas -->
    @foreach ($paginas as $pagina)
        <div class="container_lista_usuarios">
            <div class="contenedor_tabla_usuario">
                <table class="estilo_tabla">
                    <thead>
                        <tr class="encabezado_table">
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th>Fecha de Creación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pagina as $usuario)
                            <tr>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>
                                    @if ($usuario->rol && $usuario->rol->nombre_rol === 'admin')
                                        Administrador
                                    @elseif ($usuario->rol)
                                        {{ ucfirst($usuario->rol->nombre_rol) }}
                                    @else
                                        Sin Rol
                                    @endif
                                </td>
                                <td>{{ ucfirst($usuario->estado) }}</td>
                                <td>{{ $usuario->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Salto de página después de cada página, menos en la última -->
        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
        
    @endforeach
 
    <div class="firmas">
        <p>__________________________</p>
        <p>Firma del responsable</p>
        <br/>
        <br/>
        <p>__________________________</p>
        <p>Aprobado por</p>
    </div>

    <div class="fecha-generacion">
        <p>Fecha de generación del reporte: {{ \Carbon\Carbon::now()->setTimezone('America/La_Paz')->format('d/m/Y H:i') }}</p>
    </div>
</body>
</html>
