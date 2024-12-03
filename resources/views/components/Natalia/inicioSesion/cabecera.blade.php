<link rel="stylesheet" href="\css\cabecera.css">
<div class="cabecera">
    <h2 class="Bienvenido_h2">Bienvenido a G&S System</h2>
    <style>
        .logito{
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 20px;
            margin-bottom: -20px;
        }
        .logito img{

            width: 70px;
            height: 70px;
        }
    </style>
    
    <h2>¡Vamos a iniciar sesión para acceder a tu espacio personalizado!</h2>
    <div class="logito">
        <img src="{{ asset('images/log.png') }}" alt="Logo">
    </div>
</div>
<div class="botones_navegacion">
    {{--<button class="uno">Inicar Sesión</button>
    <button class="dos">Registrarse</button>--}}
    <a href="login" class="uno">Iniciar Sesión</a>
    <a href="register" class="dos">Registrarse</a>
</div>