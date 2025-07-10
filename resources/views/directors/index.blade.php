{{-- per indicare che questa pagina utilizza il layout master dobbiamo usare la parola extends: --}}
@extends('layouts.movies')

{{-- Sezione del titolo della pagina --}}
@section('title')
    Tutti i registi
@endsection

{{-- Sezione della pagina personalizzata chiamata "content" nel layout: --}}
@section('content')
    {{-- @dump($movies) --}}

    <h3>Lista dei registi</h3>
    <p>Sezione lista dei registi dove è possibile visualizzare i dati anagrafici di tutti i registi ma anche visualizzarne
        la singola scheda anagrafica. In questa sezione è possibile anche aggiungere, modificare o cancellare i singoli
        registi</p>
    <hr />


    <!-- Form filtro di ricerca -->
    <form method="GET" action="{{ route('directors.index') }}">
        <div class="d-flex flex-wrap row gap-3 ms-2 me-2">
            <input class="col-12 col-md-2 col-lg-3 filter-form" type="text" name="first_name" placeholder="Nome"
                value="{{ request('first_name') }}">
            <input class="col-12 col-md-2 col-lg-3 filter-form" type="text" name="last_name" placeholder="Cognome"
                value="{{ request('last_name') }}">
            <button class="col-12 col-md-2" type="submit">Ricerca</button>
            <button class="col-12 col-md-2" id="delete"><a href="{{ route('directors.index') }}">Reset</a></button>
        </div>
    </form>
    <!-- Fine form filtro di ricerca -->


    {{-- ---------- Sessione temporanea che mostra una notifica, un alert con un messaggio di successo nel caso in cui un film viene cancellato con successo ----------  --}}
    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
    {{-- ---------- Fine sessione temporanea che mostra una notifica, un alert con un messaggio di successo nel caso in cui un film viene cancellato con successo ----------  --}}



    <div class="container-fluid mt-5 mb-3">

        <div class="row g-3"> <!-- Spazio tra le card dei registi -->

            {{-- Contatore registi totali o ricercati: --}}
            <div><p class="film-counter">Registi mostrati: <span class="number-film-counter">{{ $directors->total() }}</span></p></div>

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

        @if ($directors->isEmpty())
            <div class="alert alert-warning mt-3">
                Nessun regista trovato con i valori di ricerca inseriti.
            </div>
        @endif

    </div>

    {{-- PAGINAZIONE --}}
    {{-- Paginazione Bootstrap 5 --}}
    <div class="d-flex flex-column flex-md-row justify-content-center align-items-center mt-4">
        <div class="text-muted mb-2 mb-md-0">
            {{-- Qui va il testo di riepilogo --}}
            Mostrati da <strong>{{ $directors->firstItem() }}</strong> a <strong>{{ $directors->lastItem() }}</strong> di <strong>{{ $directors->total() }}</strong> risultati
        </div>
    </div>
    <div class="d-flex flex-column flex-md-row justify-content-center align-items-center mt-4">
        {{-- Mostro il link di navigazione --}}
        {{ $directors->links('pagination::bootstrap-5') }}
    </div>
    {{-- FINE PAGINAZIONE --}}

@endsection

</html>
