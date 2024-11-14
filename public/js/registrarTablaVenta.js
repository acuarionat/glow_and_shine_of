
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