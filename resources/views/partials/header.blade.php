{{-- Styles: istruzione che permette a Laravel di cercare le risorse per Bootstrap ed SCSS: 
      In questo caso oltre ad importare il file "app.scss" c'è il CSS personalizzato generico, importo
      anche il file "header.scss" (nella cartella "partials") che contiene il CSS specifico per la header: --}}
 @vite(['resources/sass/app.scss', 'resources/sass/partials/header.scss', 'resources/js/app.js'])


<header class="row mt-3">
    <div class="col d-flex justify-content-center">
        <a href="#" class="a-link-header"><img src="{{ Vite::asset('resources/img/icons/directors-icon.png') }}" alt="Logo registi"
                height=""><p class="header-text-menu">Registi</p></a>
    </div>
    <div class="col d-flex justify-content-center">
        <a href="#" class="a-link-header"><img src="{{ Vite::asset('resources/img/icons/What-we-do-custom-img-8.png') }}" alt="Logo genere"
                height=""><p class="header-text-menu">Genere</p></a>
    </div>
    <div class="col d-flex justify-content-center">
        <a href="#" class="a-link-header"><img src="{{ Vite::asset('resources/img/icons/What-we-do-custom-img-2.png') }}" alt="Logo film"
                height=""><p class="header-text-menu">Film</p></a>
    </div>
    <div class="col d-flex justify-content-center">
        <a href="#" class="a-link-header"><img src="{{ Vite::asset('resources/img/icons/What-we-do-custom-img-3.png') }}" alt="Logo attori"
                height=""><p class="header-text-menu">Attori</p></a>
    </div>
    <div class="col d-flex justify-content-center">
        <a href="#" class="a-link-header"><img src="{{ Vite::asset('resources/img/icons/What-we-do-custom-img-7.png') }}" alt="Logo recensioni"
                height=""><p class="header-text-menu">Recensioni</p></a>
    </div>
</header>
