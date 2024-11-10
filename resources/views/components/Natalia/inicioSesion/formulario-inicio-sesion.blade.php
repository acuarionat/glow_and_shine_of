<link rel="stylesheet" href="\css\formularioInicioSesion.css">


<div class="contenedor_formulario_inicio_sesion">
    <form class="formulario_inicio_sesion" action="{{route('account.authenticate')}}" method="POST">
        @csrf
        
            <input type="email" id="correo" name="email" value="{{ old('email') }}" placeholder="Correo electrónico" required > 
            @error('email')
            <p class="invalid-feedback">{{$message}}</p>
            @enderror
            <input type="password" id="clave" name="password" placeholder="Contraseña" required>
            @error('password')
            <p class="invalid-feedback">{{$message}}</p>
            @enderror
            <button type="submit">Iniciar Sesión</button>
    </form>
</div>

