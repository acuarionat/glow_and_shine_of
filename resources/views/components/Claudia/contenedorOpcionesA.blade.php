<link rel="stylesheet" href="{{ asset('css/contenedorOpcionesA.css') }}">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
@props(['cantidadDatos','titulo','imagen'])

<div class="contenedor_botones_opciones">
    @foreach($cantidadDatos as $key => $cantidad)
        <x-Claudia.opcionesDashboard 
            :titulo="$key" 
            :imagen="'images/'.strtolower($key).'.png'" 
            :cantidad="$cantidad"
        />
    @endforeach
</div>
