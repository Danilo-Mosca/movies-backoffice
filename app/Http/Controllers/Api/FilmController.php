<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    /* Visualizzo tutti i film */
    public function index()
    {
        // Prendo tutti il film dal database
        // $data = Film::all();    // così mostrerò soltanto tutti i film, senza gli attori, i generi e il regista associati

        // Così prendo tutti i film e mostro i relativi generi, il regista e gli attori associati:
        $data = Film::with('genres', 'director', 'actors')->get();
        
        return response()->json([
            'success' => true,
            'results' => $data,
        ]);
    }

    /* Visualizzo il singolo film */
    public function show(Film $movie){
        // dd($movie);
        // dd($movie->director);
        
        // Voglio visualizzare le relazioni con le tabelle many to many genres e actors e con la tabella 1 to many directors:
        $movie->load('genres', 'actors', 'director');   //in questo modo indico che voglio il mio progetto caricato con i generi,gli attori ed il regista ad esso associati se presenti
        
        return response()->json([
            'success' => true,
            'data' => $movie,
        ]);
    }
}