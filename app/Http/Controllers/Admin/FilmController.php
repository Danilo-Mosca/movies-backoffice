<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFilmRequest;
use App\Models\Actor;
use App\Models\Director;
use App\Models\Film;
use App\Models\Genre;
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
        // Recupero tutti i registi dalla suo model:
        $directors = Director::all();
        // dd($directors);
        // prendo i generi
        $genres = Genre::all();
        // prendo gli attori
        $actors = Actor::all();

        return view('movies.create', compact('directors', 'genres', 'actors'));
        // Potevo scriverlo anche così:
        // return view('movies/create', ['director' => $director]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFilmRequest $request)
    {
        // dd($request->all());
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
        // $newMovie->poster = $data['poster'];         PER ORA NON UTILIZZARE
        $newMovie->rating = $data['rating'] ?? null;    // Se $data['rating'] esiste, cioè l'ho inserito nel form allora gli assegno un valore, altrimenti gli assegno null.
        $newMovie->nationality = $data['nationality'];
        // Gestisco il caso del regista (se non selezionato assegno al corrispettivo campo "null" altrimenti gli assegno il valore selezionato):
        $newMovie->director_id = $data['director_id'] === 'null' ? null : $data['director_id'];


        /* ALTERNATIVA A: $newMovie->rating = $data['rating'] ?? null;
        $newMovie->rating = $request->input('rating');  // in questo modo se non ricevo un valore dal form me lo inizializza direttamente a null
        */


        $newMovie->save();      //salvo i nuovi dati nella tabella films del database movies_db

        /* DOPO AVER SALVATO IL PROGETTO, E SOLTANTO DOPO PERCHE' A NOI CI SERVE IL DATO DEL FILM SALVATO */

        // PRIMA CONTROLLO SE E' STATO EFFETTIVAMENTE PASSATO QUALCHE VALORE DALLA TABELLA GENRES E CHE QUINDI L'ARRAY ESSITA:
        // Avrei potuto inserire anche la seguente condizione: if (isset($data['genres']))
        if ($request->has('genres')) {
            // se l'array esiste, e quindi stiamo ricevendo i generi, salvo i dati nella tabella Ponte che ha relazione molti a molti tra le tabelle films e genres:
            $newMovie->genres()->attach($data['genres']);   //richiamo il metodo genres() creato nel Model di Project che crea la relazione molti a molti e con il metodo attach() gli passo l'array dei genres ricevuti dalla request
        }
        // COME SOPRA PRIMA CONTROLLO SE E' STATO EFFETTIVAMENTE PASSATO QUALCHE VALORE DALLA TABELLA ACTORS E CHE QUINDI L'ARRAY ESSITA:
        // Avrei potuto inserire anche la seguente condizione: if (isset($data['actors']))
        if ($request->has('actors')) {
            $newMovie->actors()->attach($data['actors']);
        }





        // Reindirizzo l'utente alla pagina show per vedere il film che ha salvato ($newMovie->id è equivalente a $newMovie))
        // Oltre a reindirizzarli nella show, tramite il metodo width() passo anche un dato alla sessione temporanea di tipo "success" con un messaggio "flash" specificato
        return redirect()->route("movies.show", $newMovie)->with('success', 'Film salvato con successo');
    }

    /**
     * Display the specified resource.
     */
    public function show(Film $movie)
    {

        // Grazie ad eloquent così in questo modo stampo la proprietà directors:
        // dd($movie->director);
        // Oppure richiamo il metodo getFullNameAttribute() che restituisce nome e cognome insieme:
        // dd($movie->director->getFullNameAttribute());


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
    public function edit(Film $movie)
    {
        // dd($slug);

        // Alternativa se come argomento del metodo avessi passato:  public function edit(string $slug)
        // Così:
        // $movie = Film::where("slug", $slug)->get();
        // dd($movie);


        // Recupero tutti i registi dalla suo model:
        $directors = Director::all();
        // dd($directors);
        // prendo i generi
        $genres = Genre::all();
        // prendo gli attori
        $actors = Actor::all();

        return view("movies.edit", compact('movie', 'directors', 'genres', 'actors'));
        // Se invece non avessi voluto usare la funzione compact avrei dovuto passare i parametri così:
        // return view('movies.edit', ['movie' => $movie]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreFilmRequest $request, Film $movie)
    {
        // dd($request);

        /*
        ANCHE QUI AVREI POTUTO UTILIZZARE:
        public function update(Request $request, string $slug)
        {
        Modifichiamo le informazioni contenute nel post:
        $movie = Film::where('slug', $slug)->firstOrFail();
        $movie->title = $request['title'];
        $movie->description = $request['description'];
        $movie->release_year = $request['release_year'];
        $movie->duration = $request['duration'];
        $movie->rating = $request['rating'];
        $movie->update();     //aggiorno il film nel database
        }
         */

        /* Ma avendo passato come argomento della funzione "Film $movie", e siccome utilizzo la Form Request "StoreFilmRequest $request" per il controllo della validazione del form, utilizzo questo modo: */
        // Prima prendiamo le richieste e le salviamo su un array letterale:
        $data = $request->all();

        $movie->title = $data['title'];
        $movie->description = $data['description'];
        $movie->release_year = $data['release_year'];
        $movie->duration = $data['duration'];
        $movie->rating = $data['rating'] ?? null;       // o anche l'equivalente:   $movie->rating = $data['rating'];
        // $movie->poster = $data['poster'];         PER ORA NON UTILIZZARE
        $movie->nationality = $data['nationality'];
        // Gestisco il caso del regista (se non selezionato assegno al corrispettivo campo "null" altrimenti gli assegno il valore selezionato):
        $movie->director_id = $data['director_id'] === 'null' ? null : $data['director_id'];

        $movie->update();     //aggiorno il film nel database


        // Reindirizzo l'utente alla pagina show per vedere il film che ha modificato ($movie->id è equivalente a $movie))
        return redirect()->route("movies.show", $movie)->with('success', 'Film modificato con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $movie)
    {
        // dd($movie);
        $movie->delete();   // cancello il film

        // Reindirizzo l'utente alla pagina index che restituisce tutti i $movie contenuti nella tabella films. Oltre a reindirizzarli nella index, tramite il metodo width() passo anche un dato alla sessione temporanea di tipo "success" con un messaggio "flash" specificato
        return redirect()->route('movies.index')->with('success', 'Film cancellato con successo');
    }
}
