<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Prendo tutti i generi:
        $genres = Genre::all();   // Uso il metodo statico all() dal Model Genre per restituire a $geners tutti i dati contenuti 
        return view('genres.index', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('genres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGenreRequest $request)
    {
        $newGenre = new Genre();
        // Assegno alla variabile $data tutti i valori ricevuto dal form
        $data = $request->validated();       //Assegno alla variabile $data i dati validati così se passano posso creare il nuovo genere

        // dd($data);  // controllo se ricevo tutti i dati dalla request
        
        $newGenre->name = $data['name'];
        $newGenre->color = $data['color'];
        $newGenre->genre_description = $data['genre_description'];

        $newGenre->save();    //salvo i nuovi dati nella tabella genres del database movies_db

        // Reindirizzo l'utente alla pagina show per vedere il genere che ha salvato ($newGenre->id è equivalente a $newGenre))
        // Oltre a reindirizzarli nella show, tramite il metodo width() passo anche un dato alla sessione temporanea di tipo "success" con un messaggio "flash" specificato
        return redirect()->route("genres.show", $newGenre)->with('success', 'Regista salvato con successo');
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
    {
        return view('genres.show', compact('genre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
        // Alternativa se come argomento del metodo avessi passato:  public function edit(string $id)
        // Così:
        // $genre = Genre::where("id", $id)->get();
        // dd($genre);

        return view("genres.edit", compact('genre'));
        // Se invece non avessi voluto usare la funzione compact avrei dovuto passare i parametri così:
        // return view('genres.edit', ['genre' => $genre]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGenreRequest $request, Genre $genre)
    {
        /* Avendo passato come argomento della funzione "Genre $genre", e siccome utilizzo la Form Request "UpdateGenreRequest $request" per il controllo della validazione del form, utilizzo questo modo: */
        // Prima prendiamo le richieste e le salviamo su un array letterale:
        $data = $request->validated(); // Meglio usare validated() invece di all(): $data = $request->all(); <---- anche questa è valida però con validated() ottieni solo i dati già filtrati e sicuri.

        // dd($data);  // controllo se ricevo tutti i dati dalla request

        $genre->name = $data['name'];
        $genre->color = $data['color'];
        $genre->genre_description = $data['genre_description'];

        $genre->update();     //aggiorno il regista nel database


        // Reindirizzo l'utente alla pagina show per vedere il Genre che ha modificato ($genre->id è equivalente a $genre))
        return redirect()->route("genres.show", $genre)->with('success', 'Attore modificato con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        // dd($genre);
        $genre->delete();   // cancello il regista

        // Reindirizzo l'utente alla pagina index che restituisce tutti i $genre contenuti nella tabella genres. Oltre a reindirizzarli nella index, tramite il metodo width() passo anche un dato alla sessione temporanea di tipo "success" con un messaggio "flash" specificato
        return redirect()->route('genres.index')->with('success', 'Attore cancellato con successo');
    }
}