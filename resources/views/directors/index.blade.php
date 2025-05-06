{{-- per indicare che questa pagina utilizza il layout master dobbiamo usare la parola extends: --}}
@extends('layouts.movies')

{{-- Sezione del titolo della pagina --}}
@section('title')
    Tutti i registi
@endsection

{{-- --------------------------------------------------------------------------------------------------------------- --}}
@php

    // dd(config('comics'));   // prelevo le informazioni dal file di configurazione "comics.php.php"

    // Salvo l'array letterale contenente i comics (dal file di configurazione "comics.php" nella directory: config/comics.php) in una variabile cards
// $cards = config('comics');
@endphp
{{-- --------------------------------------------------------------------------------------------------------------- --}}

{{-- Sezione della pagina personalizzata chiamata "content" nel layout: --}}
@section('content')
    {{-- @dump($movies) --}}

    <h3>Lista dei registi</h3>
    <p>Sezione lista dei registi dove è possibile visualizzare i dati anagrafici di tutti i registi ma anche visualizzarne
        la singola scheda anagrafica. In questa sezione è possibile anche aggiungere, modificare o cancellare i singoli
        registi</p>
    <hr />




    {{-- ---------- Sessione temporanea che mostra una notifica, un alert con un messaggio di successo nel caso in cui un film viene cancellato con successo ----------  --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    {{-- ---------- Fine sessione temporanea che mostra una notifica, un alert con un messaggio di successo nel caso in cui un film viene cancellato con successo ----------  --}}



    <div class="container-fluid mt-5 mb-3">

        <div class="row g-3"> <!-- Spazio tra le card dei registi -->
            @foreach ($directors as $director)
                <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                    <!-- 3 colonne per riga su desktop ≥ 1200px, 3 per riga su desktop ≥ 992px, 2 su tablet, 1 su mobile -->

                    {{-- Inserendo i tag <x-nome_componente>...</x-nome_componente> inserisco un componente, in questo caso inserisco il componente card che conterrà i film (<x-director-card> </x-director-card>): --}}
                    <x-director-card>
                        <x-slot:fullName>{{ $director->getFullNameAttribute() }}</x-slot:fullName>
                        <x-slot:firstName>{{ $director->first_name }}</x-slot:fullName>
                        <x-slot:lastName>{{ $director->last_name }}</x-slot:lastName>
                        <x-slot:birthDate>{{ $director->birth_date }}</x-slot:birthDate>
                        <x-slot:nationality>{{ $director->director_nationality }}</x-slot:nationality>
                        <x-slot:directorID>{{ $director->id }}</x-slot:directorID>
                    </x-director-card>
                </div>
            @endforeach
        </div>

    </div>






    {{-- </div>
        </main> --}}
    {{-- <footer class="row bg-light py-4 mt-auto">
            <div class="col"> Bottom footer content here... </div>
        </footer>
    </div> --}}
@endsection

</html>
