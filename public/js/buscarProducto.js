$(document).ready(function() {
    $('#iconoBuscar').on('click', function() {
        const nombreProducto = $('#nombre_producto').val();
        if (nombreProducto) {
            $.ajax({
                url: `/buscar-producto/${nombreProducto}`,
                method: 'GET',
                success: function(data) {
                    const tbody = $('.modal-table tbody');
                    tbody.empty(); // Limpiar la tabla antes de mostrar resultados
                    data.forEach(producto => {
                        const fila = `
                            <tr>
                                <td><button class="btn btn-success">+</button></td>
                                <td>${producto.nombre_producto}</td>
                                <td>${producto.categoria}</td>
                                <td>${producto.marca}</td>
                                <td>${producto.color}</td>
                                <td>${producto.lote}</td>
                                <td>${producto.medida_valor} ${producto.unidad_medida}</td>
                                <td>${producto.precio_venta}</td>
                                <td>${producto.estado}</td>
                                <td>
                                    ${producto.imagen ? `<img src="${producto.imagen}" alt="Imagen del producto" class="img-fluid" style="width: 50px; height: auto;">` : 'Sin Imagen'}
                                </td>
                            </tr>
                        `;
                        tbody.append(fila); // Añadir cada fila al cuerpo de la tabla
                    });

                    // Enlazar el evento a los botones generados
                    $('.modal-table .btn-success').off('click').on('click', function() {
                        const row = $(this).closest('tr')[0];
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
                },
                error: function() {
                    alert('Producto no encontrado');
                }
            });
        }
    });
});
