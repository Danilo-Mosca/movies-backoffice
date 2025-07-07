<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilterFilmRequest;
use App\Http\Requests\StoreFilmRequest;
use App\Models\Actor;
use App\Models\Director;
use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;     // importo la facades contenente la classe Storage per poter fare l'upload dell'immagine

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // Importo la request personalizzata FilterFilmRequest (mi serve per i filtri di ricerca) che ho creato e la passo come argomento:
    public function index(FilterFilmRequest $request)
    {
        // Prendo tutti i film:
        // $movies = Film::all();              // invece di questa istruzione che prende tutti i film e li stampa insieme
        // $movies = Film::paginate(12);     // uso questa istruzione che visualizza una paginazione con 12 elementi per volta
        // Ma non basta solo l'istruzione di sopra, devo richiamare per forza lo scope "scopeFiltra" del model Film (lo scope personalizzato va richiamato senza la parola scope. Es: il metodo nel model "Film" si chiama scopeFiltra() ma qui va richiamato senza scope, quindi solo con filtra() per poter filtrare i risultati se clicco sul pulsante di ricerca (inoltre ritorno i film in ordine alfabetico per titolo con l'istruzione: orderBy('title', 'asc') ):
        $movies = Film::filtra($request->validated())->orderBy('title', 'asc')->paginate(12);

        return view('movies.index', compact('movies'));    // Uso il metodo statico all() dal Model Film per restituire a $movies tutti i dati contenuti nella tabella films del database movies_db
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Recupero tutti i registi dalla suo model e li ordino alfabeticamente per cognome:
        $directors = Director::all()->sortBy('last_name');
        // prendo i generi e li ordino alfabeticamente per nome del genere
        $genres = Genre::all()->sortBy('name');;
        // prendo gli attori e li ordino alfabeticamente per cognome
        $actors = Actor::all()->sortBy('last_name');

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
        /* ALTERNATIVA A: $newMovie->rating = $data['rating'] ?? null;
        $newMovie->rating = $request->input('rating');  // in questo modo se non ricevo un valore dal form me lo inizializza direttamente a null
        */

        $newMovie->nationality = $data['nationality'];
        // Gestisco il caso del regista (se non selezionato assegno al corrispettivo campo "null" altrimenti gli assegno il valore selezionato):
        $newMovie->director_id = $data['director_id'] === 'null' ? null : $data['director_id'];

        // controllo se l'utente ha inserito un'immagine e quindi richiesto l'upload di una immagine:
        if (array_key_exists("poster", $data)) {
            // carichiamo l'immagine nel nostro storage:
            $img_url = Storage::putFile('films', $data['poster']);
            $newMovie->poster = $img_url;       //assegno il path al campo 'poster' della tabella films
        }

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




        // dd($movie->genres);     //mostro i generi per quel film
        // dd($movie->actors);     //mostro gli attori per quel film

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


        // Recupero tutti i registi dalla suo model e li ordino alfabeticamente per cognome:
        $directors = Director::all()->sortBy('last_name');;
        // dd($directors);
        // prendo i generi e li ordino alfabeticamente per nome del genere
        $genres = Genre::all()->sortBy('name');;
        // prendo gli attori e li ordino alfabeticamente per cognome
        $actors = Actor::all()->sortBy('last_name');

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




        // controllo se l'utente ha inserito una nuova immagine per quel film e quindi richiesto l'upload della nuova immagine:
        if (array_key_exists("poster", $data)) {
            // prima elimino l'immagine precedente se presente (se $movie->poster non è null):
            if ($movie->poster) {
                Storage::delete($movie->poster);
            }
            // Poi carico la nuova immagine nel nostro storage:
            $img_url = Storage::putFile('films', $data['poster']);
            // Aggiorno il database:
            $movie->poster = $img_url;       //assegno il path al campo 'poster' della tabella films
        }

        // successivamente salvo i nuovi dati nella tabella
        $movie->update();     //aggiorno il film nel database




        /* COME PER IL CREATE NELLO STORE, DOPO AVER AGGIORNATO IL PROGETTO, E SOLTANTO DOPO PERCHE' A NOI CI SERVE IL DATO DEL FILM SALVATO */

        // SINCRONIZZIAMO I GENERI DELLA TABELLA PIVOT:
        // PRIMA CONTROLLO SE E' STATO EFFETTIVAMENTE PASSATO QUALCHE VALORE DALLA TABELLA GENRES E CHE QUINDI L'ARRAY ESSITA:
        // Avrei potuto inserire anche la seguente condizione: if (isset($data['genres']))
        if ($request->has('genres')) {
            // se l'array esiste, e quindi stiamo ricevendo i generi, allora sincornizziamo i genres della tabella pivot:
            $movie->genres()->sync($data['genres']);
        } else {
            // se non riceviamo dei valori di genres, allora eliminiamo tutti quelli collegati al movie attuale dalla tabella ponte con il metodo detach():
            $movie->genres()->detach();
        }
        // SINCRONIZZIAMO GLI ATTORI DELLA TABELLA PIVOT:
        // COME SOPRA PRIMA CONTROLLO SE E' STATO EFFETTIVAMENTE PASSATO QUALCHE VALORE DALLA TABELLA ACTORS E CHE QUINDI L'ARRAY ESSITA:
        // Avrei potuto inserire anche la seguente condizione: if (isset($data['actors']))
        if ($request->has('actors')) {
            $movie->actors()->sync($data['actors']);
        } else {
            // se non riceviamo dei valori di actors, allora eliminiamo tutti quelli collegati al movie attuale dalla tabella ponte con il metodo detach():
            $movie->actors()->detach();
        }




        // Reindirizzo l'utente alla pagina show per vedere il film che ha modificato ($movie->id è equivalente a $movie))
        return redirect()->route("movies.show", $movie)->with('success', 'Film modificato con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $movie)
    {
        // dd($movie);

        //PRIMA DI TUTTO eliminiamo tutte i GENRE (se presenti) collegati al film attuale (che vogliamo eliminare) dalla tabella ponte, in caso contrario riceveremmo un errore e non riusciremmo a cancellare il record, perchè ha le key associate alla tabella ponte "film_genre" e ho bisogno di eliminare prima quelle con il metodo detach():
        $movie->genres()->detach();    // eliminiamo tutti i valori di genres dalla tabella ponte collegati al film da eliminare
        //COME SOPRA: PRIMA DI TUTTO eliminiamo tutte gli ACTOR (se presenti) collegati al film attuale (che vogliamo eliminare) dalla tabella ponte, in caso contrario riceveremmo un errore e non riusciremmo a cancellare il record, perchè ha le key associate alla tabella ponte "actor_film" e ho bisogno di eliminare prima quelle con il metodo detach():
        $movie->actors()->detach();    // eliminiamo tutti i valori di actors dalla tabella ponte collegati al film da eliminare





        // Controllo se il film che sto per cancellare ha l'immagine collegata, la elimino:
        if ($movie->poster) {
            Storage::delete($movie->poster);
        }





        $movie->delete();   // infine, una volta cancellati i generi e gli attori associati al film (sempre se ne ho qualcuno associato) cancello il film

        // Reindirizzo l'utente alla pagina index che restituisce tutti i $movie contenuti nella tabella films. Oltre a reindirizzarli nella index, tramite il metodo width() passo anche un dato alla sessione temporanea di tipo "success" con un messaggio "flash" specificato
        return redirect()->route('movies.index')->with('success', 'Film cancellato con successo');
    }
}
