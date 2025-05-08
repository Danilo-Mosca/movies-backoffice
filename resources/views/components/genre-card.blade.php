{{-- Styles: istruzione che permette a Laravel di cercare le risorse per Bootstrap ed SCSS: 
      In questo caso oltre ad importare il file "app.scss" c'è il CSS personalizzato generico --}}
@vite(['resources/sass/app.scss', 'resources/js/app.js'])

<div class="card shadow-sm mb-4" style="">
    <div class="card-header bg-dark text-white">
        Dettagli Genere
    </div>
    <div class="card-body">


        <div class="mb-2 d-flex py-3 border-bottom">
            <div class="fw-bold w-50">Genere:</div>
            <div class="fw-bold" style="color: {{ $genreColor }}">{{ strlen($genreName) > 50 ? substr($genreName, 0, 50) . '...' : $genreName }}</div>
        </div>


        @if ($genreDescription == '' || $genreDescription == null)
            @php
                $genreDescription = 'Descrizione non inserita';
            @endphp
        @endif
        <div class="mb-2 py-3 border-bottom">
            <div class="fw-bold w-50">Descrizione:</div>
            {{-- Controllo con un operatore ternario se $genreDescription contiene 100 più di caratteri, in questo caso tronco la parola con la funzione substr() e aggiungo i puntini sospensivi, altrimenti stampo la stringa interamente contenuta nella variabile --}}
            <div>{{ strlen($genreDescription) > 100 ? substr($genreDescription, 0, 100) . '...' : $genreDescription }}
            </div>
        </div>


        <div class="mb-2 d-flex py-3 border-bottom">
            <a class="card-title fw-bolder" href="{{ route('genres.show', $genreID) }}">Visualizza il genere...</a>
        </div>


        {{-- --------- Sezione Pulsanti modifica ed elimina --------- --}}
        <div class="mt-4 text-end">
            <a href="{{ route('genres.edit', $genreID) }}"
                class="btn btn-outline-secondary rounded-0 custom-modify-btn my-3">Modifica
            </a>
            {{-- Per il DELETE non possiamo usare un link perchè i link chiamano sempre un metodo get, questo invece deve essere un metodo delete, allora lo facciamo tramite un form nascosto nel pulsante di conferma: --}}
            {{-- Sostituire:
                data-bs-target="#exampleModal"
                Con un bottone con ID dinamico con la seguente istruzione: 
                data-bs-target="#modal-{{ $genreID }}" 
                Cosicchè il modale basato sull'id del regista sia sempre diverso. Altrimenti ritorna sempre il primo elemento nella index --}}
            <button type="button" id="delete" data-bs-toggle="modal"
                data-bs-target="#modal-{{ $genreID }}">Elimina</button>
        </div>
        {{-- --------- End sezione Pulsanti modifica ed elimina --------- --}}
    </div>





    <!-- MODALE CON ID DINAMICO RICHIAMATO DAL PULSANTE "Elimina" -->
    {{-- Anche qui devo sostituire:
    id="exampleModal"
    e:
    aria-labelledby="exampleModalLabel"
    Con:
    id="modal-{{ $genreID }}"
    e:
    aria-labelledby="exampleModalLabel-{{ $genreID }}" 
    --}}
    <div class="modal fade" id="modal-{{ $genreID }}" tabindex="-1"
        aria-labelledby="exampleModalLabel-{{ $genreID }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel-{{ $genreID }}">Informazione</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Vuoi davvero eliminare il genere?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal">Annulla</button>
                    {{-- Per il DELETE non possiamo usare un link perchè i link chiamano sempre un metodo get, questo invece deve essere un metodo delete, allora lo facciamo tramite un form nascosto nel pulsante di conferma: --}}
                    <form action="{{ route('genres.destroy', $genreID) }}" method="POST">
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
