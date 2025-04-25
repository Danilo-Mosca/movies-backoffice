{{-- Styles: istruzione che permette a Laravel di cercare le risorse per Bootstrap ed SCSS: 
      In questo caso oltre ad importare il file "app.scss" c'è il CSS personalizzato generico, importo
      anche il file "card.scss" (nella cartella "partials") che contiene il CSS specifico per la card: --}}
@vite(['resources/sass/app.scss', 'resources/sass/partials/card.scss', 'resources/js/app.js'])

<div>
    <!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->

    <div class="card">
        <a href="{{ route('movies.show', $slug) }}"><img src="{{ $image }}" class="card-img-top" alt="{{ $title }}"></a>
        <div class="card-body">
            {{-- Il metodo strtoupper() restituisce tutti i caratteri convertiti in uppercase (maiuscolo): --}}
            <h5 class="card-title">{{ substr(strtoupper($title), 0,150) . "..." }}</h5>
            <h4 class="card-title"><a class="card-title" href="{{ route('movies.show', $slug) }}">Visualizza...</a></h4>
        </div>
    </div>
</div>
