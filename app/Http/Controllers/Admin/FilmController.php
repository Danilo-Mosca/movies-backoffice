<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Prendo tutti i film:
        $movies = Film::all();

        return view('movies.index', compact('movies'));    // Uso il metodo statico all() dal Model Film per restituire a $movies tutti i dati contenuti nella tabella films del database movies_db
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Film $movie)
    {

        // Se ho come argomento la stringa dello slug: public function show(string $slug)
        // Allora posso ricavare quel singolo elemento con i seguenti modi:

        // Recupera il film corrispondente allo slug oppure mostra un 404 se non esiste
        // $movie = Film::where('slug', $slug)->firstOrFail();     // invece di inserire: $movie = Film::where('slug', $slug)->get();
        // Oppure:
        // $movie = Film::where('slug', $slug)->first();        // ma in questo caso non verrebbe lanciato l'errore 404 se non lo trova
        
        // dd($movie);
        // Passo il film alla view movies.show:
        return view('movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
