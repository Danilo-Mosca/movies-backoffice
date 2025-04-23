{{-- Styles: istruzione che permette a Laravel di cercare le risorse per Bootstrap ed SCSS: 
      In questo caso oltre ad importare il file "app.scss" c'è il CSS personalizzato generico, importo
      anche il file "sidebar.scss" (nella cartella "partials") che contiene il CSS specifico per la sidebar: --}}
 @vite(['resources/sass/app.scss', 'resources/sass/partials/sidebar.scss', 'resources/js/app.js'])






{{-- <div class="container-fluid overflow-hidden">
    <div class="row vh-100 overflow-auto"> --}}



<div class="col-12 col-sm-3 col-xl-2 px-sm-2 px-0 bg-dark d-flex sticky-top">
    <div class="d-flex flex-sm-column flex-row flex-grow-1 align-items-center align-items-sm-start px-3 pt-2 text-white">
        <a href="/" class="d-flex align-items-center pb-sm-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-5">B<span class="d-none d-sm-inline">rand</span></span>
        </a>
        <ul class="nav nav-pills flex-sm-column flex-row flex-nowrap flex-shrink-1 flex-sm-grow-0 flex-grow-1 mb-sm-auto mb-0 justify-content-center align-items-center align-items-sm-start"
            id="menu">
            <li class="nav-item" id="menu-color">
                <a href="#" class="nav-link px-sm-0 px-2">
                    <i class="fs-5 bi-house"></i><span class="ms-1 d-none d-sm-inline">Home</span>
                </a>
            </li>
            <li id="menu-color">
                <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-sm-0 px-2">
                    <i class="fs-5 bi-speedometer2"></i><span class="ms-1 d-none d-sm-inline">Dashboard</span> </a>
            </li>
            <li id="menu-color">
                <a href="#" class="nav-link px-sm-0 px-2">
                    <i class="fs-5 bi-table"></i><span class="ms-1 d-none d-sm-inline">Orders</span></a>
            </li>

            <!-- Mie Modifiche -->

            <!-- Nascondo questo li della sidebar solo per i dispositivi mobile -->
            <li class="d-none d-sm-block" id="menu-color">
                <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                    <i class="fs-4 bi-bootstrap"></i> <span
                        class="ms-1 d-none d-sm-inline dropdown-toggle">Bootstrap</span></a>
                <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 1</a>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 2</a>
                    </li>
                </ul>
            </li>

            <!-- Mostro questo <li> solo per i dispositivi mobili (va a sostituire quello di sopra in mobile) -->
            <li class="dropdown d-block d-sm-none" id="menu-color-mobile">
                <a href="#" class="nav-link dropdown-toggle px-sm-0 px-2" id="dropdown" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fs-5 bi-bootstrap"></i><span class="ms-1 d-none d-sm-inline">Bootstrap</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdown">
                    <li><a class="dropdown-item" href="#">New project...</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
            </li>
            <!-- Fine mie modifiche -->

            <li id="menu-color">
                <a href="#" class="nav-link px-sm-0 px-2">
                    <i class="fs-5 bi-grid"></i><span class="ms-1 d-none d-sm-inline">Products</span></a>
            </li>
            <li id="menu-color">
                <a href="#" class="nav-link px-sm-0 px-2">
                    <i class="fs-5 bi-people"></i><span class="ms-1 d-none d-sm-inline">Customers</span> </a>
            </li>
        </ul>
        
        <div class="dropdown py-sm-4 mt-sm-auto ms-auto ms-sm-0 flex-shrink-1">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ Vite::asset('resources/img/icons/admin-approval.webp') }}" alt="hugenerd" width="28" height="28"
                    class="rounded-circle">
                <span class="d-none d-sm-inline mx-1" id="menu-color">Joe</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                <li><a class="dropdown-item" href="#">New project...</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Sign out</a></li>
            </ul>
        </div>
    </div>
</div>



{{-- <div class="col d-flex flex-column h-100">
            <main class="row">
                <div class="col pt-4">
                    <h3>Vertical Sidebar that switches to Horizontal Navbar</h3>
                    <p class="lead">An example multi-level sidebar with collasible menu items. The menu functions like an "accordion" where only a single menu is be open at a time.</p>
                    <hr />
                    <h3>More content...</h3>
                    <p>Sriracha biodiesel taxidermy organic post-ironic, Intelligentsia salvia mustache 90's code editing brunch. Butcher polaroid VHS art party, hashtag Brooklyn deep v PBR narwhal sustainable mixtape swag wolf squid tote bag. Tote bag cronut semiotics, raw denim deep v taxidermy messenger bag. Tofu YOLO Etsy, direct trade ethical Odd Future jean shorts paleo. Forage Shoreditch tousled aesthetic irony, street art organic Bushwick artisan cliche semiotics ugh synth chillwave meditation. Shabby chic lomo plaid vinyl chambray Vice. Vice sustainable cardigan, Williamsburg master cleanse hella DIY 90's blog.</p>
                    <p>Ethical Kickstarter PBR asymmetrical lo-fi. Dreamcatcher street art Carles, stumptown gluten-free Kickstarter artisan Wes Anderson wolf pug. Godard sustainable you probably haven't heard of them, vegan farm-to-table Williamsburg slow-carb readymade disrupt deep v. Meggings seitan Wes Anderson semiotics, cliche American Apparel whatever. Helvetica cray plaid, vegan brunch Banksy leggings +1 direct trade. Wayfarers codeply PBR selfies. Banh mi McSweeney's Shoreditch selfies, forage fingerstache food truck occupy YOLO Pitchfork fixie iPhone fanny pack art party Portland.</p>
                </div>
            </main>
            <footer class="row bg-light py-4 mt-auto">
                <div class="col"> Bottom footer content here... </div>
            </footer>
        </div> --}}



{{-- </div>
</div> --}}
