<link rel="stylesheet" href="/css/ManagmentSale.css">
<div class="cont_general_register_sale">
    <div class="cont_register_s">
        <h1>REGISTRAR COMPRA</h1>
    </div>
    <div class="cont_register_title">
        <h1>Datos Administrador</h1>
    </div>
    <div class="cont_regis">
        <div class="cont_filled">
            <label class="subt_register" for="name">Nombre</label>
            <input class="input_register" type="text" name="Nombre" placeholder="Escribe aquí"
                value="{{ $user->name }}" readonly>
        </div>
    </div>

    <div class="cont_register_title">
        <h1>Datos del proveedor</h1>
    </div>

    <div class="cont_regis">

        <div class="cont_filled">
            <label class="subt_register" for="name">Nombre de la empresa</label>
            <input class="input_register" type="text" id="ci_persona" name="ci_persona" placeholder="Nombre de la empresa" required>
        </div>

        <div class="cont_filled">
            <label class="subt_register" for="name">Codiciones de pago</label>
            <input class="input_register" type="text" id="condiciones_pago" name="Nombres" placeholder="Condiciones de pago">

        </div>

        

    </div>

    <div class="container_button_sale">
        <button type="button" class="my_button_sale" data-toggle="modal" data-target="#modalInventarioVenta">+ Agregar
            Producto</button>
    </div>

    <!-- Modal Inventario Venta -->
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
                        <form class="formulario_busqueda" id="formularioBusqueda" {{-- action="{{ route('empleados.busqueda_empleado', ['id' => $user->id]) }}" method="GET" --}}>

                            <i class="fas fa-search fa-fw" id="iconoBuscar" style="cursor: pointer;"
                                {{-- onclick="document.getElementById('formularioBusqueda').submit();" --}}></i>
                            <input class="buscar_empleado" type="text" name="busqueda"
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
                                    <th>Estado</th>
                                    <th>Imagen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><button class="btn btn-success">+</button></td>
                                    <td>Rubor</td>
                                    <td>Maquillaje</td>
                                    <td>Esika</td>
                                    <td>Blanco</td>
                                    <td>12323</td>
                                    <td>11x4</td>
                                    <td>45</td>
                                    <td>Activo</td>
                                    <td><img src="ruta/a/imagen.jpg" alt="Imagen del producto" class="img-fluid"
                                            style="width: 50px; height: auto;"></td>
                                </tr>
                                <!-- Más filas de ejemplo -->
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




    {{-- //my_table --}}

    <div class="cont_table_sale">
        <table border="1">
            <thead>
                <tr>
                    <th>Opciones</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Descuento</th>
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
        <button type="button" class="my_button_sale">Registrar Compra</button>
    </div>

</div>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>

{{-- //script for filled --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#ci_persona').on('blur', function() {
            const ci = $(this).val();
            if (ci) {
                $.ajax({
                    url: `/buscar-empresa/${ci}`,
                    method: 'GET',
                    success: function(data) {
                        $('#condiciones_pago').val(data.condiciones_pago);
                        
                        
                    },
                    error: function() {
                        alert('Empresa no encontrada');
                        $('#condiciones_pago').val('');
                        
                        
                    }
                });
            }
        });
    });
</script>


<script>
    document.querySelector('.my_button_sale').addEventListener('click', function() {
    // Obtener datos del cliente y el proceso de venta
    const id_cliente = document.getElementById('ci_persona').value;
    const id_empleado = "{{ $user->id }}"; // ID del empleado logueado
    const id_usuarioAccion = "{{ $user->id }}"; // Asumiendo que es el mismo empleado

    // Recopilar productos
    const productos = [];
    document.querySelectorAll('.cont_table_sale tbody tr:not(.total-row)').forEach(row => {
        const id_producto = row.getAttribute('data-id_producto'); // Asegúrate de almacenar el id_producto en cada fila
        const cantidad = row.querySelector('input[type="number"]').value;
        const precio = row.cells[3].textContent; // Obtener precio

        productos.push({ id_producto, cantidad, id_precio_mercado: precio });
    });

    // Enviar datos a través de AJAX
    $.ajax({
        url: '/registrar-venta',
        method: 'POST',
        data: {
            _token: "{{ csrf_token() }}", // Token CSRF
            id_cliente,
            id_empleado,
            id_usuarioAccion,
            productos
        },
        success: function(response) {
            alert(response.message);
        },
        error: function(error) {
            alert('Error al registrar la venta');
        }
    });
});

</script>
<script>
    // Filtrado de productos en tiempo real
    document.querySelector('input[name="busqueda"]').addEventListener('input', function() {
        const query = this.value.toLowerCase();
        const rows = document.querySelectorAll('.modal-table tbody tr');
        
        rows.forEach(row => {
            const productName = row.cells[1].textContent.toLowerCase();
            if (productName.includes(query)) {
                row.style.display = ''; // Muestra la fila si coincide con la búsqueda
            } else {
                row.style.display = 'none'; 
            }
        });
    });

    // Añadir producto a la tabla de ventas
    document.querySelectorAll('.modal-table .btn-success').forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            const productName = row.cells[1].textContent;
            const price = row.cells[7].textContent;
            
            
            const saleTableBody = document.querySelector('.cont_table_sale tbody');
            const newRow = document.createElement('tr');
            
            newRow.innerHTML = `
                <td><button class="btn btn-danger" onclick="removeRow(this)">-</button></td>
                <td>${productName}</td>
                <td><input type="number" value="1" min="1" onchange="updateSubtotal(this)"></td>
                <td>${price}</td>
                <td><input type="number" value="0" min="0" onchange="updateSubtotal(this)"></td>
                <td>${price}</td>
            `;
            saleTableBody.insertBefore(newRow, saleTableBody.querySelector('.total-row'));
            
            
            updateTotal();
        });
    });

    // Función para actualizar el subtotal de cada fila de venta
    function updateSubtotal(input) {
        const row = input.closest('tr');
        const quantity = row.cells[2].querySelector('input').value;
        const price = parseFloat(row.cells[3].textContent);
        const discount = row.cells[4].querySelector('input').value;
        const subtotal = (quantity * price) - discount;

        row.cells[5].textContent = subtotal.toFixed(2);

        
        updateTotal();
    }

    // Función para actualizar el total general
    function updateTotal() {
        const rows = document.querySelectorAll('.cont_table_sale tbody tr:not(.total-row)');
        let total = 0;

        rows.forEach(row => {
            const subtotal = parseFloat(row.cells[5].textContent);
            total += subtotal;
        });

        document.querySelector('.total-row td:last-child').textContent = total.toFixed(2);
    }

    // Función para eliminar una fila de la tabla de ventas
    function removeRow(button) {
        const row = button.closest('tr');
        row.remove();

       
        updateTotal();
    }
</script>


