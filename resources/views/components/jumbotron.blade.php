{{-- Styles: istruzione che permette a Laravel di cercare le risorse per Bootstrap ed SCSS: 
      In questo caso oltre ad importare il file "app.scss" che è il CSS personalizzato generico, importo
      anche il file "jumbotron.scss" (nella cartella "partials") che contiene il CSS specifico per il jumbotron: --}}
@vite(['resources/sass/app.scss', 'resources/sass/partials/jumbotron.scss', 'resources/js/app.js'])

{{-- -------------------------------------------- Jumbotron -------------------------------------------- --}}
@php
    // Creo una variabile che conterrà il path di tutte le immagini jumbotron che metto a disposizione:
    $jumbotronImage = [
        0 => 'resources/img/jumbotron/jumbotron-cinema-1.webp',
        1 => 'resources/img/jumbotron/jumbotron-cinema-2.webp',
        2 => 'resources/img/jumbotron/jumbotron-cinema-3.webp',
        3 => 'resources/img/jumbotron/jumbotron-cinema-4.webp',
        4 => 'resources/img/jumbotron/jumbotron-cinema-5.webp',
        5 => 'resources/img/jumbotron/jumbotron-cinema-6.webp',
        6 => 'resources/img/jumbotron/jumbotron-cinema-7.webp',
        7 => 'resources/img/jumbotron/jumbotron-cinema-8.webp',
        8 => 'resources/img/jumbotron/jumbotron-cinema-9.webp',
        9 => 'resources/img/jumbotron/jumbotron-cinema-10.webp',
        10 => 'resources/img/jumbotron/jumbotron-cinema-11.webp',
        11 => 'resources/img/jumbotron/jumbotron-cinema-12.webp',
        12 => 'resources/img/jumbotron/jumbotron-cinema-13.webp',
        13 => 'resources/img/jumbotron/jumbotron-cinema-14.webp',
        14 => 'resources/img/jumbotron/jumbotron-cinema-15.webp',
    ];
    // Genero un numero randomico e lo assegno alla variabile $randomIndex per far si che venga visualizzata ogni volta un'immagine casuale tra quelle disponibili. Infatti con l'istruzione: $jumbotronImage[$randomIndex] verrà visualizzata ogni volta un immagine casuale generata dal metodo rand()
    // dd(count($jumbotronImage));
    // $randomIndex = rand(0, 14);     //numero inserito manualmente
    $randomIndex = rand(0, count($jumbotronImage) - 1); //numero inserito dinamicamente in base alla lunghezza dell'array -1
@endphp

<div>

    <header class="jumbotron">
        {{-- Con l'istruzione di seguite: Vite::asset('percorso...') importo l'immagine affinché Blade la processi --}}
        <img src="{{ Vite::asset($jumbotronImage[$randomIndex]) }}" alt="Cinema" class="jumbotron-img">
    </header>

    {{-- Controllo se viene passata la variabile $image con l'immagine dalla pagina che richiama il componente jumbotron. 
    Se questa viene passata (il metodo "isset()" controlla se una variabile è definita) allora la visualizzo, altrimenti
    visualizzo solo l'immagine casuale del jumbotron. QUESTO PER RENDERE IL COMPONENTE jumbotron riutilizzabile ed utilizzarlo
    anche in altre pagine dove non è richiesta l'immagine del film, come ad esempio nelle pagine delle tabelle genere, attori,
    registi ecc. --}}
    @if (isset($image))
        {{-- Successivamente, dopo aver verificato l'esistenza dell'immagine, controllo se questa ha un valore al suo interno oppure risulta 
        vuota '' o null. Se così allora gli assegno l'immagine placeholder di default --}}
        @if ($image == '' || $image == null)
            @php
                // Con l'istruzione di seguite: Vite::asset('percorso...') importo l'immagine affinché Blade la processi
                $image = Vite::asset('resources/img/poster-placeholder.webp'); // Assegno l'immagine placeholder di default nel caso questa risulti vuota
            @endphp
            {{-- E poi stampo la <section> con l'immagine placeholder: --}}
            <section class="overlay-image-container">
                <img src="{{ $image }}" alt="{{ $title }}" class="overlay-img">
            </section>
        @else
            {{-- Altrimenti se l'immagine non è vuota o nulla stampo la <section> con questa all'interno: --}}
            <section class="overlay-image-container">
                <img src="{{ asset('storage/' . $image) }}" alt="{{ $title }}" class="overlay-img">
            </section>
        @endif
    @endif

</div>
{{-- -------------------------------------------- Fine Jumbotron -------------------------------------------- --}}
