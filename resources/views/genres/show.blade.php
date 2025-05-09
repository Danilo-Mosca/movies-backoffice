{{-- per indicare che questa pagina utilizza il layout master dobbiamo usare la parola extends: --}}
@extends('layouts.movies')

{{-- Restituisco il titolo della pagina con il metodo abbreviato: --}}
@section('title', $genre->name)

{{-- Sezione della pagina personalizzata chiamata "content" nel layout: --}}
@section('content')
    {{-- @dump($genre) --}}

    {{-- Inserendo i tag <x-nome_componente>...</x-nome_componente> inserisco un componente, in questo caso inserisco il componente card che conterrà il jumbotron e nel caso, se ci troviamo nella pagina show dei film, anche l'immagine poster del film selezionato (<x-jumbotron> </x-jumbotron>): --}}
    <x-jumbotron>
    </x-jumbotron>


    {{-- ---------- Sessione temporanea che mostra una notifica, un alert con un messaggio di successo nel caso in cui un film viene inserito con successo ----------  --}}
    <div class="mt-3 pt-3">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
    {{-- ---------- Fine sessione temporanea che mostra una notifica, un alert con un messaggio di successo nel caso in cui un film viene inserito con successo ----------  --}}


    <div class="container-fluid mt-5 mb-3">

        <h3>GENERI</h3>
        <p>Scheda dei generi</p>
        <hr />


        {{-- --------- Sezione Pulsanti modifica ed elimina --------- --}}
        <div class="d-flex flex-wrap justify-content-start pt-3 gap-3">
            <button class="btn-modifica"><a href="{{ route('genres.edit', $genre) }}">Modifica</a></button>
            {{-- Per il DELETE non possiamo usare un link perchè i link chiamano sempre un metodo get, questo invece deve essere un metodo delete, allora lo facciamo tramite un form nascosto nel pulsante di conferma: --}}
            <button type="button" id="delete" data-bs-toggle="modal" data-bs-target="#exampleModal">Elimina</button>
        </div>
        {{-- --------- End sezione Pulsanti modifica ed elimina --------- --}}


        {{-- ------------------- Sezione dettagli attore: ------------------- --}}
        <div class="card shadow-sm my-5">
            <div class="card-header bg-dark text-white">
                <i class="bi bi-camera-reels me-3"></i>
                <span>{{ strtoupper('genere') . ': ' }}</span>
                <span class="show-movies">{{ strtoupper($genre->name) }}</span>
            </div>

            <div class="card-body">
                <div class="fs-2 my-4"><i class="fa-solid fa-film me-3" style="max-width: 20px;"></i>{{ $genre->name }}
                </div>


                <div class="mb-2 d-flex py-1 border-bottom">
                    <i class="fa-solid fa-video me-3" style="max-width: 20px; color: {{ $genre->color }};"></i>
                    <div class="fw-bold w-50" style="color: {{ $genre->color }};">Genere:</div>
                    <div class="fw-bolder" style="color: {{ $genre->color }}">{{ $genre->name }}</div>
                </div>


                <div class="mb-2 py-1 border-bottom row">
                    <div class="col-12 col-lg-3">
                        <i class="fa-solid fa-file-video me-3" style="max-width: 18px;"></i>
                        <span class="fw-bold w-50">Descrizione:&nbsp;</span>
                    </div>
                    <div class="fw-bolder col-12 col-lg-9" style="color: #DB2B39;">
                        {{ isset($genre->genre_description) == null ? 'Descrizione non inserita' : $genre->genre_description }}
                    </div>
                </div>



            </div>
        </div>
        {{-- ------------------- Fine sezione dettagli attore: ------------------- --}}

        <p class="d-flex justify-content-center"><i class="fa fa-film" style="font-size: 20px; color: black;"></i></p>
    </div>
@endsection





<!-- Modale richiamato dal pulsante "Elimina" -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Informazione</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Vuoi davvero eliminare l'attore?</p>
            </div>
            <div class="modal-footer">
                <button type="button" data-bs-dismiss="modal">Annulla</button>
                {{-- Per il DELETE non possiamo usare un link perchè i link chiamano sempre un metodo get, questo invece deve essere un metodo delete, allora lo facciamo tramite un form nascosto nel pulsante di conferma: --}}
                <form action="{{ route('genres.destroy', $genre) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="modal-delete" value="Elimina">
                    {{-- Ma anche questa è equivalente: 
                            <button class="btn btn-outline-danger">Elimina</button>
                        --}}
                </form>
            </div>
        </div>
    </div>
</div>

</html>
