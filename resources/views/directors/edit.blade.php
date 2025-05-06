{{-- Importo la risorse create.js contentente le funzioni javascript da usare per questa pagina e il CSS personalizzato contenuto nel file "create.scss" --}}
@vite(['resources/js/createEdit.js', 'resources/sass/partials/createEdit.scss'])

{{-- per indicare che questa pagina utilizza il layout master dobbiamo usare la parola extends: --}}
@extends('layouts.movies')

{{-- Restituisco il titolo della pagina con il metodo abbreviato: --}}
@section('title', 'Modifica ' . $director->last_name)

{{-- Sezione della pagina personalizzata chiamata "content" nel layout: --}}
@section('content')
    {{-- @dump($directors) --}}

    {{-- Inserendo i tag <x-nome_componente>...</x-nome_componente> inserisco un componente, in questo caso inserisco il componente card che conterrà il jumbotron e nel caso, se ci troviamo nella pagina show dei film, anche l'immagine poster del film selezionato (<x-jumbotron> </x-jumbotron>): --}}
    <x-jumbotron>
    </x-jumbotron>

    <div class="container-fluid mt-5 mb-3">

        <h3>MODIFICA IL REGISTA</h3>
        <p>* I dati riportati con l'asterisco sono obbligatori</p>
        <hr class="mb-5" />

        {{-- ------------------- Sezione form modifica un regista: ------------------- --}}
        {{-- Passo con le props sia il la variabile del model (se necessario, in questo caso passo $director), sia l'action che il metodo http, e anche le singole input type di cui ho bisogno --}}
        <x-form-data
        :model="$director"
        :action="route('directors.update', $director->id)" method="PUT"
        :showDirectorFirstName="true"
        :showDirectorLastName="true"
        :showDirectorBirthDate="true"
        :showDirectorNationality="true"
        buttonText="Salva"
        />
        {{-- ------------------- Fine sezione form aggiungi un regista: ------------------- --}}

        <p class="d-flex justify-content-center"><i class="fa fa-film" style="font-size: 20px; color: black;"></i></p>
    </div>

@endsection

</html>
