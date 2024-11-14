<link rel="stylesheet" href="/css/ManagmentSale.css">
<div class="cont_general_register_sale">
    <div class="cont_register_s">
        <h1>REGISTRAR VENTA</h1>
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
        <h1>Datos Cliente</h1>
    </div>

    <div class="cont_regis">

        <div class="cont_filled">
            <label class="subt_register" for="name">C.I.</label>
            <input class="input_register" type="text" id="ci_persona" name="ci_persona" placeholder="C.I." required>
        </div>

        <div class="cont_filled">
            <label class="subt_register" for="name">Nombre</label>
            <input class="input_register" type="text" id="nombres" name="Nombres" placeholder="Nombre">
        </div>

        <div class="cont_filled">
            <label class="subt_register" for="name">Apellido Paterno</label>
            <input class="input_register" type="text" id="apellido_paterno" name="apellido_paterno"
                placeholder="Apellido Paterno">
        </div>

        <div class="cont_filled">
            <label class="subt_register" for="name">Apellido Materno</label>
            <input class="input_register" type="text" id="apellido_materno" name="apellido_materno"
                placeholder="Apellido Materno">
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
                        <form id="formularioBusqueda" class="formulario_busqueda" id="formularioBusqueda" {{-- action="{{ route('empleados.busqueda_empleado', ['id' => $user->id]) }}" method="GET" --}}>

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
                                    <th>Estado</th>
                                    <th>Imagen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><button class="btn btn-success">+</button></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><img src="" alt="" class="img-fluid"
                                            ></td>
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
        <button type="button" class="my_button_sale">Registrar Venta</button>
    </div>

</div>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>

{{-- //script for filled --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

