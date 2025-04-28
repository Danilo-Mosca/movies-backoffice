{{-- per indicare che questa pagina utilizza il layout master dobbiamo usare la parola extends: --}}
@extends('layouts.movies')

{{-- Restituisco il titolo della pagina con il metodo abbreviato: --}}
@section('title', $movie->title)

{{-- Sezione della pagina personalizzata chiamata "content" nel layout: --}}
@section('content')
    {{-- @dump($movie) --}}

    {{-- Inserendo i tag <x-nome_componente>...</x-nome_componente> inserisco un componente, in questo caso inserisco il componente card che conterrà il jumbotron e nel caso, se ci troviamo nella pagina show dei film, anche l'immagine poster del film selezionato (<x-jumbotron> </x-jumbotron>): --}}
    <x-jumbotron>
        <x-slot:image>{{ $movie->poster }}</x-slot:image>
        <x-slot:title>{{ $movie->title }}</x-slot:title>
    </x-jumbotron>


    <div class="container-fluid mt-5 mb-3">

        <h3>FILM</h3>
        <p>Scheda tecnica del film</p>
        <hr />

        {{-- ------------------- Sezione dettagli del film: ------------------- --}}
        <div class="mt-5 film-details">
            <h3 class="pb-3">
                <i class="fa-solid fa-film"></i>
                <span>{{ strtoupper('titolo') . ': ' }}</span>
                <span class="show-movies">{{ strtoupper($movie->title) }}</span>
            </h3>

            {{-- Con i tag {!! !!} al posto dei {{ }} inietto codice HTML non-escapato. Usando {!! !!} sto dicendo a Laravel: "Fidati di questo contenuto, non filtrarlo" .Soluzione valida ma poco sicura: --}}
            <p class="pb-3">
                <i class="fa-regular fa-calendar-days" style="color: black;"></i>
                {!! '<strong style="font-size: 22px; color: black;">Anno di uscita: </strong>' .
                    '<span class="show-movies">' .
                    $movie->release_year .
                    '</span>' !!}
            </p>

            <p class="pb-3">
                <i class="fa-solid fa-clock" style="color: #000000;"></i>
                <span style="font-size: 22px; font-weight: 400; color: black;">Durata:</span>
                <span class="show-movies">{{ $movie->duration }}</span>
            </p>

            {{-- Sezione stelle per voto inserito --}}
            <div class="pb-4" style="font-size: 22px; font-weight: 400; color: black;">
                <i class="fa-solid fa-star" style="font-size: 20px;"></i> Voto:
                <!-- Ciclo che controlla il voto inserito e stampa a schermo le stelle piene, mezze o vuote in base ad esso -->
                @for ($i = 1; $i <= 5; $i++)
                    @if ($movie->rating >= $i)
                        <i class="fas fa-star no-space-rating" style="color: #DB2B39;"></i> <!-- Stella piena -->
                    @elseif ($movie->rating >= $i - 0.5)
                        <i class="fas fa-star-half-alt no-space-rating" style="color: #DB2B39;"></i> <!-- Mezza stella -->
                    @else
                        <i class="far fa-star no-space-rating" style="color: #DB2B39;"></i> <!-- Stella vuota -->
                    @endif
                @endfor
                <span class="ms-2" style="color: #DB2B39;">({{ $movie->rating }})</span>
            </div>
            {{-- Fine sezione stelle per voto inserito --}}

            <p class="pb-3">
                <i class="fa-solid fa-location-dot" style="color: black;"></i>
                <span style="font-size: 22px; font-weight: 400; color: black;">Nazionalità:</span>
                <span class="show-movies">{{ $movie->nationality }}</span>
            </p>

            <p class="pb-3">
                <i class="fa-solid fa-video" style="color: black;"></i>
                <span style="font-size: 22px; font-weight: 400; color: black;">Regista:</span>
                <span class="show-movies">{{ $movie->director_id }}</span>
            </p>

            <h3><i class="fa-solid fa-pencil"></i> Descrizione:</h3>
            <p>{{ $movie->description }}</p>

            <hr class="mt-5" />
        </div>
        {{-- ------------------- Fine sezione dettagli del film: ------------------- --}}


        <p class="d-flex justify-content-center"><i class="fa fa-film" style="font-size: 20px; color: black;"></i></p>
    </div>

@endsection

</html>
