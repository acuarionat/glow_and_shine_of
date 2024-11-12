<link rel="stylesheet" href="{{ asset('css/CardReviews.css') }}">

@props(['calificacion', 'comentario', 'fechaResena'])

<div class="container_card">
<div class="review_card">
    <div class="review_text">
        <span class="stars">
            @for ($i = 1; $i <= 5; $i++)
                <span style="color: {{ $i <= $calificacion ? '#FFD700' : '#ccc' }}">★</span>
            @endfor
        </span>
        <p>{{ $comentario }}</p>
        <small>Fecha: {{ $fechaResena }}</small>
    </div>
</div>

</div>
