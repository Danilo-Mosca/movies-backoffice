<?php

use App\Http\Controllers\Api\FilmController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Mostra tutti i film:
Route::get('movies', [FilmController::class, 'index']);   //questa rotta risponderà all'indirizzo: http://127.0.0.1:8000/api/movies

// Mostro il singolo film:
Route::get('movies/{movie}', [FilmController::class, 'show']);  //questa rotta risponderà all'indirizzo: http://127.0.0.1:8000/api/movies/{slug-del-film}