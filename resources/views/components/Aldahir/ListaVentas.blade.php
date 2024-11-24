
<link rel="stylesheet" href="{{ asset('css/ListaVentas.css') }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<section class="container_lista_empleados">
   
        <div class="cotenedor_lista_e">
            <h1>LISTA DE  VENTAS</h1>
        </div>
        
    
    <div class="contenedor_tabla_empleados">
        <table class="estilo_tabla">
            <thead>
                <tr class="encabezado_table">
                    <th>id</th>
                    
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Usuario</th>
                    <th>Fecha de venta</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($ventas as $venta)
                        <tr class="text-center">
                            <td>{{ $venta->id_inventario_venta }}</td>
                            <td>{{ $venta->producto }}</td>
                            <td>{{ $venta->cantidad }}</td>
                            <td>{{ $venta->usuario }}</td>
                            <td>{{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
            </tbody>
        </table>

    </div>
    

</section>

