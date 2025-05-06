{{-- Styles: istruzione che permette a Laravel di cercare le risorse per Bootstrap ed SCSS: 
      In questo caso oltre ad importare il file "app.scss" c'è il CSS personalizzato generico --}}
@vite(['resources/sass/app.scss', 'resources/js/app.js'])

<div class="card shadow-sm mb-4" style="">
    <div class="card-header bg-dark text-white">
        Dettagli Regista
    </div>
    <div class="card-body">
        {{-- Controllo con un operatore ternario se $fullName contiene 40 più di caratteri, in questo caso tronco la parola con la funzione substr() e aggiungo i puntini sospensivi, altrimenti stampo la stringa interamente contenuta nella variabile 
        NOTA BENE: FACCIO LO STESSO ANCHE PER I CAMPI NOME E COGNOME --}}
        <h5 class="card-title mb-3">{{ strlen($fullName) > 50 ? substr($fullName, 0, 50) . '...' : $fullName }}</h5>


        <div class="mb-2 d-flex py-1 border-bottom">
            <div class="fw-bold w-50">Nome:</div>
            <div>{{ strlen($firstName) > 50 ? substr($firstName, 0, 50) . '...' : $firstName }}</div>
        </div>


        <div class="mb-2 d-flex py-1 border-bottom">
            <div class="fw-bold w-50">Cognome:</div>
            <div>{{ strlen($lastName) > 50 ? substr($lastName, 0, 50) . '...' : $lastName }}</div>
        </div>


        <div class="mb-2 d-flex py-1 border-bottom">
            <div class="fw-bold w-50">Data di nascita:</div>

            @if ($birthDate == '' || $birthDate == null)
                @php
                    $dateFormatted = 'Data di nascita non inserita';
                @endphp
            @else
                {{-- Per avere i mesi in italiano, per impostare la localizzazione correttamente con setlocale() uso la classe Carbon che permette
                                di impostare la localizzazione italiana in maniera semplicissima come di seguito: --}}
                @php
                    // Imposta la localizzazione italiana e tutto il resto:
                    $dateFormatted = \Carbon\Carbon::createFromFormat('Y-m-d', $birthDate)
                        ->locale('it')
                        ->translatedFormat('d F Y');
                @endphp
            @endif

            <div>{{ $dateFormatted }}</div>
        </div>


        @if ($birthDate == '' || $birthDate == null)
            @php
                $nationality = 'Nazionalità non inserita';
            @endphp
        @endif
        <div class="mb-2 d-flex py-1 border-bottom">
            <div class="fw-bold w-50">Nazionalità:</div>
            <div>{{ $nationality }}</div>
        </div>


        <div class="mb-2 d-flex py-3 border-bottom">
            <a class="card-title fw-bolder" href="{{ route('directors.show', $directorID) }}">Visualizza scheda
                anagrafica...</a>
        </div>


        {{-- --------- Sezione Pulsanti modifica ed elimina --------- --}}
        <div class="mt-4 text-end">
            <a href="{{ route('directors.edit', $directorID) }}"
                class="btn btn-outline-secondary rounded-0 custom-modify-btn my-3">Modifica
            </a>
            {{-- Per il DELETE non possiamo usare un link perchè i link chiamano sempre un metodo get, questo invece deve essere un metodo delete, allora lo facciamo tramite un form nascosto nel pulsante di conferma: --}}
            {{-- Sostituire:
                data-bs-target="#exampleModal"
                Con un bottone con ID dinamico con la seguente istruzione: 
                data-bs-target="#modal-{{ $directorID }}" 
                Cosicchè il modale basato sull'id del regista sia sempre diverso. Altrimenti ritorna sempre il primo elemento nella index --}}
            <button type="button" id="delete" data-bs-toggle="modal"
                data-bs-target="#modal-{{ $directorID }}">Elimina</button>
        </div>
        {{-- --------- End sezione Pulsanti modifica ed elimina --------- --}}
    </div>





    <!-- MODALE CON ID DINAMICO RICHIAMATO DAL PULSANTE "Elimina" -->
    {{-- Anche qui devo sostituire:
    id="exampleModal"
    e:
    aria-labelledby="exampleModalLabel"
    Con:
    id="modal-{{ $directorID }}"
    e:
    aria-labelledby="exampleModalLabel-{{ $directorID }}" 
    --}}
    <div class="modal fade" id="modal-{{ $directorID }}" tabindex="-1"
        aria-labelledby="exampleModalLabel-{{ $directorID }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel-{{ $directorID }}">Informazione</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Vuoi davvero eliminare il regista?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal">Annulla</button>
                    {{-- Per il DELETE non possiamo usare un link perchè i link chiamano sempre un metodo get, questo invece deve essere un metodo delete, allora lo facciamo tramite un form nascosto nel pulsante di conferma: --}}
                    <form action="{{ route('directors.destroy', $directorID) }}" method="POST">
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
