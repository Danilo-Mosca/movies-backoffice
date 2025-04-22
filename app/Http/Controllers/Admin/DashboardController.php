<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Visualizziamo l'oggetto dell'utente attualmente loggato attraverso il metodo statico user() della classe Auth
        // dd(Auth::user());

        // Mi salvo l'utente attualmente loggato su una variabile:
        $user = Auth::user();
        // Visualizzo l'id dell'utente attualmente loggato. Questo perchè "L'OGGETTO DELL'UTENTE E' UN MODEL!!!!!!"
        // return $user->id;

        // Controllo utente loggato: se vero ritorna 1 a schermo, altrimenti 0 che è false. In questo caso naturalmente restituira sempre 1 perchè c'è un middleware che controlla l'autenticazione prima di passare la palla al controller della rotta
        // echo Auth::check();

        return "Benvenuto nella dashboard da amministratore di " . $user->name;
    }

    public function profile()
    {
        $user = Auth::user();
        return "Pagina profile backoffice di " . $user->name;
    }
}