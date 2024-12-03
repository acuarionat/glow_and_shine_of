<link rel="stylesheet" href="/css/ManagmentBuy.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<div class="cont_general_register_sale">
    <div class="cont_register_s">
        <h1>REGISTRAR COMPRA</h1>
    </div>
    <div class="cont_register_title">
        <h1>Datos Comprador</h1>
    </div>
    {{--     <form method="POST" action="{{ route('registrar.venta') }}"> --}}
    @csrf
    <div class="cont_regis">
        <div class="cont_filled">
            <label class="subt_register" for="name">Nombre</label>
            <input class="input_register" type="text" name="Nombre" placeholder="Escribe aquí"
                value="{{ $user->name }}" readonly>
            <input type="hidden" id="userId" value="{{ $user->id }}">
        </div>
    </div>

    <div class="cont_register_title">
        <h1>Datos Proveedor</h1>
    </div>

    <div class="cont_regis">

        <div class="cont_filled">
            <label class="subt_register" for="name">Nombre de la empresa</label>
            <select class="input_register" name="proveedor" id="select-proveedor" onchange="actualizarTipoProveedor()">
                <option value="">Seleccione al proveedor</option>
            </select>
        </div>
        <div class="cont_filled">
            <label class="subt_register" for="name">Tipo Proveedor</label>
            <input class="input_register" name="Tipo_Proveedor" id="input-tipo-proveedor" type="text"
                placeholder="Tipo Proveedor" readonly>
        </div>
    </div>

    <div class="container_button_validate">
        <button type="button" class="my_button_validate_buy">Validar Datos</button>
    </div>

    <div class="modal fade" id="modalInventarioVenta" tabindex="-1" role="dialog"
        aria-labelledby="modalInventarioVentaLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalInventarioVentaLabel">Seleccione un Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Cuadro de búsqueda -->
                    <div class="contenedor_busqueda">
                        <form id="formularioBusqueda" class="formulario_busqueda" id="formularioBusqueda"
                            {{-- action="{{ route('empleados.busqueda_empleado', ['id' => $user->id]) }}" method="GET" --}}>

                            <i class="fas fa-search fa-fw" id="iconoBuscar" style="cursor: pointer;"></i>
                            <input class="buscar_empleado" type="text" id="nombre_producto"
                                placeholder="Nombre del producto" required>
                        </form>
                    </div>

                    <!-- Tabla de Inventario de Venta -->
                    <div class="table-responsive">
                        <table class="table table-bordered modal-table">
                            <thead class="thead-light">
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Categoría</th>
                                    <th>Marca</th>
                                    <th>Color</th>
                                    <th>Lote</th>
                                    <th>Detalle Medida</th>
                                    <th>Precio Venta</th>
                                    <th>Cantidad</th>
                                    <th>Estado</th>
                                    <th>Imagen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer container_button_d">
                    <button type="button" class="my_button_d" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="cont_table_sale">
        <table border="1">
            <thead>
                <tr>
                    <th>Opciones</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Descuento (%)</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <tr>

                </tr>
                <tr class="total-row">
                    <td colspan="5" class="text-right">TOTAL</td>
                    <td>0</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="container_button_sale">
        <button type="button" class="my_button_sale" data-toggle="modal" data-target="#modalInventarioVenta">+
            Agregar
            Producto</button>
        <button type="button" class="my_button_sale" id="btnRegistrarCompra">Registrar Compra</button>
    </div>
    {{--     </form> --}}
</div>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>

{{-- //script for filled --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /* buscar producto */
    $(document).ready(function() {
        $('#iconoBuscar').on('click', function() {
            const nombreProducto = $('#nombre_producto').val().trim();

            // Construir la URL dependiendo de si el input tiene valor o no
            const url = nombreProducto ? `/buscar-producto/${nombreProducto}` : '/buscar-producto';

            $.ajax({
                url: url,
                method: 'GET',
                success: function(data) {
                    const tbody = $('.modal-table tbody');
                    tbody.empty(); // Limpiar la tabla antes de mostrar resultados

                    if (data.length > 0) {
                        data.forEach(producto => {
                            const fila = `
                            <tr>
                                <td><button class="btn btn-success">+</button></td>
                                <td>${producto.nombre_producto}</td>
                                <td>${producto.categoria}</td>
                                <td>${producto.marca}</td>
                                <td>${producto.color}</td>
                                <td>${producto.lote || ''}</td>
                                <td>${producto.medida_valor || ''} ${producto.unidad_medida || ''}</td>
                                <td>${producto.precio_venta}</td>
                                <td>${producto.cantidad}</td>
                                <td>${producto.estado}</td>
                                <td>
                                    ${producto.imagen ? `<img src="${producto.imagen}" alt="Imagen del producto" class="img-fluid" style="width: 50px; height: auto;">` : 'Sin Imagen'}
                                </td>
                            </tr>
                        `;
                            tbody.append(
                                fila); // Añadir cada fila al cuerpo de la tabla
                        });
                    } else {
                        tbody.append(
                            '<tr><td colspan="10" class="text-center">No se encontraron productos.</td></tr>'
                        );
                    }

                    // Enlazar el evento a los botones generados
                    $('.modal-table .btn-success').off('click').on('click', function() {
                        const row = $(this).closest('tr')[0];
                        const productName = row.cells[1].textContent;
                        const price = row.cells[7].textContent;

                        const saleTableBody = document.querySelector(
                            '.cont_table_sale tbody');
                        const newRow = document.createElement('tr');

                        newRow.innerHTML = `
                        <td><button class="btn btn-danger" onclick="removeRow(this)">-</button></td>
                        <td>${productName}</td>
                        <td><input type="number" value="1" min="1" onchange="updateSubtotal(this)"></td>
                        <td>${price}</td>
                        <td><input type="number" value="0" min="0" onchange="updateSubtotal(this)"></td>
                        <td>${price}</td>
                    `;
                        saleTableBody.insertBefore(newRow, saleTableBody
                            .querySelector('.total-row'));

                        updateTotal();
                    });
                },
                error: function() {
                    alert('Error al buscar productos.');
                }
            });
        });
    });

    // Función para actualizar el subtotal de cada fila de venta
    function updateSubtotal(input) {
        const row = input.closest('tr');
        const quantity = parseInt(row.cells[2].querySelector('input').value);
        const price = parseFloat(row.cells[3].textContent);
        const discount = parseInt(row.cells[4].querySelector('input').value);
        const subtotal = (quantity * price) - (quantity * price) * (discount / 100);

        row.cells[5].textContent = subtotal.toFixed(2);


        updateTotal();
    }

    // Función para actualizar el total general
    function updateTotal() {
        const rows = document.querySelectorAll('.cont_table_sale tbody tr:not(.total-row)');
        let total = 0;

        // Recorrer las filas para sumar los subtotales
        rows.forEach(row => {
            const subtotalCell = row.cells[5]; // Celda de subtotal
            const subtotal = parseFloat(subtotalCell ? subtotalCell.textContent : 0);

            // Verificar que el subtotal sea un número válido
            if (!isNaN(subtotal)) {
                total += subtotal;
            }
        });

   
        const totalCell = document.querySelector('.total-row td:last-child');
        if (totalCell) {
            totalCell.textContent = total.toFixed(2); 
        }
    }

    function removeRow(button) {
        const row = button.closest('tr');
        row.remove();
        updateTotal();
    }

    $(document).ready(function() {
        $('.my_button_validate_buy').on('click', function() {
            const idEmpleado = $('#userId').val(); 
            const idProveedor = $('#select-proveedor')
                .val(); 

            if (!idEmpleado || !idProveedor) {
                const errorMessage =
                    'El empleado o el proveedor no están definidos. Por favor, completa ambos campos.';
                Swal.fire({
                    title: 'Error de actualización',
                    text: errorMessage,
                    icon: 'error',
                    confirmButtonText: 'Aceptar',
                    customClass: {
                        popup: 'custom-popup',
                        confirmButton: 'custom-confirm-button'
                    }
                });
                return;
            }

            // Registrar el proceso de compra con los IDs
            $.ajax({
                url: '/registrar-proceso-compra', // Ruta para registrar el proceso de compra
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id_empleado: idEmpleado,
                    id_proveedor: idProveedor,
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Información actualizada correctamente',
                        text: response.success ||
                            'Los datos se validaron correctamente.',
                        icon: 'success',
                        confirmButtonText: 'Aceptar',
                        customClass: {
                            popup: 'custom-popup',
                            confirmButton: 'custom-confirm-button'
                        }
                    });
                },
                error: function(xhr) {
                    const errorMessage = xhr.responseJSON?.error ||
                        'Ocurrió un error inesperado.';
                    Swal.fire({
                        title: 'Error de actualización',
                        text: errorMessage,
                        icon: 'error',
                        confirmButtonText: 'Aceptar',
                        customClass: {
                            popup: 'custom-popup',
                            confirmButton: 'custom-confirm-button'
                        }
                    });
                }
            });
        });
    });


    $(document).on('click', '#btnRegistrarCompra', function() {
        const productos = [];

        // Recorre las filas de la tabla de productos
        $('.cont_table_sale tbody tr:not(.total-row)').each(function() {
            const row = $(this);

            // Validar que la fila no esté vacía
            if (!row.find('td').length) {
                console.warn('Fila vacía detectada, ignorando...');
                return;
            }

            const nombre = row.find('td:nth-child(2)').text().trim();
            const cantidad = parseInt(row.find('td:nth-child(3) input').val());
            const precio = parseFloat(row.find('td:nth-child(4)').text().trim());

            if (nombre && !isNaN(cantidad) && !isNaN(precio)) {
                productos.push({
                    nombre,
                    cantidad,
                    precio
                });
            } else {
                console.warn('Datos inválidos en fila, ignorando:', {
                    nombre,
                    cantidad,
                    precio
                });
            }
        });

        const userId = document.getElementById('userId').value;

        $.ajax({
        url: `/registrar-compra/${userId}`,
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            productos: productos
        },
        success: function(response) {
            Swal.fire({
                title: 'Compra exitosa',
                text: response.success || 'La compra se registró con éxito.',
                icon: 'success',
                confirmButtonText: 'Aceptar',
                customClass: {
                    popup: 'custom-popup',
                    confirmButton: 'custom-confirm-button'
                }
            }).then(() => {
                window.location.reload();
            });
        },
            error: function(xhr) {
                const errorMessage = xhr.responseJSON?.error || 'Ocurrió un error inesperado.';
                Swal.fire({
                    title: 'Error de actualización',
                    text: errorMessage,
                    icon: 'error',
                    confirmButtonText: 'Aceptar',
                    customClass: {
                        popup: 'custom-popup',
                        confirmButton: 'custom-confirm-button'
                    }
                    
                });
            }
        });
    });

    let proveedoresData = []; 

    
    function obtenerProveedores() {
        fetch('/obtener-proveedores')
            .then(response => response.json())
            .then(data => {
                proveedoresData = data; 
                const selectProveedor = document.getElementById('select-proveedor');
                selectProveedor.innerHTML = '<option value="">Seleccione un proveedor</option>';

             
                data.forEach(proveedor => {
                    const option = document.createElement('option');
                    option.value = proveedor.id_proveedor; 
                    option.textContent = proveedor
                        .empresa_proveedor; 
                    selectProveedor.appendChild(option);
                });
            })
            .catch(error => console.error('Error al cargar los proveedores:', error));
    }

    
    function actualizarTipoProveedor() {
        const selectProveedor = document.getElementById('select-proveedor');
        const inputTipoProveedor = document.getElementById('input-tipo-proveedor');
        const idProveedor = selectProveedor.value;

        if (!idProveedor) {
            inputTipoProveedor.value = ''; 
            return;
        }

        
        const proveedorSeleccionado = proveedoresData.find(proveedor => proveedor.id_proveedor == idProveedor);
        inputTipoProveedor.value = proveedorSeleccionado ? proveedorSeleccionado.tipo_proveedor : '';
    }

    document.addEventListener('DOMContentLoaded', obtenerProveedores);
</script>
