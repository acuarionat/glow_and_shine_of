<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/CardNewArrivals.css">
    <title>Productos recién llegados</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
</head>

<body>

    <div class="section_scroll">
        @foreach ($recienLlegados as $producto)
            <a href="/producto/{{ $producto->id_producto }}">
                <div class="product_card">

                    <!--<div class="discount_badge">
                        16% OFF
                    </div>-->

                    <div class="product_image">
                        <img src="{{ $producto->url_imagen }}" alt="{{ $producto->nombre }}">
                    </div>

                    <h3 class="product_brand">{{ $producto->nombre }}</h3> <!-- Se mantiene el nombre del producto -->

                    <div class="product_price">
                        <span class="current_price">Bs. {{ number_format($producto->precio, 2) }}</span> <!-- Se formatea el precio a dos decimales -->
                    </div>

                </div>
            </a>
        @endforeach
    </div>

</body>

</html>
