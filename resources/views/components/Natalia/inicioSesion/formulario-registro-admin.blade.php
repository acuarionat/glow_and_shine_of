<link rel="stylesheet" href="\css\formularioRegistro.css">

<div class="contenedor_formulario_registro">
    <form class="formulario_registro" action="{{ route('account.processRegistrationAdmin') }}" method="POST">
        @csrf
        <div class="contenedor_inputs">
            <input type="name" id="name" name="name" placeholder="Nombre de Usuario" required value="{{ old('name') }}">
            @error('name')
            <p class="invalid-feedback">{{$message}}</p>
            @enderror

            <input type="email" id="correo" name="email" placeholder="Correo electrónico" required title="Debe ser un correo de Gmail" value="{{ old('email') }}">
            @error('email')
            <p class="invalid-feedback">{{$message}}</p>
            @enderror

            <input type="password" id="clave" name="password" placeholder="Contraseña" required title="Debe tener al menos 8 caracteres">
            @error('password')
            <p class="invalid-feedback">{{$message}}</p>
            @enderror

            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirma la Contraseña" required>
            @error('password_confirmation')
            <p class="invalid-feedback">{{$message}}</p>
            @enderror

         
        </div>
        <div class="contenedor_botones">
            <select id="role" name="role" required>
                <option value="" disabled selected>Seleccionar rol</option>
                <option value="1">Cliente</option>
                <option value="2">Empleado</option>
            </select>
            @error('role')
            <p class="invalid-feedback">{{$message}}</p>
            @enderror
            <button class="contra" type="button" onclick="generarContrasena()">Generar Contraseña</button>
            <button class="enviar" type="submit">Registrar</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function generarContrasena() {
    var nombre = document.getElementById("name").value;
    var email = document.getElementById("correo").value;

    if (nombre && email) {
        var parteEmail = email.split("@")[0]; 
        var randomNum = Math.floor(Math.random() * 1000);

       
        var contrasenaSugerida = nombre.substring(0, 3) + parteEmail.substring(0, 3) + randomNum;

       
        document.getElementById("clave").value = contrasenaSugerida;
        document.getElementById("password_confirmation").value = contrasenaSugerida;

       
        Swal.fire({
            title: 'Contraseña Sugerida',
            text: 'Tu contraseña sugerida es: ' + contrasenaSugerida,
            icon: 'info',
            confirmButtonText: 'Aceptar',
            customClass: {
                popup: 'custom-popup', 
                confirmButton: 'custom-confirm-button' 
            }
        });
    } else {
        Swal.fire({
            title: 'Error',
            text: 'Por favor, ingresa el nombre de usuario y correo electrónico para generar una contraseña.',
            icon: 'error',
            confirmButtonText: 'Aceptar',
            customClass: {
                popup: 'custom-popup', 
                confirmButton: 'custom-confirm-button' 
            }
        });
    }
}
</script>
