
<link rel="stylesheet" href="{{ asset('css/registrarEmpleado.css') }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<section class="container_registrar_empleados">
    <div class="cotenedor_registrar_e">
        <h1>AÑADIR A UN EMPLEADO</h1>
    </div>

    <div class="container_form_registro">
        <form action="{{ route('empleados.registrar') }}" method="POST" class="form_registrar_empleado" id="formEmpleado">
            @csrf

            <input class="edit_info" type="email" name="correo" placeholder="Correo electrónico del usuario" required oninput="verificarCorreo()">

            <h1 class="seccion_forms">Información Personal</h1>
            <div class="form_group">
                <input class="edit_info" type="text" name="nombres" id="nombre" placeholder="Nombres" required>
                <input class="edit_info" type="text" name="apellido_paterno" id="apellido_paterno" placeholder="Apellido Paterno" required>
                <input class="edit_info" type="text" name="apellido_materno" id="apellido_materno" placeholder="Apellido Materno" required>
                <input class="edit_info" type="text" name="carnet_identidad" id="carnet_identidad" placeholder="Carnet de identidad" required>
                <input class="edit_info" type="text" name="telefono" id="telefono" placeholder="Teléfono" required>
            </div>

            <h1 class="seccion_forms">Datos del empleado</h1>
            <div class="form_group">
                <!-- Cambiado a tipo 'date' -->
                <input class="edit_info" type="date" name="fecha_contratacion" placeholder="Fecha Contratación" required>
                <input class="edit_info" type="text" name="salario" placeholder="Salario" required>
                <select class="edit_info" id="turno" name="turno">
                    <option value="" disabled selected>Selecciona un turno</option>
                    <option value="34">Mañana</option>
                    <option value="35">Tarde</option>
                    <option value="36">Noche</option>
                </select>
            </div>
            
            <button type="submit" class="boton_guardar_cambios">Añadir empleado</button>
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
    function verificarCorreo() {
        var email = document.querySelector("input[name='email']").value;
        
        if (email) {
            $.ajax({
                url: "{{ route('verificar.correo') }}", // Ruta de la verificación del correo
                type: "GET",
                data: { correo: email },
                success: function (response) {
                    if (response.exists) {
                        // Si el correo existe, puedes mostrar un mensaje o cargar los datos
                        alert('El correo ya está registrado');
                        // Aquí puedes cargar datos en los campos si quieres autofill
                    }
                }
            });
        }
    }
</script>

