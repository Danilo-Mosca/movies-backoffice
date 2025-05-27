<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    /* Visualizzo tutti i film o soltanto quelli filtrati dal frontend in base alla ricerca che ricevo grazie al passaggio del parametro "Request $request" */
    public function index(Request $request)
    {
        // Recupero dei parametri dalla query string
        $query = $request->query('query');  // recupero i dati passati nella ricerca del parametro 'query' da ?query=xxx
        $genre     = $request->query('genre');
        $director  = $request->query('director');
        $actor     = $request->query('actor');
        $year      = $request->query('year');
        // Recupero tutti i film e i relativi generi, il regista e gli attori associati:
        $filmsQuery = Film::with('genres', 'director', 'actors');   // Recupero tutti i film e i relativi generi, il regista e gli attori associati:

        // Verifico se ci sono corrispondenze tra la query di ricerca passata nella request del front con i valori presenti nel database:

        // Filtro per titolo del film
        if ($query) {
            $filmsQuery->where('title', 'like', '%' . $query . '%');    // Se il titolo corrisponde lo assegno alla variabile $filmsQuery
        }

        // Filtro per nome del genere (relazione many-to-many)
        if ($genre) {
            $filmsQuery->whereHas('genres', function ($q) use ($genre) {
                $q->where('name', 'like', '%' . $genre . '%');
            });
        }

        // Filtro per "nome e cognome" o "cognome e nome" del regista (relazione one-to-many)
        if ($director) {
            $filmsQuery->whereHas('director', function ($q) use ($director) {
                $q->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $director . '%'])
                    ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ['%' . $director . '%']);
            });
        }

        // Filtro per "nome e cognome" o "cognome e nome" dell'attore (relazione many-to-many)
        if ($actor) {
            $filmsQuery->whereHas('actors', function ($q) use ($actor) {
                $q->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $actor . '%'])
                    ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ['%' . $actor . '%']);
            });
        }

        // Filtro per anno di uscita
        if ($year) {
            $filmsQuery->whereYear('release_year', $year);
        }

        // Infine imposto la paginazione con il metodo paginate(numero_paginazione) per la visualizzazione di 12 film per pagina:
        $data = $filmsQuery->paginate(12);

        return response()->json([
            'success' => true,
            'results' => $data,
        ]);
    }

    /* VECCHIO CODICE CHE VISUALIZZA SOLTANTO TUTTI I FILM  (E NON RICEVE ARGOMENTI DI REQUEST DAL FRONT): */
    // public function index()
    // {
    // Prendo tutti il film dal database
    // $data = Film::all();    // così mostrerò soltanto tutti i film, senza gli attori, i generi e il regista associati

    // Così prendo tutti i film e mostro i relativi generi, il regista e gli attori associati:
    // $data = Film::with('genres', 'director', 'actors')->get();       //senza paginazione: con il metodo ->get();
    //     $data = Film::with('genres', 'director', 'actors')->paginate(12);   //con paginazione con il metodo paginate(numero_paginazione);

    //     return response()->json([
    //         'success' => true,
    //         'results' => $data,
    //     ]);
    // }

    /* Visualizzo il singolo film */
    public function show(Film $movie)
    {
        // dd($movie);
        // dd($movie->director);

        // Voglio visualizzare le relazioni con le tabelle many to many genres e actors e con la tabella 1 to many directors:
        $movie->load('genres', 'actors', 'director');   //in questo modo indico che voglio il mio progetto caricato con i generi,gli attori ed il regista ad esso associati se presenti

        return response()->json([
            'success' => true,
            'movie' => $movie,
        ]);
    }
}
