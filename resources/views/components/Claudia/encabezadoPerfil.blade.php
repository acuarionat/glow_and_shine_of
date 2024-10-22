<link rel="stylesheet" href="{{ asset('css/encabezadoP.css') }}">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<div class="encabezado_p">
    
    <h1 class="saludo">
        {{$saludo}} {{ $user->name }}
    </h1>
</div>