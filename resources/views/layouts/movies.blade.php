<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- <!-- Importo le Bootstrap Icons (NON SERVE, E' GIA IMPORTATO DI DEFAULT) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"> --}}

    <!-- Importo le icone FontAwesome che mi serviranno per visaulizzare il voto con le icone stelle e le altre icone -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Styles: istruzione che permette a Laravel di cercare le risorse per Bootstrap ed SCSS: -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <title>@yield('title')</title>
</head>

<body>
    {{-- Includo la sidebar che sarà contenuta su tutte le pagine: --}}
    <div class="container-fluid overflow-hidden">
        <div class="row vh-100 overflow-auto">
            @include('partials.sidebar')

            <div class="col d-flex flex-column h-100">

                {{-- -------------------- Visualizzo l'header qui SOLO PER I DISPOSITIVI DESKTOP E TABLET, escludo i dispositivi mobili: ---------------- --}}
                <div class="d-none d-sm-block">
                    {{-- Includo il "partials" dell'header con la barra di navigazione: --}}
                    @include('partials.header')
                </div>
                {{-- ----------------- End Visualizzo l'header qui SOLO PER I DISPOSITIVI DESKTOP E TABLET, escludo i dispositivi mobili: ---------------- --}}


                {{-- La classe di Bootstrap "flex-grow-1" su <main> fa sì che cresca e spinga il footer in basso --}}
                <main class="row flex-grow-1">

                    {{-- ---------------- Visualizzo l'header qui SOLO PER I DISPOSITIVI MOBILI escludo i tablet e pc: ---------------- --}}
                    <div class="d-block d-sm-none">
                        {{-- Includo il "partials" dell'header con la barra di navigazione: --}}
                        @include('partials.header')
                    </div>
                    {{-- ------------------ End visualizzo l'header qui SOLO PER I DISPOSITIVI MOBILI escludo i tablet e pc: -------------- --}}

                    <div class="col pt-4">
                        {{-- Includo il contenuto personalizzato per ogni pagina: --}}
                        @yield('content')
                    </div>
                    
                    {{-- Includo il "partials" footer con la barra di navigazione: --}}
                    @include('partials.footer')
                </main>

            </div>

        </div>
    </div>

</body>

</html>
