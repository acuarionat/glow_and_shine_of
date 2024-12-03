
<link rel="stylesheet" href="{{ asset('css/ListaVentas.css') }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<section class="container_lista_empleados">
   
        <div class="cotenedor_lista_e">
            <h1>HISTORIAL DE COMPRAS</h1>
        </div>
        
    
    <div class="contenedor_tabla_empleados">
        <table class="estilo_tabla">
            <thead>
                <tr class="encabezado_table">
                    <th>id</th>
                    
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Usuario</th>
                    <th>Fecha de compra</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($compras as $compra)
                        <tr class="text-center">
                            <td>{{ $compra->id_inventario_compra }}</td>
                            <td>{{ $compra->producto }}</td>
                            <td>{{ $compra->cantidad }}</td>
                            <td>{{ $compra->precio }}</td>
                            <td>{{ $compra->usuario }}</td>
                            <td>{{ \Carbon\Carbon::parse($compra->fecha_compra)->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
            </tbody>
        </table>

    </div>
    

</section>

