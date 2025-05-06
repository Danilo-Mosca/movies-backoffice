<?php

use App\Http\Controllers\Admin\ActorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DirectorController;
use App\Http\Controllers\Admin\FilmController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');      // Con l'url di root reindirizzo automaticamente alla pagina di login
});

Route::get('/dashboard', function () {
    return view('dashboard');       // da sostituire con 'movies'
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// Middleware personalizzato con nome "admin" e prefisso url "admin/" dove ci raggruppo varie:
Route::middleware('auth', 'verified')
    ->name("admin.")
    ->prefix("admin")
    ->group(function () {
        // rotta "/admin" (all'inizio era /admin/index)" con nome "index"
        Route::get('/', [DashboardController::class, "index"])->name("index");
        // rotta "/admin/profile" con nome "profile"
        Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    });





// Rotte CRUD del FilnController:

// Invece di inserire singolarmente ogni metodo HTTP (GET, POST, PUT, PATCH, DELETE) per ogni operazione su ogni risorsa come nell'esempio di seguito:
// Route::get("", [FilmController::class "index"]);

// Laravel ci aiuta con il metodo resources() che genera per noi tutte le rotte necessarie per le nostre CRUD, che poi gestiremo con il controller FilmController:
// Route::resource('movies', FilmController::class);

// In questo caso voglio rendere l'accesso a tutte le rotte di "movies" solo agli utenti registrati:
Route::resource('movies', FilmController::class)->middleware('auth', 'verified');
/* Mentre se volessi rendere pubblico a tutti gli utenti l'accesso sotanto alle rotte "index" (visualizzazione di tutti i movies) e "show" (visualizzazione del singolo film) di "movies", mentre le altre rotte devono essere accessibili esclusivamente agli utenti registrati avrei dovuto inserire le seguenti direttive:
*/
// Rotte pubbliche (senza middleware):
// Route::resource('movies', ProjectController::class)->only(['index', 'show']);
// Rotte protette (con middleware auth):
// Route::resource('movies', ProjectController::class)->except(['index', 'show'])->middleware('auth', 'verified');



// Rendo l'accesso a tutte le rotte di "directors" solo agli utenti registrati:
Route::resource('directors', DirectorController::class)->middleware('auth', 'verified');
// Rendo l'accesso a tutte le rotte di "actors" solo agli utenti registrati:
Route::resource('actors', ActorController::class)->middleware('auth', 'verified');
// Rendo l'accesso a tutte le rotte di "genres" solo agli utenti registrati:
Route::resource('genres', GenreController::class)->middleware('auth', 'verified');

require __DIR__ . '/auth.php';