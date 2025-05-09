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

        <h3>FILM</h3>
        <p>Scheda tecnica del film</p>
        <hr />


        {{-- --------- Sezione Pulsanti modifica ed elimina --------- --}}
        <div class="d-flex flex-wrap justify-content-start pt-3 gap-3">
            <button class="btn-modifica"><a href="{{ route('movies.edit', $movie) }}">Modifica</a></button>
            {{-- Per il DELETE non possiamo usare un link perchè i link chiamano sempre un metodo get, questo invece deve essere un metodo delete, allora lo facciamo tramite un form nascosto nel pulsante di conferma: --}}
            <button type="button" id="delete" data-bs-toggle="modal" data-bs-target="#exampleModal">Elimina</button>
        </div>
        {{-- --------- End sezione Pulsanti modifica ed elimina --------- --}}


        {{-- ------------------- Sezione dettagli del film: ------------------- --}}
        <div class="mt-5 film-details">
            <h3 class="pb-3">
                <i class="fa-solid fa-film"></i>
                <span>{{ strtoupper('titolo') . ': ' }}</span>
                <span class="show-movies">{{ strtoupper($movie->title) }}</span>
            </h3>

            {{-- Con i tag {!! !!} al posto dei {{ }} inietto codice HTML non-escapato. Usando {!! !!} sto dicendo a Laravel: "Fidati di questo contenuto, non filtrarlo" .Soluzione valida ma poco sicura: --}}
            <div class="pb-3 row">
                <div class="col-12 col-lg-3">
                    <i class="fa-regular fa-calendar-days" style="color: black;"></i>
                    <span style="font-size: 22px; font-weight: 400; color: black;">Anno di uscita:</span>
                </div>

                <div class="col-12 col-lg-9">
                    <span class="show-movies"
                        style="color: #DB2B39; font-size: 22px; font-weight: 400;">{{ $movie->release_year }}</span>
                </div>
            </div>


            <div class="pb-4 row">
                <div class="col-12 col-lg-3">
                    <i class="fa-solid fa-clock" style="color: #000000;"></i>
                    <span style="font-size: 22px; font-weight: 400; color: black;">Durata:</span>
                </div>

                <div class="col-12 col-lg-9">
                    <span class="show-movies"
                        style="color: #DB2B39; font-size: 22px; font-weight: 400;">{{ $movie->duration }}</span>
                </div>
            </div>


            {{-- Sezione genere del film --}}
            <div class="pb-4 row">
                <div class="col-12 col-lg-3">
                    <i class="fa-solid fa-location-dot" style="color: black;"></i>
                    <span style="font-size: 22px; font-weight: 400; color: black;">Genere:</span>
                </div>

                <div class="col-12 col-lg-9">
                    {{-- Prima controllo se il campo facoltativo genres è stato inserito oppure risulta vuoto: 
                PER FARE QUESTO USO IL forelse() che è un ciclo che se è vuoto, cioè non contiene nessun elemento allora mi restituisce un valore nell'@empty altrimenti me lo esegue normalmente con le istruzioni al suo interno: --}}
                    @forelse ($movie->genres as $genre)
                        <span class="badge me-2 mb-2"
                            style="font-size: 22px; font-weight: 400; color: black; background-color: {{ $genre->color }}">{{ $genre->name }}</span>
                        {{-- Potevo inserirlo anche così: {{ $genre['color'] }} e {{ $genre['name'] }} --}}

                        {{-- Se l'array risulta vuoto allora stampo il seguente messaggio: --}}
                    @empty
                        <span class="show-movies" style="color: #DB2B39; font-size: 22px; font-weight: 400;">&nbsp;Genere
                            non
                            inserito</span>
                    @endforelse
                    {{-- Al posto del @forelse avrei potuto inserire tutto il blocco nella seguente condizione:
                @if (count($movie->genres) > 0)
                    @foreach    ... istruzioni da eseguire .... @endforeach
                @endif --}}
                </div>
            </div>
            {{-- Fine sezione genere del film --}}


            {{-- Sezione stelle per voto inserito --}}
            <div class="pb-4 row">
                <div class="col-12 col-lg-3">
                    <i class="fa-solid fa-star" style="font-size: 20px;"></i>
                    <span class="show-movies" style="font-size: 22px; font-weight: 400; color: black;">Voto:</span>
                </div>

                <div class="col-12 col-lg-9">
                    {{-- Prima controllo se il campo facoltativo rating è stato inserito oppure risulta null: --}}
                    @if ($movie->rating == null)
                        {{-- Se è null allora stampo la stringa "campo non inserito" --}}
                        <span class="show-movies" style="color: #DB2B39;">Campo non inserito</span>

                        {{-- Altrimenti stampo le stelle con il voto: --}}
                    @else
                        <!-- Ciclo che controlla il voto inserito e stampa a schermo le stelle piene, mezze o vuote in base ad esso -->
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($movie->rating >= $i)
                                <i class="fas fa-star no-space-rating" style="color: #DB2B39;"></i> <!-- Stella piena -->
                            @elseif ($movie->rating >= $i - 0.5)
                                <i class="fas fa-star-half-alt no-space-rating" style="color: #DB2B39;"></i>
                                <!-- Mezza stella -->
                            @else
                                <i class="far fa-star no-space-rating" style="color: #DB2B39;"></i> <!-- Stella vuota -->
                            @endif
                        @endfor
                        <span class="ms-2 show-movies" style="color: #DB2B39;">({{ $movie->rating }})</span>
                    @endif
                </div>
            </div>
            {{-- Fine sezione stelle per voto inserito --}}

            <div class="pb-3 row">
                <div class="col-12 col-lg-3">
                    <i class="fa-solid fa-location-dot" style="color: black;"></i>
                    <span style="font-size: 22px; font-weight: 400; color: black;">Nazionalità:</span>
                </div>

                <div class="col-12 col-lg-9">
                    {{-- Prima controllo se il campo facoltativo nationality è stato inserito oppure risulta null: --}}
                    @if ($movie->nationality == null)
                        {{-- Se è null allora stampo la stringa "Nazionalità non inserita" --}}
                        <span class="show-movies" style="color: #DB2B39; font-size: 22px; font-weight: 400;">Nazionalità non
                            inserita</span>

                        {{-- Altrimenti stampo il valore del campo: --}}
                    @else
                        <span class="show-movies"
                            style="font-size: 22px; font-weight: 400;">{{ $movie->nationality }}</span>
                    @endif
                </div>
            </div>

            <div class="pb-3 row">
                <div class="col-12 col-lg-3">
                    <i class="fa-solid fa-video" style="color: black;"></i>
                    <span style="font-size: 22px; font-weight: 400; color: black;">Regista:</span>
                </div>

                <div class="col-12 col-lg-9">
                    {{-- Prima controllo se il campo facoltativo director_id (regista) è stato inserito oppure risulta null: --}}
                    @if ($movie->director_id == null)
                        {{-- Se è null allora stampo la stringa "Regista non inserito" --}}
                        <span class="show-movies" style="color: #DB2B39; font-size: 22px; font-weight: 400;">Regista non
                            inserito</span>

                        {{-- Altrimenti stampo il valore del campo: --}}
                    @else
                        <span class="show-movies"
                            style="font-size: 22px; font-weight: 400;">{{ $movie->director->getFullNameAttribute() }}</span>
                    @endif
                </div>
            </div>


            {{-- Sezione attori presenti nel film --}}
            <div class="pb-2 row">
                <div class="col-12 col-lg-3">
                    <i class="fa-solid fa-location-dot" style="color: black;"></i>
                    <span style="font-size: 22px; font-weight: 400; color: black;">Attori:</span>
                </div>

                <div class="col-12 col-lg-9">
                    {{-- Prima controllo se il campo facoltativo actors è stato inserito oppure risulta vuoto: 
                    PER FARE QUESTO USO IL forelse() che è un ciclo che se è vuoto, cioè non contiene nessun elemento allora mi restituisce un valore nell'@empty altrimenti me lo esegue normalmente con le istruzioni al suo interno: --}}
                    @php
                        $i = 0;
                    @endphp
                    @forelse ($movie->actors as $actor)
                        @php
                            $i++;
                        @endphp

                        @if (count($movie->actors) > $i)
                            <span class="show-movies"
                                style="font-size: 22px; font-weight: 400;">{{ $actor->getFullNameAttribute() }} -</span>
                            {{-- Potevo inserirlo anche così: {{ $actor['color'] }} e {{ $actor['name'] }} --}}
                        @else
                            <span class="show-movies"
                                style="font-size: 22px; font-weight: 400;">{{ $actor->getFullNameAttribute() }}</span>
                            {{-- Potevo inserirlo anche così: {{ $actor['color'] }} e {{ $actor['name'] }} --}}
                        @endif


                        {{-- Se l'array risulta vuoto allora stampo il seguente messaggio: --}}
                    @empty
                        <span class="show-movies" style="color: #DB2B39; font-size: 22px; font-weight: 400;">Attori non
                            inseriti</span>
                    @endforelse
                    {{-- Al posto del @forelse avrei potuto inserire tutto il blocco nella seguente condizione:
                    @if (count($movie->actors) > 0)
                    @foreach    ... istruzioni da eseguire .... @endforeach
                    @endif --}}
                </div>
            </div>
            {{-- Fine sezione attori presenti nel film --}}


            <div style="font-size: 22px; font-weight: 400; color: black;"><i class="fa-solid fa-pencil"></i> Descrizione:
            </div>
            {{-- Prima controllo se il campo facoltativo description è stato inserito oppure risulta null: --}}
            @if ($movie->director_id == null)
                {{-- Se è null allora stampo la stringa "Descrizione non inserita" --}}
                <span class="show-movies" style="color: #DB2B39; font-size: 22px; font-weight: 400;">Descrizione non
                    inserita</span>
                {{-- Altrimenti stampo il valore del campo: --}}
            @else
                <p>{{ $movie->description }}</p>
            @endif



            <hr class="mt-5" />
        </div>

        <hr class="mt-5" />
    </div>
    {{-- ------------------- Fine sezione dettagli del film: ------------------- --}}


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
                <p>Vuoi davvero eliminare il film?</p>
            </div>
            <div class="modal-footer">
                <button type="button" data-bs-dismiss="modal">Annulla</button>
                {{-- Per il DELETE non possiamo usare un link perchè i link chiamano sempre un metodo get, questo invece deve essere un metodo delete, allora lo facciamo tramite un form nascosto nel pulsante di conferma: --}}
                <form action="{{ route('movies.destroy', $movie) }}" method="POST">
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
