<link rel="stylesheet" href="{{ asset('css/pageContent.css') }}">
@props(['cantidadDatos','mensajeB','user'])


    <section class="container_perfil_administrador">
        
        <x-Claudia.mensajeBienvenidaDash :mensajeB="$mensajeB" :user="$user"/>
        <x-Claudia.contenedorOpcionesA 
        :cantidadDatos="$cantidadDatos" 
/>
        
        
    </section>
