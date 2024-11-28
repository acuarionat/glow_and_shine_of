<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/moduloProducto.css') }}">
</head>

<x-app-layout-AdministradorDash :saludo="$saludo" :user="$user">
    <section class="contenedorDashAdmin">
            <x-Mikaela.verSubparametrosRegistrados 
            :user="$user"
            :categorias="$categorias" />

    </section>
</x-app-layout-AdministradorDash>

    @if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
    @endif

 
    <!-- Formulario para agregar subparámetros -->
    
    <!-- Script para manejar la funcionalidad -->
    <script>
        $(document).ready(function() {
            $('#id_parametros').on('change', function() {
                const id_parametros = $(this).val();

                if (id_parametros) {
                    // Llamada AJAX para obtener los subparámetros
                    $.ajax({
                        url: `/categorias/${id_parametros}/subparametros`,
                        type: 'GET',
                        success: function(data) {
                            const tableBody = $('#subparametros-table tbody');
                            tableBody.empty(); // Limpiar la tabla

                            if (data.length > 0) {
                                // Mostrar los subparámetros
                                data.forEach(subparametro => {
                                    tableBody.append(`
                                        <tr>
                                            <td>${subparametro.id_sub_parametros}</td>
                                            <td>${subparametro.descripcion}</td>
                                        </tr>
                                    `);
                                });
                                $('#subparametros-table').show(); // Mostrar la tabla
                            } else {
                                tableBody.append('<tr><td colspan="2">No hay subparámetros disponibles.</td></tr>');
                                $('#subparametros-table').show(); // Mostrar la tabla
                            }
                        },
                        error: function() {
                            alert('Error al obtener los subparámetros.');
                        }
                    });
                } else {
                    $('#subparametros-table').hide(); // Ocultar la tabla
                }
            });
        });
    </script>
