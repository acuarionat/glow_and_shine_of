<link rel="stylesheet" href="/css/Home.css">

<x-app-layout>
    <section class="container_general">
        <x-Aldahir.Banner />

        <div class="container_section_general">
            <x-Aldahir.TSubtitle>
                <span>★</span> CATEGORIAS <span>★</span>
            </x-Aldahir.TSubtitle>
            <x-Aldahir.ScrollContainer/>           
        </div>

        <div class="container_section_general">
            <x-Aldahir.TSubtitle>
                <span>★</span> MAS VENDIDOS <span>★</span>
            </x-Aldahir.TSubtitle>

            <x-Aldahir.CardMostSold :productosMasVendidos='$productosMasVendidos' />

        </div>

        <div class="container_section_general">
            <x-Aldahir.TSubtitle>
                <span>★</span> RECIEN LLEGADO <span>★</span>
            </x-Aldahir.TSubtitle>

            <x-Aldahir.CardNewArrivals :recienLlegados='$recienLlegados'/>

        </div>
        <x-Aldahir.TSubtitle>
            <span>★</span> CONSEJO DEL DÍA <span>★</span>
        </x-Aldahir.TSubtitle>
        <img src="/images/image.png" alt="">

        <div class="container_section_general">
            <x-Aldahir.TSubtitle>
                <span>★</span> MARCAS <span>★</span>
            </x-Aldahir.TSubtitle>

            <x-Aldahir.ScrollBrand />
        </div>

        <div class="container_section_general">
            <x-Aldahir.TSubtitle>
                <span>★</span> RESEÑAS <span>★</span>
            </x-Aldahir.TSubtitle>

            <x-Aldahir.ScrollReview />
        </div>


    </section>
</x-app-layout>