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

    // Passo come argomento l'oggetto di tipo Request (mi serve per i filtri di ricerca), che rappresenta l'intera richiesta HTTP (inclusi i parametri GET del form)
    public function index(Request $request)
    {
        // Prendo tutti gli attori:
        // $directors = Director::all();   // Uso il metodo statico all() dal Model Director per restituire a $directors tutti i dati contenuti

        /* Al posto dell'istruzione di sopra, che restitutisce tutti i gli attori devo inserire il seguente codice per poter filtrare i risultati se clicco sul pulsante di ricerca */

        // Creo un oggetto query builder per il model Director, che permette di costruire dinamicamente una query SQL:
        $query = Director::query();    // È equivalente a fare: SELECT * FROM directors
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

        // Paginazione: 12 registi per pagina, con parametri preservati (->appends)
        // Laravel si occupa in automatico di calcolare la pagina corrente (usando ?page=2, ?page=3, ecc.). appends($request->all()) serve a mantenere i filtri nella paginazione: Quando clicco su "pagina 2", Laravel aggiunge anche first_name=... e last_name=... all'URL della pagina successiva
        $directors = $query->paginate(12)->appends($request->all());
        
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
        $newDirector->director_nationality = $data['director_nationality'];

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
        // $director = Director::where("slug", $slug)->get();
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
        $director->director_nationality = $data['director_nationality'];
        
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
