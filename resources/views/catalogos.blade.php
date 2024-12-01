<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>G&S</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
    <style>

    </style>
</head>

<body>
    <x-app-layout>
        <div class="section catalog-section">
            <div class="section-content">
                <h2>Catálogos de Productos</h2>
                <p>Explora nuestros catálogos de productos para encontrar lo que necesitas. Puedes visualizar o descargar los documentos directamente.</p>
            </div>
            <div class="catalog-container">
                <!-- Catálogo 1 -->
                <div class="catalog-item">
                    <iframe src="css\catalogos\Catalogo_C9 (2).pdf"></iframe>
                    <a href="css\catalogos\Catalogo_C9 (2).pdf" download="Catálogo 1">
                        <i class="fas fa-download icon"></i> Descargar Catálogo 1
                    </a>
                </div>
                <!-- Catálogo 2 -->
                <div class="catalog-item">
                    <iframe src="css\catalogos\cyzone.bolivia.c13.2024.pdf"></iframe>
                    <a href="public\css\catalogos\cyzone.bolivia.c13.2024.pdf" download="Catálogo 2">
                        <i class="fas fa-download icon"></i> Descargar Catálogo 2
                    </a>
                </div>
                <div class="catalog-item">
                    <iframe src="css\catalogos\esika.bolivia.c13.2024.pdf"></iframe>
                    <a href="css\catalogos\esika.bolivia.c13.2024.pdf" download="Catálogo 3">
                        <i class="fas fa-download icon"></i> Descargar Catálogo 3
                    </a>
                </div>
            </div>
        </div>
        
    </x-app-layout>

</body>

</html>