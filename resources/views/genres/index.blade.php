{{-- per indicare che questa pagina utilizza il layout master dobbiamo usare la parola extends: --}}
@extends('layouts.movies')

{{-- Sezione del titolo della pagina --}}
@section('title')
    Tutti i generi
@endsection

{{-- Sezione della pagina personalizzata chiamata "content" nel layout: --}}
@section('content')
    {{-- @dump($movies) --}}

    <h3>Lista dei generi film</h3>
    <p>Sezione lista dei generi dei film dove è possibile visualizzare, modificare o cancellare i singoli
        generi</p>
    <hr />


    <!-- Form filtro di ricerca -->
    <form method="GET" action="{{ route('genres.index') }}">
        <div class="d-flex flex-wrap row gap-3 ms-2 me-2">
            <input class="col-12 col-md-4 filter-form" type="text" name="name" placeholder="Nome del genere"
                value="{{ request('name') }}">
            <button class="col-12 col-md-3" type="submit">Ricerca</button>
            <button class="col-12 col-md-2" id="delete"><a href="{{ route('genres.index') }}">Reset</a></button>
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

            {{-- Contatore generi totali o ricercati: --}}
            <div><p class="film-counter">Generi mostrati: <span class="number-film-counter">{{ $genres->total() }}</span></p></div>

            @foreach ($genres as $genre)
                <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                    <!-- 3 colonne per riga su desktop ≥ 1200px, 3 per riga su desktop ≥ 992px, 2 su tablet, 1 su mobile -->

                    {{-- Inserendo i tag <x-nome_componente>...</x-nome_componente> inserisco un componente, in questo caso inserisco il componente card che conterrà i film (<x-genre-card> </x-genre-card>): --}}
                    <x-genre-card>
                        <x-slot:genreName>{{ $genre->name }}</x-slot:genreName>
                        <x-slot:genreColor>{{ $genre->color }}</x-slot:genreColor>
                        <x-slot:genreDescription>{{ $genre->genre_description }}</x-slot:genreDescription>
                        <x-slot:genreID>{{ $genre->id }}</x-slot:genreID>
                    </x-genre-card>
                </div>
            @endforeach
        </div>

        {{-- Output se non viene trovato nessun risultato corrispondente al filtro di ricerca: --}}
        @if ($genres->isEmpty())
            <div class="alert alert-warning mt-3">
                Nessun genere trovato con il termine di ricerca inserito.
            </div>
        @endif

    </div>

    {{-- PAGINAZIONE --}}
    {{-- Paginazione Bootstrap 5 --}}
    <div class="d-flex flex-column flex-md-row justify-content-center align-items-center mt-4">
        <div class="text-muted mb-2 mb-md-0">
            {{-- Qui va il testo di riepilogo --}}
            Mostrati da <strong>{{ $genres->firstItem() }}</strong> a <strong>{{ $genres->lastItem() }}</strong> di <strong>{{ $genres->total() }}</strong> risultati
        </div>
    </div>
    <div class="d-flex flex-column flex-md-row justify-content-center align-items-center mt-4">
        {{ $genres->links('pagination::bootstrap-5') }}
    </div>
    {{-- FINE PAGINAZIONE --}}

@endsection

</html>
