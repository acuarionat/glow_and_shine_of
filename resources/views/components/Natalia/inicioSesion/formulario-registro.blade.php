<link rel="stylesheet" href="\css\formularioRegistro.css">

<div class="contenedor_formulario_registro">
    <form class="formulario_registro" action="{{route('account.processRegistration')}}" method="POST">
            @csrf
            <input type="name" id="name" name="name" placeholder="Nombre de Usuario" required>
            @error('name')
            <p class="invalid-feedback">{{$message}}</p>
            @enderror
            <input type="email" id="correo" name="email" placeholder="Correo electrónico" required>
            @error('email')
            <p class="invalid-feedback">{{$message}}</p>
            @enderror
            <input type="password" id="clave" name="password" placeholder="Contraseña" required>
            @error('password')
            <p class="invalid-feedback">{{$message}}</p>
            @enderror
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirma la Contraseña" required>
            @error('password')
            <p class="invalid-feedback">{{$message}}</p>
            @enderror
            <button type="submit">Registrar</button>        
    </form>
</div>