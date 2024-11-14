<link rel="stylesheet" href="{{ asset('css/registrarEmpleado.css') }}">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<section class="container_registrar_empleados">

<div class="cotenedor_registrar_e">
            <h1> EDITAR INFORMACION DEL CLIENTE</h1>
        </div>

<div class="container_form_registro"  >
    <form action="{{ route('clientes.actualizar') }}" method="POST">
        @csrf
        @method('PUT')
        
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <input class="edit_info" type="hidden" name="id_cliente" value="{{ $clientes->id_cliente}}">
        

        <h1 class="seccion_forms">Informacion Personal</h1>
        <div class="form_group">
        <!-- Campos del formulario para editar -->
            <input class="edit_info" type="text" name="correo" value="{{ $clientes->correo_electronico }}" placeholder="Correo electrónico" required>
            <input class="edit_info" type="text" name="nombres" value="{{ $clientes->nombres }}" placeholder="Nombres" required>
            <input class="edit_info" type="text" name="apellido_paterno" value="{{ $clientes->apellido_paterno }}" placeholder="Apellido Paterno" required>
            <input class="edit_info" type="text" name="apellido_materno" value="{{ $clientes->apellido_materno }}" placeholder="Apellido Materno" required>
            <input class="edit_info" type="text" name="carnet_identidad" value="{{ $clientes->ci_persona }}" placeholder="Carnet de identidad" required>
        </div>

        <h1 class="seccion_forms">Datos del cliente</h1>
        <!-- Otros campos -->
        <div class="form_group">
            <input class="edit_info" type="text" name="porcentaje_descuento" value="{{ $clientes->porcentaje_descuento }}" required>
            
            <select class="edit_info" name="turno" required >
                <option value="52" {{ $clientes->tipo_cliente == 52 ? 'selected' : '' }}>Minorista</option>
                <option value="53" {{ $clientes->tipo_cliente == 53 ? 'selected' : '' }}>Mayorista</option>
                <option value="54" {{ $clientes->tipo_cliente == 54 ? 'selected' : '' }}>Promotores</option>
            </select>
        </div>

    <button type="submit" class="boton_guardar_cambios">Guardar cambios</button>

    
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