<link rel="stylesheet" href="{{ asset('css/registrarEmpleado.css') }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<section class="container_registrar_empleados">

    <div class="cotenedor_registrar_e">
        <h1>REGISTRAR A UN EMPLEADO</h1>
    </div>


    <div class="container_form_registro">
        <form action="{{ route('empleados.registrar') }}" method="POST" class="form_registrar_empleado" id="formEmpleado">
            @csrf


            <h1 class="seccion_forms">Datos Personales</h1>
            <div class="form_group">

                <div class="form-field">
                    <input class="edit_info" type="text" name="correo" id="correo" placeholder="Correo electronico" value="{{ old('correo') }}" required>
                    @error('correo')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nombres -->
                <div class="form-field">
                    <input class="edit_info" type="text" name="nombres" id="nombre" placeholder="Nombres" value="{{ old('nombres') }}" required>
                    @error('nombres')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Apellido Paterno -->
                <div class="form-field">
                    <input class="edit_info" type="text" name="apellido_paterno" id="apellido_paterno" placeholder="Apellido Paterno" value="{{ old('apellido_paterno') }}" required>
                    @error('apellido_paterno')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Apellido Materno -->
                <div class="form-field">
                    <input class="edit_info" type="text" name="apellido_materno" id="apellido_materno" placeholder="Apellido Materno" value="{{ old('apellido_materno') }}" required>
                    @error('apellido_materno')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Carnet de Identidad -->
                <div class="form-field">
                    <input class="edit_info" type="text" name="carnet_identidad" id="carnet_identidad" placeholder="Carnet de identidad" value="{{ old('carnet_identidad') }}" required>
                    @error('carnet_identidad')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>
            <h1 class="seccion_forms">Datos laborales</h1>
            <div class="form_group">


                <div class="form-field">

                    <input class="edit_info" type="date" name="fecha_contratacion" placeholder="Fecha Contratación (yy-mm-dd)" value="{{ old('fecha_contratacion') }}" required>
                    @error('fecha_contratacion')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-field">
                    <input class="edit_info" type="text" name="salario" placeholder="Salario" value="{{ old('salario') }}" required>
                </div>

                <div class="form-field">
                    <select class="edit_info" id="turno" name="turno">
                        <option value="{{ old('turno') }}" disabled selected>Selecciona un turno</option>
                        <option value="34">Mañana</option>
                        <option value="35">Tarde</option>
                        <option value="36">Noche</option>
                    </select>
                </div>



            </div>
            <!-- <h1 class="seccion_forms">Datos del academico</h1>
                <div class="form_group">
                    

                    <input class="edit_info" type="text" placeholder="Nivel academico">
                    <input class="edit_info" type="text" placeholder="Especialidad academica">
                </div> -->

            <button type="submit" class="boton_guardar_cambios">Registrar empleado</button>
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