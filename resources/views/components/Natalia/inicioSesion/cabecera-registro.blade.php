<link rel="stylesheet" href="\css\cabecera_registro.css">
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
<div class="cabecera">
    <h2 class="Bienvenido_h2_r">Bienvenido a G&S System</h2>
    <h2>¡Vamos a registrarte para que puedas crear tu espacio personalizado!</h2>
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
