<link rel="stylesheet" href="{{ asset('css/ScrollReview.css') }}">


@props(['resenas'])
<div class="review_scroll">
    @foreach($resenas as $resena)
        <x-Aldahir.CardReviews 
            :calificacion="$resena->calificacion"
            :comentario="$resena->comentario"
            :fechaResena="$resena->fecha_resena"
        />
    @endforeach
</div>