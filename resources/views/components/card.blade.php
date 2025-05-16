{{-- Styles: istruzione che permette a Laravel di cercare le risorse per Bootstrap ed SCSS: 
      In questo caso oltre ad importare il file "app.scss" c'è il CSS personalizzato generico, importo
      anche il file "card.scss" (nella cartella "partials") che contiene il CSS specifico per la card: --}}
@vite(['resources/sass/app.scss', 'resources/sass/partials/card.scss', 'resources/js/app.js'])

<div>
    <!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->

    <div class="card mb-3 p-3">

        {{-- ----------------------------- Controllo se l'immagine ha un valore al suo interno oppure risulta vuota '' o null. Se così allora gli assegno l'immagine placeholder di default ----------------------------- --}}
        @if ($image == '' || $image == null)
            @php
                // Con l'istruzione di seguite: Vite::asset('percorso...') importo l'immagine affinché Blade la processi
                $image = Vite::asset('resources/img/poster-placeholder.webp'); // Assegno l'immagine placeholder di default nel caso questa risulti vuota
            @endphp
        {{-- CODICE DA INSERIRE:
        @else
            <a href="{{ route('movies.show', $slug) }}"><img src="{{ asset('storage/' . $image) }}" class="card-img-top"
                    alt="{{ $title }}"></a> 
        FINE CODICE DA INSERIRE --}}
        @endif
        
        {{-- CODICE DA TOGLIERE: --}}
        <a href="{{ route('movies.show', $slug) }}"><img src="{{ $image }}" class="card-img-top"
            alt="{{ $title }}"></a>
        {{-- FINE CODICE DA TOGLIERE: --}}
            {{-- ----------------------------- Fine controllo inserimento immagine ----------------------------- --}}
            
        <div class="card-body">
            {{-- Il metodo strtoupper() restituisce tutti i caratteri convertiti in uppercase (maiuscolo): --}}
            @php
                $titolo = substr(strtoupper($title), 0, 70); // Il metodo substr() restituisce una parte di una stringa, in questo caso restituisce la la stringa dal carattere 0 di partenza fino al carattere 69
            @endphp
            {{-- Controllo con un operatore ternario se $titolo contiene 70 caratteri, cioè il numero massimo, in questo caso aggiungo i puntini sospensivi, altrimenti stampo solo la stringa contenuta nella variabile --}}
            <h5 class="card-title pb-2">{{ strlen($titolo) == 70 ? $titolo . '...' : $titolo }}</h5>
            <h4 class="card-title p-3"><a class="card-title" href="{{ route('movies.show', $slug) }}">Visualizza...</a>
            </h4>

            {{-- --------- Sezione Pulsanti modifica ed elimina --------- --}}
            <div class="d-flex flex-wrap justify-content-around pt-3 row-gap-3">
                <button class="btn-modifica"><a href="{{ route('movies.edit', $slug) }}">Modifica</a></button>
                {{-- Per il DELETE non possiamo usare un link perchè i link chiamano sempre un metodo get, questo invece deve essere un metodo delete, allora lo facciamo tramite un form nascosto nel pulsante di conferma: --}}
                {{-- Sostituire:
                    data-bs-target="#exampleModal"
                    Con un bottone con ID dinamico con la seguente istruzione: 
                    data-bs-target="#modal-{{ $slug }}" 
                    Cosicchè il modale basato sullo slug del film sia sempre diverso. Altrimenti ritorna sempre il primo elemento nella index --}}
                <button type="button" id="delete" data-bs-toggle="modal"
                    data-bs-target="#modal-{{ $slug }}">Elimina</button>
            </div>
            {{-- --------- End sezione Pulsanti modifica ed elimina --------- --}}
        </div>
    </div>




    <!-- MODALE CON ID DINAMICO RICHIAMATO DAL PULSANTE "Elimina" -->
    {{-- Anche qui devo sostituire:
    id="exampleModal"
    e:
    aria-labelledby="exampleModalLabel"
    Con:
    id="modal-{{ $slug }}"
    e:
    aria-labelledby="exampleModalLabel-{{ $slug }}" 
    --}}
    <div class="modal fade" id="modal-{{ $slug }}" tabindex="-1"
        aria-labelledby="exampleModalLabel-{{ $slug }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><strong>{{ $title }}</strong></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Vuoi davvero eliminare il film?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal">Annulla</button>
                    {{-- Per il DELETE non possiamo usare un link perchè i link chiamano sempre un metodo get, questo invece deve essere un metodo delete, allora lo facciamo tramite un form nascosto nel pulsante di conferma: --}}
                    <form action="{{ route('movies.destroy', $slug) }}" method="POST">
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
</div>
