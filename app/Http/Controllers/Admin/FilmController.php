<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFilmRequest;
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
        // Recupero tutti i registi dalla sua tabella:
        // $director = Director::all();

        return view('movies.create');
        // Potevo scriverlo anche così:
        // return view('movies/create', ['director' => $director]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFilmRequest $request)
    {
        // dd($request);
        $newMovie = new Film();
        /*
        METODO ALTERNATIVO:
        $newMovie->request['title'];
        $newMovie->request['description'];
        $newMovie->request['release_year'];
        $newMovie->request['duration'];
        $newMovie->request['rating'];
        $newMovie->request['poster'];
        $newMovie->request['nationality'];
        $newMovie->request['director_id'];

        $newMovie->save();      //salvo i nuovi dati nella tabella films del database movies_db
        */

        // Assegno alla variabile $data tutti i valori ricevuto dal form
        $data = $request->validated();       //Assegno alla variabile $data i dati validati così se passano posso creare il nuovo film
        // dd($data);
        $newMovie->title = $data['title'];
        $newMovie->description = $data['description'];
        $newMovie->release_year = $data['release_year'];
        $newMovie->duration = $data['duration'];
        $newMovie->rating = $data['rating'] ?? null;    // Se $data['rating'] esiste, cioè l'ho inserito nel form allora gli assegno un valore, altrimenti gli assegno null.
        
        
        /* ALTERNATIVA A: $newMovie->rating = $data['rating'] ?? null;
        $newMovie->rating = $request->input('rating');  // in questo modo se non ricevo un valore dal form me lo inizializza direttamente a null
        */

        
        // $newMovie->poster = $data['poster'];         PER ORA NON UTILIZZARE
        $newMovie->nationality = $data['nationality'];
        // $newMovie->director_id = $data['director_id'];   PER ORA NON UTILIZZARE

        $newMovie->save();      //salvo i nuovi dati nella tabella films del database movies_db

        /* DOPO AVER SALVATO IL PROGETTO, E SOLTANTO DOPO PERCHE' A NOI CI SERVE IL DATO DEL FILM SALVATO */

        // Reindirizzo l'utente alla pagina show per vedere il film che ha salvato ($newMovie->id è equivalente a $newMovie))
        // Oltre a reindirizzarli nella show, tramite il metodo width() passo anche un dato alla sessione temporanea di tipo "success" con un messaggio "flash" specificato
        return redirect()->route("movies.show", $newMovie)->with('success', 'Film salvato con successo');
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
