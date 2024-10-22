<link rel="stylesheet" href="/css/ScrollReview.css">

<div class="review_scroll">
    @for ($i = 0; $i < 7; $i++)
        <x-Aldahir.Cardreviews>
            Reviews {{ $i + 1 }}
        </x-Aldahir.CardReviews>
    @endfor
</div>
