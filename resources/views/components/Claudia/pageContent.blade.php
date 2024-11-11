<link rel="stylesheet" href="{{ asset('css/pageContent.css') }}">

    <section class="container_perfil_administrador">
        
        <x-Claudia.mensajeBienvenidaDash :mensajeB="$mensajeB" :user="$user"/>
        <x-Claudia.contenedorOpcionesA :cantidad="$cantidad"/>
        
        
    </section>
