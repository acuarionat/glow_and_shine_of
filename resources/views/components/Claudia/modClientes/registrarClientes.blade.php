<link rel="stylesheet" href="{{ asset('css/registrarEmpleado.css') }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<section class="container_registrar_empleados">

    <div class="cotenedor_registrar_e">
        <h1>REGISTRAR A UN CLIENTE</h1>
    </div>


    <div class="container_form_registro">
        <form action="{{ route('cliente.registrar') }}" method="POST" class="form_registrar_empleado" id="formEmpleado">
            @csrf

            <h1 class="seccion_forms">Datos Personales</h1>
            <div class="form_group">
                <div class="form-field">
                    <input class="edit_info" type="text" name="correo" placeholder="Correo electronico " value="{{ old('correo') }}" required>
                    @error('correo')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-field">
                    <input class="edit_info" type="text" name="nombres" id="nombre" placeholder="Nombres" value="{{ old('nombres') }}" required>
                    @error('nombres')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-field">
                    <input class="edit_info" type="text" name="apellido_paterno" id="apellido_paterno" placeholder="Apellido Paterno" value="{{ old('apellido_paterno') }}" required>
                    @error('apellido_paterno')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-field">
                    <input class="edit_info" type="text" name="apellido_materno" id="apellido_materno" placeholder="Apellido Materno" value="{{ old('apellido_materno') }}" required>
                    @error('apellido_materno')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>
                <div class="form-field">
                    <input class="edit_info" type="text" name="carnet_identidad" id="carnet_identidad" placeholder="Carnet de identidad" value="{{ old('carnet_identidad') }}" required>
                    @error('carnet_identidad')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>

            {{-- </div>
            <h1 class="seccion_forms">Datos del cliente</h1>
            <div class="form_group"> --}}
                <div class="form-field">
                    <select class="edit_info" id="tipo_cliente" name="tipo_cliente" onchange="actualizarDescuento()">
                        <option value="{{ old('tipo_cliente') }}" disabled selected>Selecciona tipo cliente</option>
                        <option value="42">Minorista</option>
                        <option value="43">Mayorista</option>
                        <option value="44">Promotor</option>
                    </select>

                </div>
                <div class="form-field">

                    <input class="edit_info" type="text" id="porcentaje_descuento" name="porcentaje_descuento" placeholder="Porcentaje de descuento" value="{{ old('porcentaje_descuento') }}" required>
                </div>

            </div>
            <!-- <h1 class="seccion_forms">Datos del academico</h1>
                <div class="form_group">
                    

                    <input class="edit_info" type="text" placeholder="Nivel academico">
                    <input class="edit_info" type="text" placeholder="Especialidad academica">
                </div> -->

            <button type="submit" class="boton_guardar_cambios">Registrar cliente</button>
        </form>

    </div>

</section>


@if(session('success'))
<script>
    Swal.fire({
        title: 'Registro exitoso',
        text: "{{ session('success') }}",
        icon: 'success',
        confirmButtonText: 'Aceptar',
        customClass: {
            popup: 'custom-popup',
            confirmButton: 'custom-confirm-button'
        }
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        title: 'Error de Registro',
        text: "{{ session('error') }}",
        icon: 'error',
        confirmButtonText: 'Aceptar',
        customClass: {
            popup: 'custom-popup',
            confirmButton: 'custom-confirm-button'
        }
    });
</script>
@endif


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    function actualizarDescuento() {
        const tipoCliente = document.getElementById('tipo_cliente').value;
        const campoDescuento = document.getElementById('porcentaje_descuento');

        let descuento = '0.0';

        if (tipoCliente === '42') {
            descuento = '0.0';
        } else if (tipoCliente === '43') {
            descuento = '20.0';
        } else if (tipoCliente === '44') {
            descuento = '15.0';
        }

        campoDescuento.value = descuento;
    }
</script>