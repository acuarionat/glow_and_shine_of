<link rel="stylesheet" href="\css\formularioContactanos.css">
<div class="contenedor_formulario_contactanos">
    <h3 class="texto_contactanos">¿Tienes alguna consulta?</h3>
    <br/>
    <form class="formulario" action="https://formspree.io/f/mpwzawzw" method="POST">
        <label for="nombre">Nombre Completo</label>
        <input type="text" id="nombre" name="nombre">

        <label for="correo">Correo Electrónico</label>
        <input type="email" id="correo" name="correo">

        <label for="telefono">Teléfono</label>
        <input type="text" id="telefono" name="telefono">

        <label for="consulta">Consulta</label>
        <textarea id="consulta" name="consulta" rows="6" ></textarea>

        <button type="submit">Enviar Consulta</button>
    </form>
</div>