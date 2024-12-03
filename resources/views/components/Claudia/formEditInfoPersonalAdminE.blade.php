<link rel="stylesheet" href="{{ asset('css/formEditInfoPersonal.css') }}">

<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<div class="container_form_registro">
    <h1 class="titulo_ip"> EDITA TU INFORMACIÓN PERSONAL</h1>
    <form action="{{ route('perfil.actualizarDatos') }}" method="POST" class="form_editar_info">
        @csrf
        @method('PUT')

        <div class="container_llenado">
            <label class="subtitle" for="nombre">Nombre</label>
            <input class="edit_info" type="text" name="nombre" value="{{ $persona->nombres }}" placeholder="Nombres" required>
            @error('nombre')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="container_llenado">
            <label class="subtitle" for="apellido_paterno">Apellido paterno</label>
            <input class="edit_info" type="text" name="apellido_paterno" placeholder="Apellido paterno" value="{{ $persona->apellido_paterno }}" required>
            @error('apellido_paterno')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="container_llenado">
            <label class="subtitle" for="apellido_materno">Apellido materno</label>
            <input class="edit_info" type="text" name="apellido_materno" placeholder="Apellido materno" value="{{ $persona->apellido_materno }}">

        </div>
        <div class="container_llenado">
            <label class="subtitle" for="ci">Carnet de identidad</label>
            <input class="edit_info" type="text" name="ci" placeholder="CI" value="{{ $persona->ci_persona }}" required>

        </div>
        <div class="container_llenado">
            <label class="subtitle" for="fecha_nacimiento">Fecha de nacimiento</label>
            <input class="edit_info" type="date" name="fecha_nacimiento" placeholder="Fecha de nacimiento" value="{{ $persona->fecha_nacimiento }}">

        </div>

        <div class="container_llenado">
            <label class="subtitle" for="email">Correo electronico</label>
            <input class="edit_info" type="email" name="correo_electronico" value="{{ $persona->correo_electronico }}" placeholder="Correo Electrónico" required>

        </div>

        <div class="container_llenado">
            <label class="subtitle" for="direccion">Dirección</label>
            <input class="edit_info" type="text" name="direccion" placeholder="direccion" value="{{ $persona->direccion }}">

        </div>
        <div class="container_llenado">
            <label class="subtitle" for="telefono">Telefono</label>
            <input class="edit_info" type="text" name="telefono" placeholder="Telefono" value="{{ $persona->telefono }}">

        </div>
        <div class="container_llenado">
            <label class="subtitle" for="genero">Genero</label>
            <select class="edit_info" name="genero">
                <option value="" disabled selected>Selecciona tu genero</option>
                <option value="45" {{ $persona->genero == 45 ? 'selected' : '' }}>Femenino</option>
                <option value="46" {{ $persona->genero == 46 ? 'selected' : '' }}>Masculino</option>
                <option value="47" {{ $persona->genero == 47 ? 'selected' : '' }}>Otro</option>
            </select>
        </div>
        <div class="container_llenado">
            <label class="subtitle" for="estado_civil">Estado Civil </label>
            <select class="edit_info" name="estado_civil">
                <option value="" disabled selected>Selecciona tu estado civil</option>
                <option value="48" {{ $persona->estado_civil == 48 ? 'selected' : '' }}>Soltero/a</option>
                <option value="49" {{ $persona->estado_civil == 49 ? 'selected' : '' }}>Casado/a</option>
                <option value="50" {{ $persona->estado_civil == 50 ? 'selected' : '' }}>Divorciado/a</option>
                <option value="51" {{ $persona->estado_civil == 51 ? 'selected' : '' }}>Viudo/a</option>
            </select>
        </div>

        <div class="container_llenado">
            <label class="subtitle" for="nivel_academico">Nivel Academico</label>
            <select class="edit_info" name="nivel_academico">
                <option value="{{ $datosAcademicos->nivel_academico }}" disabled selected>Selecciona el nivel academico</option>
                <option value="37" {{ $datosAcademicos->nivel_academico == 37 ? 'selected' : '' }}>Bachillerato</option>
                <option value="38" {{ $datosAcademicos->nivel_academico == 38 ? 'selected' : '' }}>Licenciatura</option>
                <option value="39" {{ $datosAcademicos->nivel_academico == 39 ? 'selected' : '' }}>Maestria</option>
            </select>
        </div>

        <div class="container_llenado">
            <label class="subtitle" for="especialidad_academica">Especialidad Academica</label>
            <select class="edit_info" name="especialidad_academica">
                <option value="{{ $datosAcademicos->especialidad_academica}}" disabled selected>Selecciona la especialidad academica</option>
                <option value="40" {{ $datosAcademicos->especialidad_academica == 40 ? 'selected' : '' }}>Administración</option>
                <option value="41" {{ $datosAcademicos->especialidad_academica == 41 ? 'selected' : '' }}>Química cosmética</option>
            </select>
        </div>


        <div class="cont_boton_editE">

            <button type="submit" class="boton_guardar_cambios">Guardar cambios</button>
        </div>
    </form>



</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
    Swal.fire({
        title: 'Informacion actualizada correctamente',
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
        title: 'Error de actualización',
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