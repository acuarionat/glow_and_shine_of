<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/Header.css">
    <title>Document</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

</head>

<body>

    <header>
        <div class="navbar">
            <div class="logo"><a href="../"> <img src="{{ asset('images/zi.jpg') }}" alt="Logo"></a></div>
            <ul class="links">
                <li><a href="../">Inicio</a></li>
                <li><a href="../about">Nosotros</a></li>
                @if (Auth::check())
                <li><a href="../Favoritos">Favoritos</a></li>
                @endif
                <li><a href="../catalogo">Catálogos</a></li>
               <li><a href="../contactanos">Contactanos</a></li>

            </ul>
            <div>
                @if (Auth::check())
                    @php
                        $user = Auth::user(); 
                        $userId = $user->id; 
                        $userRole = $user->rol->nombre_rol;
                       
                    @endphp
                    <a href="{{ $userRole == 'cliente' ? url('account/dashboard/' . $userId) : ($userRole == 'empleado' ? url('account/dashboardEmpleado/' . $userId) : url('account/dashboardAdmin/' . $userId)) }}" class="action_btn">
                        <i class="fa-solid fa-user"></i> 
                    </a>
                @else
                    <a href="../account/login" class="action_btn">Iniciar Sesion</a>
                    <a href="../account/register" class="action_btn">Registrarse</a>
                @endif
            </div>
            
            <div class="toggle_btn">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>

        <div class="dropdown_menu">
            <li><a href="../">Inicio</a></li>
            <li><a href="../about">Nosotros</a></li>

     @if (Auth::check())
                <li><a href="../Favoritos">Favoritos</a></li>
                @endif
                <li><a href="../catalogo">Catalogos</a></li>
               <li><a href="../contactanos">Contactanos</a></li>
 <div>
    @if (Auth::check())
        <a href="{{ url('account/dashboard/' . Auth::user()->id) }}" class="action_btn">
            <i class="fa-solid fa-user"></i> <!-- Ícono de perfil -->
        </a>
    @else
        <a href="../account/login" class="action_btn">Iniciar Sesion</a>
        <a href="../account/register" class="action_btn">Registrarse</a>
    @endif
</div>
        </div>
    </header>

    <script>
        const toggleBtn = document.querySelector('.toggle_btn')
        const toggleBtnIcon = document.querySelector('.toggle_btn i')
        const dropDownMenu = document.querySelector('.dropdown_menu')

        toggleBtn.onclick = function() {
            dropDownMenu.classList.toggle('open')
            const isOpen = dropDownMenu.classList.contains('open')

            toggleBtnIcon.classList = isOpen ?
                'fa-solid fa-xmark' :
                'fa-solid fa-bars'
        }

   

    </script>
    

</body>

</html>
