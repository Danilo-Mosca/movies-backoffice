{{-- Styles: istruzione che permette a Laravel di cercare le risorse per Bootstrap ed SCSS: 
      In questo caso oltre ad importare il file "app.scss" c'è il CSS personalizzato generico, 
      importo anche il file "sidebar.scss" (nella cartella "partials") che contiene il CSS specifico per la sidebar: 
      e importo anche il file sidebar.js (nella cartella "resources/js") che contiene il codice Javascript per i dropdown-toggle --}}
 @vite(['resources/sass/app.scss', 'resources/sass/partials/sidebar.scss', 'resources/js/app.js', 'resources/js/sidebar.js'])


<div class="col-12 col-sm-3 col-xl-2 px-sm-2 px-0 bg-dark d-flex sticky-top">
    <div class="d-flex flex-sm-column flex-row flex-grow-1 align-items-center align-items-sm-start px-3 pt-2 text-white">
        <a href="/" class="d-flex align-items-center pb-sm-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-5">M<span class="d-none d-sm-inline">ovies</span></span>
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
                <a href="#" class="nav-link dropdown-toggle dropdown-toggle-mobile px-sm-0 px-2" id="dropdown" data-bs-toggle="dropdown"
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
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle dropdown-toggle-admin"
                id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ Vite::asset('resources/img/icons/admin-approval.webp') }}" alt="hugenerd" width="28" height="28"
                    class="rounded-circle">
                <span class="d-none d-sm-inline mx-1" id="menu-color">Admin</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                <li><a class="dropdown-item" href="#">New project...</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Sign out</a></li>
            </ul>
        </div>
    </div>
</div>