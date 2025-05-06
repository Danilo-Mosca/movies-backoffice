{{-- Styles: istruzione che permette a Laravel di cercare le risorse per Bootstrap ed SCSS: 
      In questo caso oltre ad importare il file "app.scss" c'è il CSS personalizzato generico, 
      importo anche il file "sidebar.scss" (nella cartella "partials") che contiene il CSS specifico per la sidebar: 
      e importo anche il file sidebar.js (nella cartella "resources/js") che contiene il codice Javascript per i dropdown-toggle --}}
@vite(['resources/sass/app.scss', 'resources/sass/partials/sidebar.scss', 'resources/js/app.js', 'resources/js/sidebar.js'])


<div class="col-12 col-sm-3 col-xl-2 px-sm-2 px-0 bg-dark d-flex sticky-top">
    <div class="d-flex flex-sm-column flex-row flex-grow-1 align-items-center align-items-sm-start px-3 pt-2 text-white">
        <a href="{{ route('movies.index') }}"
            class="d-flex align-items-center pb-sm-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-5">M<span class="d-none d-sm-inline">ovies</span></span>
        </a>
        <ul class="nav nav-pills flex-sm-column flex-row flex-nowrap flex-shrink-1 flex-sm-grow-0 flex-grow-1 mb-sm-auto mb-0 justify-content-center align-items-center align-items-sm-start"
            id="menu">
            <li class="nav-item" id="menu-color">
                <a href="{{ route('movies.index') }}" class="nav-link px-sm-0 px-2">
                    <i class="fs-4 bi-house"></i><span class="ms-1 d-none d-sm-inline">Home</span>
                </a>
            </li>

            <!-- Sezione Film -->
            <!-- DESKTOP Nascondo questo <li> della sidebar solo per i dispositivi mobile -->
            <li class="d-none d-sm-block" id="menu-color">
                <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                    <i class="fs-4 bi bi-film"></i> <span
                        class="ms-1 d-none d-sm-inline dropdown-toggle film">Film</span></a>
                <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="{{ route('movies.index') }}" class="nav-link px-0"> <span
                                class="d-none d-sm-inline">Lista dei</span> film</a>
                    </li>
                    <li>
                        <a href="{{ route('movies.create') }}" class="nav-link px-0"> <span
                                class="d-none d-sm-inline">Aggiungi un</span> film</a>
                    </li>
                </ul>
            </li>

            <!-- MOBILE Mostro questo <li> solo per i dispositivi mobili (va a sostituire quello di sopra in mobile) -->
            <li class="dropdown d-block d-sm-none" id="menu-color-mobile">
                <a href="#" class="nav-link dropdown-toggle dropdown-toggle-mobile film px-sm-0 px-2" id="dropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fs-5 bi bi-film"></i><span class="ms-1 d-none d-sm-inline">Film</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdown">
                    <li><a class="dropdown-item" href="{{ route('movies.index') }}">Lista dei film</a></li>
                    <li><a class="dropdown-item" href="{{ route('movies.create') }}">Aggiungi un film</a></li>
                </ul>
            </li>
            <!-- Fine sezione film -->

            <!-- Sezione Registi -->
            <!-- DESKTOP Nascondo questo <li> della sidebar solo per i dispositivi mobile -->
            <li class="d-none d-sm-block" id="menu-color">
                <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                    <i class="fs-4 bi bi-camera-reels"></i> <span
                        class="ms-1 d-none d-sm-inline dropdown-toggle registi">Registi</span></a>
                <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="{{ route('directors.index') }}" class="nav-link px-0"> <span
                                class="d-none d-sm-inline">Lista dei</span> registi</a>
                    </li>
                    <li>
                        <a href="{{ route('directors.create') }}" class="nav-link px-0"> <span
                                class="d-none d-sm-inline">Aggiungi un</span> regista</a>
                    </li>
                </ul>
            </li>

            <!-- MOBILE Mostro questo <li> solo per i dispositivi mobili (va a sostituire quello di sopra in mobile) -->
            <li class="dropdown d-block d-sm-none" id="menu-color-mobile">
                <a href="#" class="nav-link dropdown-toggle dropdown-toggle-mobile registi px-sm-0 px-2" id="dropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fs-5 bi bi-camera-reels"></i><span class="ms-1 d-none d-sm-inline">Registi</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdown">
                    <li><a class="dropdown-item" href="{{ route('directors.index') }}">Lista dei registi</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="{{ route('directors.create') }}">Aggiungi un regista</a></li>
                </ul>
            </li>
            <!-- Fine sezione Registi -->

            <!-- Sezione Attori -->
            <!-- DESKTOP Nascondo questo <li> della sidebar solo per i dispositivi mobile -->
            <li class="d-none d-sm-block" id="menu-color">
                <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                    <i class="fs-4 bi bi-camera-reels"></i> <span
                        class="ms-1 d-none d-sm-inline dropdown-toggle attori">Attori</span></a>
                <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="{{ route('actors.index') }}" class="nav-link px-0"> <span
                                class="d-none d-sm-inline">Lista degli</span> attori</a>
                    </li>
                    <li>
                        <a href="{{ route('actors.create') }}" class="nav-link px-0"> <span
                                class="d-none d-sm-inline">Aggiungi un</span> attore</a>
                    </li>
                </ul>
            </li>

            <!-- MOBILE Mostro questo <li> solo per i dispositivi mobili (va a sostituire quello di sopra in mobile) -->
            <li class="dropdown d-block d-sm-none" id="menu-color-mobile">
                <a href="#" class="nav-link dropdown-toggle dropdown-toggle-mobile attori px-sm-0 px-2" id="dropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fs-5 bi bi-camera-reels"></i><span class="ms-1 d-none d-sm-inline">Attori</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdown">
                    <li><a class="dropdown-item" href="{{ route('actors.index') }}">Lista degli attori</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="{{ route('actors.create') }}">Aggiungi un attore</a></li>
                </ul>
            </li>
            <!-- Fine sezione Attori -->

            <!-- Sezione Generi -->
            <!-- DESKTOP Nascondo questo <li> della sidebar solo per i dispositivi mobile -->
            <li class="d-none d-sm-block" id="menu-color">
                <a href="#submenu4" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                    <i class="fs-4 bi bi-camera-reels"></i> <span
                        class="ms-1 d-none d-sm-inline dropdown-toggle generi">Generi</span></a>
                <ul class="collapse nav flex-column ms-1" id="submenu4" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="{{ route('genres.index') }}" class="nav-link px-0"> <span
                                class="d-none d-sm-inline">Lista dei</span> generi</a>
                    </li>
                    <li>
                        <a href="{{ route('genres.create') }}" class="nav-link px-0"> <span
                                class="d-none d-sm-inline">Aggiungi un</span> genere</a>
                    </li>
                </ul>
            </li>

            <!-- MOBILE Mostro questo <li> solo per i dispositivi mobili (va a sostituire quello di sopra in mobile) -->
            <li class="dropdown d-block d-sm-none" id="menu-color-mobile">
                <a href="#" class="nav-link dropdown-toggle dropdown-toggle-mobile generi px-sm-0 px-2" id="dropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fs-5 bi bi-camera-reels"></i><span class="ms-1 d-none d-sm-inline">Generi</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdown">
                    <li><a class="dropdown-item" href="{{ route('genres.index') }}">Lista dei generi</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="{{ route('genres.create') }}">Aggiungi un genere</a></li>
                </ul>
            </li>
            <!-- Fine sezione Generi -->

            
            
            
            
            {{-- <li id="menu-color">
                <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-sm-0 px-2">
                    <i class="fs-5 bi-speedometer2"></i><span class="ms-1 d-none d-sm-inline">Dashboard</span> </a>
            </li>
            <li id="menu-color">
                <a href="#" class="nav-link px-sm-0 px-2">
                    <i class="fs-5 bi-table"></i><span class="ms-1 d-none d-sm-inline">Orders</span></a>
            </li>

            <li id="menu-color">
                <a href="#" class="nav-link px-sm-0 px-2">
                    <i class="fs-5 bi-grid"></i><span class="ms-1 d-none d-sm-inline">Products</span></a>
            </li>
            <li id="menu-color">
                <a href="#" class="nav-link px-sm-0 px-2">
                    <i class="fs-5 bi-people"></i><span class="ms-1 d-none d-sm-inline">Customers</span> </a>
            </li>
         --}}
        
        
        
        
        
        </ul>

        <div class="dropdown py-sm-4 mt-sm-auto ms-auto ms-sm-0 flex-shrink-1">
            <a href="#"
                class="d-flex align-items-center text-white text-decoration-none dropdown-toggle dropdown-toggle-admin"
                id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ Vite::asset('resources/img/icons/admin-approval.webp') }}" alt="hugenerd" width="28"
                    height="28" class="rounded-circle">

                {{-- Importo la Facades Auth per prelevare il nome dell'utente loggato e poterlo poi inserire successivamente nella parte bassa della sidebar: --}}
                @php
                    use Illuminate\Support\Facades\Auth;
                    $user = Auth::user();
                @endphp

                <span class="d-none d-sm-inline mx-1" id="menu-color">{{ $user->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile config</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Sign out</a></li>
            </ul>
        </div>
    </div>
</div>
