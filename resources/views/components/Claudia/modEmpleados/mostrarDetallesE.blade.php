<link rel="stylesheet" href="{{ asset('css/mostrarDetallesE.css') }}">

<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<section class="container_registrar_empleados">

    <div class="cotenedor_registrar_e">
        <h1> INFORMACION DEL EMPLEADO {{ $empleados->nombres }}</h1>
    </div>

    <div class="container_form_registro">


        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <input class="edit_info" type="hidden" name="id_empleado" value="{{ $empleados->id_empleado }}">

        <h1 class="seccion_forms">Informacion Personal</h1>
        <div class="form_group">

            <div class="container_llenado">
                <label class="subtitle" for="correo">Correo Electrónico</label>
                <p class="edit_info">{{ $empleados->correo_electronico }}</p>
            </div>
            <div class="container_llenado">
                <label class="subtitle" for="nombres">Nombres</label>
                <p class="edit_info">{{ $empleados->nombres }}</p>
            </div>
            <div class="container_llenado">
                <label class="subtitle" for="apellido_paterno">Apellido Paterno</label>
                <p class="edit_info">{{ $empleados->apellido_paterno }}</p>
            </div>

            <div class="container_llenado">
                <label class="subtitle" for="apellido_materno">Apellido Materno</label>
                <p class="edit_info">{{ $empleados->apellido_materno }}</p>
            </div>
            <div class="container_llenado">
                <label class="subtitle" for="carnet_identidad">Carnet de Identidad</label>
                <p class="edit_info">{{ $empleados->ci_persona }}</p>
            </div>
            <div class="container_llenado">
                <label class="subtitle" for="fecha_nacimiento">Fecha de Nacimiento</label>
                <p class="edit_info">{{ $empleados->fecha_nacimiento ?? 'Sin definir'}}</p>
            </div>
            <div class="container_llenado">
                <label class="subtitle" for="genero">Genero</label>
                <p class="edit_info">{{ $empleados->genero_descripcion ?? 'Sin definir' }}</p>
            </div>
            <div class="container_llenado">
                <label class="subtitle" for="estado_civil">Estado Civil</label>
                <p class="edit_info">{{ $empleados->estado_civil_descripcion ?? 'Sin definir' }}</p>
            </div>
            <div class="container_llenado">
                <label class="subtitle" for="telefono">Telefono</label>
                <p class="edit_info">{{ $empleados->telefono ?? 'Sin definir'}}</p>
            </div>
            <div class="container_llenado">
                <label class="subtitle" for="direccion">Direccion</label>
                <p class="edit_info">{{ $empleados->direccion ?? 'Sin definir'}}</p>
            </div>

        </div>

        <h1 class="seccion_forms">Datos del empleado</h1>

        <div class="form_group">
            <div class="container_llenado">
                <label class="subtitle" for="fecha_contratacion">Fecha contratación</label>
                <p class="edit_info">{{ $empleados->fecha_contratacion }}</p>
            </div>

            <div class="container_llenado">
                <label class="subtitle" for="Salario">Salario</label>
                <p class="edit_info">{{ $empleados->salario }}</p>
            </div>
            <div class="container_llenado">
                <label class="subtitle" for="Turno">Turno</label>
                <p class="edit_info">
                    {{ $empleados->turno == 44 ? 'Mañana' : ($empleados->turno == 45 ? 'Tarde' : 'Noche') }}
                </p>
            </div>

        </div>


        <h1 class="seccion_forms">Datos academicos</h1>

        <div class="form_group">
            <div class="container_llenado">
                <label class="subtitle" for="nivel_academico">Nivel Academico</label>
                <p class="edit_info">{{ $datosAcademicos->nivel_academico_descripcion ?? 'Sin definir' }}</p>
            </div>

            <div class="container_llenado">
                <label class="subtitle" for="especialidad_academica">Especialidad Academica</label>
                <p class="edit_info">{{ $datosAcademicos->especialidad_academica_descripcion ?? 'Sin definir' }}</p>
            </div>

        </div>


    </div>

</section>