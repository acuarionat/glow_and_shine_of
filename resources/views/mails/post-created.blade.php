<x-mail::message>
    <x-slot name="header">
        <h1>¡Hola {{ $nombre }}!</h1>
    </x-slot>

    <p>Tu cuenta ha sido creada exitosamente, visita nuestra pagina web para disfrutar las ventajas de formar parte de nuestra familia</p>
    <p><strong>Correo Electrónico:</strong> {{ $email }}</p>
    <p><strong>Contraseña Generada:</strong> {{ $contrasenaSugerida }}</p>
    <p>Por favor, inicia sesión y cambia tu contraseña para mayor seguridad.</p>
<p>Gracias,</p>
<p>El equipo de Glow and Shine</p>

    <x-slot name="footer">
        <p>Glow and Shine - Todos los derechos reservados.</p>
    </x-slot>
</x-mail::message>