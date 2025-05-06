<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDirectorRequest;
use App\Models\Director;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Prendo tutti i registi:
        $directors = Director::all();   // Uso il metodo statico all() dal Model Director per restituire a $directors tutti i dati contenuti 
        return view('directors.index', compact('directors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('directors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDirectorRequest $request)
    {
        $newDirector = new Director();
        // Assegno alla variabile $data tutti i valori ricevuto dal form
        $data = $request->validated();       //Assegno alla variabile $data i dati validati così se passano posso creare il nuovo film

        $newDirector->first_name = $data['first_name'];
        $newDirector->last_name = $data['last_name'];
        $newDirector->birth_date = $data['birth_date'];
        $newDirector->nationality = $data['nationality'];

        $newDirector->save();    //salvo i nuovi dati nella tabella directors del database movies_db

        // Reindirizzo l'utente alla pagina show per vedere il film che ha salvato ($newDirector->id è equivalente a $newDirector))
        // Oltre a reindirizzarli nella show, tramite il metodo width() passo anche un dato alla sessione temporanea di tipo "success" con un messaggio "flash" specificato
        return redirect()->route("directors.show", $newDirector)->with('success', 'Regista salvato con successo');
    }

    /**
     * Display the specified resource.
     */
    public function show(Director $director)
    {
        return view('directors.show', compact('director'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Director $director)
    {
        // Alternativa se come argomento del metodo avessi passato:  public function edit(string $slug)
        // Così:
        // $director = Film::where("slug", $slug)->get();
        // dd($director);

        return view("directors.edit", compact('director'));
        // Se invece non avessi voluto usare la funzione compact avrei dovuto passare i parametri così:
        // return view('directors.edit', ['director' => $director]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDirectorRequest $request, Director $director)
    {
        /* Avendo passato come argomento della funzione "Director $director", e siccome utilizzo la Form Request "StoreDirectorRequest $request" per il controllo della validazione del form, utilizzo questo modo: */
        // Prima prendiamo le richieste e le salviamo su un array letterale:
        $data = $request->all();

        $director->first_name = $data['first_name'];
        $director->last_name = $data['last_name'];
        $director->birth_date = $data['birth_date'];
        $director->nationality = $data['nationality'];
        
        $director->update();     //aggiorno il regista nel database


        // Reindirizzo l'utente alla pagina show per vedere il Director che ha modificato ($director->id è equivalente a $director))
        return redirect()->route("directors.show", $director)->with('success', 'Regista modificato con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Director $director)
    {
        // dd($director);
        $director->delete();   // cancello il film

        // Reindirizzo l'utente alla pagina index che restituisce tutti i $director contenuti nella tabella directors. Oltre a reindirizzarli nella index, tramite il metodo width() passo anche un dato alla sessione temporanea di tipo "success" con un messaggio "flash" specificato
        return redirect()->route('directors.index')->with('success', 'Regista cancellato con successo');
    }
}
