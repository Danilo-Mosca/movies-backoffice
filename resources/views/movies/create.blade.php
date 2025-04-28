{{-- per indicare che questa pagina utilizza il layout master dobbiamo usare la parola extends: --}}
@extends('layouts.movies')

{{-- Restituisco il titolo della pagina con il metodo abbreviato: --}}
@section('title', 'Aggiungi un film');

{{-- Sezione della pagina personalizzata chiamata "content" nel layout: --}}
@section('content')
    {{-- @dump($movies) --}}

    {{-- Inserendo i tag <x-nome_componente>...</x-nome_componente> inserisco un componente, in questo caso inserisco il componente card che conterrà il jumbotron e nel caso, se ci troviamo nella pagina show dei film, anche l'immagine poster del film selezionato (<x-jumbotron> </x-jumbotron>): --}}
    <x-jumbotron>
    </x-jumbotron>

    <div class="container-fluid mt-5 mb-3">

        <h3>AGGIUNGI UN FILM</h3>
        <p>* I dati riportati con l'asterisco sono obbligatori</p>
        <hr />

        {{-- ------------------- Sezione form aggiungi un film: ------------------- --}}
        <section>
            <form action="{{ route('movies.store') }}" method="POST">
                {{-- Inserisco il token che verifica che la chiamata avviene tramite un form del sito: --}}
                @csrf

                <div class="form-control mb-3 d-flex flex-column">
                    <label for="title">* Titolo del film:</label>
                    <input type="text" name="title" id="title" required>
                </div>

                <input type="submit" value="Salva">
                {{-- Oppure:
                <button>Salva</button> --}}
            </form>
        </section>
        {{-- ------------------- Fine sezione form aggiungi un film: ------------------- --}}


        <p class="d-flex justify-content-center"><i class="fa fa-film" style="font-size: 20px; color: black;"></i></p>
    </div>

@endsection

</html>
