{{-- Importo la risorse create.js contentente le funzioni javascript da usare per questa pagina e il CSS personalizzato contenuto nel file "create.scss" --}}
@vite(['resources/js/create.js', 'resources/sass/partials/create.scss'])

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
        <hr class="mb-5"/>

        {{-- ------------------- Sezione form aggiungi un film: ------------------- --}}
        <section>
            <form action="{{ route('movies.store') }}" method="POST">
                {{-- Inserisco il token che verifica che la chiamata avviene tramite un form del sito: --}}
                @csrf

                <div class="form-control mb-3 d-flex flex-column input-wrapper">
                    <label for="title">* Titolo del film:</label>
                    <input type="text" name="title" id="title" class="input-layout" required>
                </div>


                <div class="form-control mb-3 d-flex flex-column input-wrapper">
                    <label for="description">* Descrizione:</label>
                    <textarea name="description" id="description" id="description" rows="5" class="input-layout" required></textarea>
                </div>


                {{-- Input number anno di rilascio film --}}
                <div class="form-control mb-3 input-wrapper d-flex flex-column">
                    <label for="release_year">* Anno di uscita:</label>
                    <input type="number" id="release_year" min="1900" name="release_year" placeholder="Esempio: 2025"
                        min="1900" class="input-layout" required />
                </div>
                {{-- Fine input number anno di rilascio film --}}


                {{-- Input number durata film --}}
                <div class="form-control mb-3 input-wrapper d-flex flex-column">
                    <label for="duration">* Durata (in minuti):</label>
                    <input type="number" id="duration" name="duration" placeholder="Es: 120" min="1" max="255"
                        class="input-layout" required>
                </div>
                {{-- Fine input number durata film --}}


                {{-- Input radio per i rating --}}
                <div class="form-control">
                    <label for="star">Inserisci un voto:</label><br>
                    <div class="star-rating mt-3 mb-3">
                        @for ($i = 5; $i >= 1; $i--)
                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}"
                                {{ old('rating') == $i ? 'checked' : '' }} data-stato-selezionato="false">
                            <label for="star{{ $i }}" title="{{ $i }} stelle"
                                class="bi bi-star-fill custom-star-label"></label>
                        @endfor
                    </div>
                </div>
                {{-- Input radio per i rating --}}


                {{-- Input del poster... che per ora lascio da parte --}}
                <div class="form-control mb-3 d-flex flex-column input-wrapper">
                    <p>Input poster per ora non utilizzare</p>
                </div>
                {{-- Fine Input del poster... che per ora lascio da parte --}}


                <div class="form-control mb-3 d-flex flex-column input-wrapper">
                    <label for="nationality">Nazionalità del film:</label>
                    <input type="text" name="nationality" id="nationality" class="input-layout" required>
                </div>

                {{-- Input radio per il regista --}}
                <div class="form-control mb-3 input-wrapper">
                    <label for="director_id">Seleziona il regista (se presente): Anche questa per ora lasciarla da
                        parte</label><br>
                    {{-- @foreach ($directors as $type)
                        <input type="radio" id="director_id{{ $director }}" name="director_id"
                            value="{{ $i }}">
                        <label for="director_id{{ $director }}" title="{{ $director }} stelle">Nome regista</label>
                    @endforeach --}}
                </div>
                {{-- Fine Input radio per il regista --}}


                <input type="submit" value="Salva" class="mt-3">
                {{-- Oppure:
                <button>Salva</button> --}}
            </form>
            <hr class="mt-5" />
        </section>
        {{-- ------------------- Fine sezione form aggiungi un film: ------------------- --}}


        <p class="d-flex justify-content-center"><i class="fa fa-film" style="font-size: 20px; color: black;"></i></p>
    </div>

@endsection

</html>
