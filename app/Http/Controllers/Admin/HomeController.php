<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actor;
use App\Models\Director;
use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Conto tutti i film, con il metodo "count()" e li assegno alla variabile numMovies
        $numMovies = Film::count();
        // Conto tutti i registi, con il metodo "count()" e li assegno alla variabile numDirectors
        $numDirectors = Director::count();
        // Conto tutti i generi, con il metodo "count()" e li assegno alla variabile numGenres
        $numGenres = Genre::count();
        // Conto tutti gli attori, con il metodo "count()" e li assegno alla variabile numActors
        $numActors = Actor::count();

        // Ritorno la view della homepage e gli passo come argomento le variabili contenenti il numero di valori presenti per ciascuna entità
        return view('home', compact('numMovies', 'numDirectors', 'numGenres', 'numActors'));
    }
}
