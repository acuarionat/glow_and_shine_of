<link rel="stylesheet" href="{{ asset('css/formularioR.css') }}">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<div class="form_registro"  >
    <form action="{{route('account.processRegistration')}}" method="POST" class="form">
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