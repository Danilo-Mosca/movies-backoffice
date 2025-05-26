<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenresController extends Controller
{
    public function index()
    {
        // Recupera tutti i generi dal database
        $genres = Genre::all(['id', 'name']); // prendo solo id e name per leggerezza

        return response()->json([
            'success' => true,
            'genres' => $genres,
        ]);
    }
}
