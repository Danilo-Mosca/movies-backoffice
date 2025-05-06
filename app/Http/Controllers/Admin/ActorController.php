<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreActorRequest;
use App\Models\Actor;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Prendo tutti i registi:
        $actors = Actor::all();   // Uso il metodo statico all() dal Model Actor per restituire a $actors tutti i dati contenuti 
        return view('actors.index', compact('actors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('actors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreActorRequest $request)
    {
        $newActor = new Actor();
        // Assegno alla variabile $data tutti i valori ricevuto dal form
        $data = $request->validated();       //Assegno alla variabile $data i dati validati così se passano posso creare il nuovo film

        $newActor->first_name = $data['first_name'];
        $newActor->last_name = $data['last_name'];
        $newActor->birth_date = $data['birth_date'];
        $newActor->actor_nationality = $data['actor_nationality'];

        $newActor->save();    //salvo i nuovi dati nella tabella actors del database movies_db

        // Reindirizzo l'utente alla pagina show per vedere il film che ha salvato ($newActor->id è equivalente a $newActor))
        // Oltre a reindirizzarli nella show, tramite il metodo width() passo anche un dato alla sessione temporanea di tipo "success" con un messaggio "flash" specificato
        return redirect()->route("actors.show", $newActor)->with('success', 'Regista salvato con successo');
    }

    /**
     * Display the specified resource.
     */
    public function show(Actor $actor)
    {
        return view('actors.show', compact('actor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Actor $actor)
    {
        // Alternativa se come argomento del metodo avessi passato:  public function edit(string $id)
        // Così:
        // $actor = Actor::where("id", $id)->get();
        // dd($actor);

        return view("actors.edit", compact('actor'));
        // Se invece non avessi voluto usare la funzione compact avrei dovuto passare i parametri così:
        // return view('actors.edit', ['actor' => $actor]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreActorRequest $request, Actor $actor)
    {
        /* Avendo passato come argomento della funzione "Actor $actor", e siccome utilizzo la Form Request "StoreDirectorRequest $request" per il controllo della validazione del form, utilizzo questo modo: */
        // Prima prendiamo le richieste e le salviamo su un array letterale:
        $data = $request->all();

        $actor->first_name = $data['first_name'];
        $actor->last_name = $data['last_name'];
        $actor->birth_date = $data['birth_date'];
        $actor->actor_nationality = $data['actor_nationality'];

        $actor->update();     //aggiorno il regista nel database


        // Reindirizzo l'utente alla pagina show per vedere l'Actor che ha modificato ($actor->id è equivalente a $actor))
        return redirect()->route("actors.show", $actor)->with('success', 'Attore modificato con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Actor $actor)
    {
        // dd($actor);
        $actor->delete();   // cancello il regista

        // Reindirizzo l'utente alla pagina index che restituisce tutti gli $actor contenuti nella tabella actors. Oltre a reindirizzarli nella index, tramite il metodo width() passo anche un dato alla sessione temporanea di tipo "success" con un messaggio "flash" specificato
        return redirect()->route('actors.index')->with('success', 'Attore cancellato con successo');
    }
}
