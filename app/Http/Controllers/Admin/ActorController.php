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

    // Passo come argomento l'oggetto di tipo Request (mi serve per i filtri di ricerca), che rappresenta l'intera richiesta HTTP (inclusi i parametri GET del form)
    public function index(Request $request)
    {
        // Prendo tutti gli attori:
        // $actors = Actor::all();   // Uso il metodo statico all() dal Model Actor per restituire a $actors tutti i dati contenuti

        /* Al posto dell'istruzione di sopra, che restitutisce tutti i gli attori devo inserire il seguente codice per poter filtrare i risultati se clicco sul pulsante di ricerca */

        // Creo un oggetto query builder per il model Actor, che permette di costruire dinamicamente una query SQL:
        $query = Actor::query();    // È equivalente a fare: SELECT * FROM actors
        // ma permette la possibilità di aggiungere condizioni in base all'input dell'utente, prima di eseguire la query.

        // Se l'utente ha compilato il campo first_name, viene aggiunta una clausola WHERE alla query:
        // Con filled() verifico che il campo non siano vuoto '' o null, così posso filtrare anche solo per nome o solo per cognome o restituire tutti i valori non filtrati
        if ($request->filled('first_name')) {
            $query->where('first_name', 'like', '%' . $request->first_name . '%');
        }
        // Come sopra per first_name, viene aggiunta un'altra condizione WHERE, che si accumula alla precedente:
        if ($request->filled('last_name')) {
            $query->where('last_name', 'like', '%' . $request->last_name . '%');
        }

        // Ordina gli attori per cognome (last_name) in ordine alfabetico
        $query->orderBy('last_name', 'asc');

        // Paginazione: 12 attori per pagina, con parametri preservati (->appends)
        // Laravel si occupa in automatico di calcolare la pagina corrente (usando ?page=2, ?page=3, ecc.). appends($request->all()) serve a mantenere i filtri nella paginazione: Quando clicco su "pagina 2", Laravel aggiunge anche first_name=... e last_name=... all'URL della pagina successiva
        $actors = $query->paginate(12)->appends($request->all());

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
