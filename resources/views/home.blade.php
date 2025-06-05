{{-- per indicare che questa pagina utilizza il layout master dobbiamo usare la parola extends: --}}
@extends('layouts.movies')

{{-- Restituisco il titolo della pagina con il metodo abbreviato: --}}
@section('title', 'Homepage')

{{-- Sezione della pagina personalizzata chiamata "content" nel layout: --}}
@section('content')

    {{-- @dump($numMovies);
    @dump($numDirectors);
    @dump($numActors);
    @dump($numGenres); --}}

    <h1 class="pt-3 pb-3">Lista di riepilogo database</h1>
    <p class="pb-5">Riepilogo dei dati contenuti nel database:</p>

    <div>
        <p class="film-counter pb-3">Nel database sono presenti complessivamente: <span class="number-film-counter" style="font-size: 22px">{{ $numMovies }} film</span></p>
        <p class="film-counter pb-3">Nel database sono presenti complessivamente: <span class="number-film-counter" style="font-size: 22px">{{ $numGenres }} generi di film</span></p>
        <p class="film-counter pb-3">Nel database sono presenti complessivamente: <span class="number-film-counter" style="font-size: 22px">{{ $numDirectors }} registi</span></p>
        <p class="film-counter pb-3">Nel database sono presenti complessivamente: <span class="number-film-counter" style="font-size: 22px">{{ $numActors }} attori</span></p>
    </div>

@endsection
