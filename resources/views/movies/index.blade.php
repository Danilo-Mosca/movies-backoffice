{{-- per indicare che questa pagina utilizza il layout master dobbiamo usare la parola extends: --}}
@extends('layouts.movies')

{{-- Sezione del titolo della pagina --}}
@section('title')
    Tutti i film
@endsection

{{-- Sezione della pagina personalizzata chiamata "content" nel layout: --}}
@section('content')
    {{-- @dump($movies) --}}

    <h3>Lista dei film</h3>
    <p>Sezione lista dei film dove è possibile selezionare il singolo film per visualizzarne la scheda tecnica, ma anche
        modificarla o eliminare l'intero film</p>
    <hr />


    <!-- Form filtro di ricerca -->
    <form method="GET" action="{{ route('movies.index') }}">
        <div class="d-flex flex-wrap row gap-3 ms-2 me-2">
            <input class="col-12 col-md-4 filter-form" type="text" name="title" placeholder="Nome del film"
                value="{{ request('title') }}">
            <button class="col-12 col-md-3" type="submit">Ricerca</button>
            <button class="col-12 col-md-2" id="delete"><a href="{{ route('movies.index') }}">Reset</a></button>
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

        <div class="row g-3"> <!-- Spazio tra le card dei film -->

            {{-- Contatore film totali o ricercati: --}}
            <div><p class="film-counter">Film mostrati: <span class="number-film-counter">{{ $movies->total() }}</span></p></div>
        
            @foreach ($movies as $movie)
                <div class="col-xl-3 col-lg-3 col-md-4 col-12">
                    <!-- 6 colonne per riga su desktop ≥ 1200px, 4 per riga su desktop ≥ 992px, 3 su tablet, 1 su mobile -->

                    {{-- Inserendo i tag <x-nome_componente>...</x-nome_componente> inserisco un componente, in questo caso inserisco il componente card che conterrà i film (<x-card> </x-card>): --}}
                    <x-card>
                        <div class="single-card">
                            <x-slot:image>{{ $movie['poster'] }}</x-slot:image>
                            <x-slot:title>{{ $movie->title }}</x-slot:title>
                            <x-slot:slug>{{ $movie->slug }}</x-slot:slug>
                        </div>
                    </x-card>

                </div>
            @endforeach
        </div>

        {{-- Output se non viene trovato nessun risultato corrispondente al filtro di ricerca: --}}
        @if ($movies->isEmpty())
            <div class="alert alert-warning mt-3">
                Nessun film trovato con il termine di ricerca inserito.
            </div>
        @endif

    </div>

    {{-- PAGINAZIONE --}}
    {{-- Paginazione Bootstrap 5 --}}
    <div class="d-flex flex-column flex-md-row justify-content-center align-items-center mt-4">
        <div class="text-muted mb-2 mb-md-0">
            {{-- Qui va il testo di riepilogo --}}
            Mostrati da <strong>{{ $movies->firstItem() }}</strong> a <strong>{{ $movies->lastItem() }}</strong> di <strong>{{ $movies->total() }}</strong> risultati
        </div>
    </div>
    <div class="d-flex flex-column flex-md-row justify-content-center align-items-center mt-4">
        {{-- Mostro il link di navigazione --}}
        {{ $movies->links('pagination::bootstrap-5') }}
    </div>
    {{-- FINE PAGINAZIONE --}}

@endsection

</html>
