<link rel="stylesheet" href="{{ asset('css/editarPerfil.css') }}">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<div class="contenedor_edit">
    
    <a href="{{ url('dashboard/editarPerfil/' . $user->id) }}" class="editar_cuenta">Editar información</a>
</div>