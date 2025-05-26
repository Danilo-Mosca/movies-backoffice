<?php

use App\Http\Controllers\Api\FilmController;
use App\Http\Controllers\Api\GenresController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Mostra tutti i film:
Route::get('movies', [FilmController::class, 'index']);   //questa rotta risponderà all'indirizzo: http://127.0.0.1:8000/api/movies

// Mostro il singolo film:
Route::get('movies/{movie}', [FilmController::class, 'show']);  //questa rotta risponderà all'indirizzo: http://127.0.0.1:8000/api/movies/{slug-del-film}

// Recupero tutti i generi:
Route::get('/genres', [GenresController::class, 'index']);   //questa rotta risponderà all'indirizzo: http://127.0.0.1:8000/api/genres e restituirà tutti i generi presenti nel database