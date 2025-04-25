{{-- Styles: istruzione che permette a Laravel di cercare le risorse per Bootstrap ed SCSS: 
      In questo caso oltre ad importare il file "app.scss" c'è il CSS personalizzato generico, importo
      anche il file "card.scss" (nella cartella "partials") che contiene il CSS specifico per la card: --}}
@vite(['resources/sass/app.scss', 'resources/sass/partials/card.scss', 'resources/js/app.js'])

<div>
    <!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->

    <div class="card">
        <a href="{{ route('movies.show', $slug) }}"><img src="{{ $image }}" class="card-img-top"
                alt="{{ $title }}"></a>
        <div class="card-body">
            {{-- Il metodo strtoupper() restituisce tutti i caratteri convertiti in uppercase (maiuscolo): --}}
            @php
                $titolo = substr(strtoupper($title), 0, 70);    // Il metodo substr() restituisce una parte di una stringa, in questo caso restituisce la la stringa dal carattere 0 di partenza fino al carattere 69
            @endphp
            {{-- Controllo con un operatore ternario se $titolo contiene 70 caratteri, cioè il numero massimo, in questo caso aggiungo i puntini sospensivi, altrimenti stampo solo la stringa contenuta nella variabile --}}
            <h5 class="card-title">{{ strlen($titolo) == 70 ? $titolo . '...' : $titolo }}</h5>
            <h4 class="card-title"><a class="card-title" href="{{ route('movies.show', $slug) }}">Visualizza...</a></h4>
        </div>
    </div>
</div>
