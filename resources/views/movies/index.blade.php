{{-- per indicare che questa pagina utilizza il layout master dobbiamo usare la parola extends: --}}
@extends('layouts.movies')

{{-- Sezione del titolo della pagina --}}
@section('title')
    Tutti i film
@endsection

{{-- --------------------------------------------------------------------------------------------------------------- --}}
@php

    // dd(config('comics'));   // prelevo le informazioni dal file di configurazione "comics.php.php"

    // Salvo l'array letterale contenente i comics (dal file di configurazione "comics.php" nella directory: config/comics.php) in una variabile cards
// $cards = config('comics');
@endphp
{{-- --------------------------------------------------------------------------------------------------------------- --}}

{{-- Sezione della pagina personalizzata chiamata "content" nel layout: --}}
@section('content')
    {{-- @dump($movies) --}}

    <h3>Lista dei film</h3>
    <p class="lead">An example multi-level sidebar with collasible menu items. The menu functions like an
        "accordion" where only a single menu is be open at a time.</p>
    <hr />

    <div class="container-fluid mt-5 mb-3">

        <div class="row g-3"> <!-- Spazio tra le card dei film -->
            @foreach ($movies as $movie)
                <div class="col-xl-2 col-lg-3 col-md-4 col-12">
                    <!-- 6 colonne per riga su desktop ≥ 1200px, 4 per riga su desktop ≥ 992px, 3 su tablet, 1 su mobile -->

                    {{-- Inserendo i tag <x-nome_componente>...</x-nome_componente> inserisco un componente, in questo caso inserisco il componente card che conterrà i film (<x-card> </x-card>): --}}
                    <x-card>
                        <div class="single-card">
                            <x-slot:image>{{ $movie['poster'] }}</x-slot:image>
                            <x-slot:title>{{ $movie->title }}</x-slot:title>
                            <x-slot:slug>{{ $movie->slug }}</x-slot:slug>
                        </div>
                    </x-card>

                </div>
            @endforeach
        </div>

    </div>




    {{-- <div class="col d-flex flex-column h-100">
        <main class="row">
            <div class="col pt-4"> --}}
    <h3>More content...</h3>
    <p>Sriracha biodiesel taxidermy organic post-ironic, Intelligentsia salvia mustache 90's code editing
        brunch. Butcher polaroid VHS art party, hashtag Brooklyn deep v PBR narwhal sustainable mixtape swag
        wolf squid tote bag. Tote bag cronut semiotics, raw denim deep v taxidermy messenger bag. Tofu YOLO
        Etsy, direct trade ethical Odd Future jean shorts paleo. Forage Shoreditch tousled aesthetic irony,
        street art organic Bushwick artisan cliche semiotics ugh synth chillwave meditation. Shabby chic lomo
        plaid vinyl chambray Vice. Vice sustainable cardigan, Williamsburg master cleanse hella DIY 90's blog.
        <a href="#">Ciao</a>
    </p>
    <p>Ethical Kickstarter PBR asymmetrical lo-fi. Dreamcatcher street art Carles, stumptown gluten-free
        Kickstarter artisan Wes Anderson wolf pug. Godard sustainable you probably haven't heard of them, vegan
        farm-to-table Williamsburg slow-carb readymade disrupt deep v. Meggings seitan Wes Anderson semiotics,
        cliche American Apparel whatever. Helvetica cray plaid, vegan brunch Banksy leggings +1 direct trade.
        Wayfarers codeply PBR selfies. Banh mi McSweeney's Shoreditch selfies, forage fingerstache food truck
        occupy YOLO Pitchfork fixie iPhone fanny pack art party Portland.</p>
    <p>Ethical Kickstarter PBR asymmetrical lo-fi. Dreamcatcher street art Carles, stumptown gluten-free
        Kickstarter artisan Wes Anderson wolf pug. Godard sustainable you probably haven't heard of them, vegan
        farm-to-table Williamsburg slow-carb readymade disrupt deep v. Meggings seitan Wes Anderson semiotics,
        cliche American Apparel whatever. Helvetica cray plaid, vegan brunch Banksy leggings +1 direct trade.
        Wayfarers codeply PBR selfies. Banh mi McSweeney's Shoreditch selfies, forage fingerstache food truck
        occupy YOLO Pitchfork fixie iPhone fanny pack art party Portland.</p>
    <p>Ethical Kickstarter PBR asymmetrical lo-fi. Dreamcatcher street art Carles, stumptown gluten-free
        Kickstarter artisan Wes Anderson wolf pug. Godard sustainable you probably haven't heard of them, vegan
        farm-to-table Williamsburg slow-carb readymade disrupt deep v. Meggings seitan Wes Anderson semiotics,
        cliche American Apparel whatever. Helvetica cray plaid, vegan brunch Banksy leggings +1 direct trade.
        Wayfarers codeply PBR selfies. Banh mi McSweeney's Shoreditch selfies, forage fingerstache food truck
        occupy YOLO Pitchfork fixie iPhone fanny pack art party Portland.</p>
    <p>Ethical Kickstarter PBR asymmetrical lo-fi. Dreamcatcher street art Carles, stumptown gluten-free
        Kickstarter artisan Wes Anderson wolf pug. Godard sustainable you probably haven't heard of them, vegan
        farm-to-table Williamsburg slow-carb readymade disrupt deep v. Meggings seitan Wes Anderson semiotics,
        cliche American Apparel whatever. Helvetica cray plaid, vegan brunch Banksy leggings +1 direct trade.
        Wayfarers codeply PBR selfies. Banh mi McSweeney's Shoreditch selfies, forage fingerstache food truck
        occupy YOLO Pitchfork fixie iPhone fanny pack art party Portland.</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque error vitae, illum natus temporibus consequuntur
        cumque rerum quod tempore debitis perspiciatis? Impedit accusantium architecto ipsam autem velit inventore
        cupiditate aperiam ratione, doloribus, provident magnam, laboriosam odit voluptatibus quam omnis quis sit facilis
        nulla at quo non? Tempora adipisci, harum obcaecati quisquam est minus doloremque repellat nam nobis, at molestias
        omnis iure. Eos dolore similique voluptas totam aliquid sequi atque fuga doloribus natus praesentium, enim, nesciunt
        provident aliquam illo commodi sapiente fugit nobis harum consequatur autem! Necessitatibus numquam officiis animi
        voluptatibus voluptatem omnis! Cumque minima nostrum neque. Ex sint nostrum reprehenderit quibusdam labore officiis
        soluta illo. Repellat iure eaque iste et accusantium nostrum nihil vitae impedit obcaecati dolore, pariatur, iusto
        harum consectetur autem, saepe animi nam ea dolor. Distinctio ad ut non atque nisi ducimus inventore consequuntur
        nam quae nesciunt exercitationem est, similique cum consectetur quibusdam. Non exercitationem ex magni distinctio.
    </p>
    {{-- </div>
        </main> --}}
    {{-- <footer class="row bg-light py-4 mt-auto">
            <div class="col"> Bottom footer content here... </div>
        </footer>
    </div> --}}
@endsection

</html>
