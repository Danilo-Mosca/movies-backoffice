<?php

namespace Database\Seeders;

use App\Models\Film;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $films = config('films');

        foreach ($films as $filmData) {
            // Estrai attori e generi separatamente. Esempio: se in una certa riga di $filmData esiste il campo 'actors' allora con il null coalescing operator (??) alla variabile $actors viene assegnato tutto il contenuto del campo 'actors', altrimenti ad $actors viene assegnato un array vuoto [], con zero elementi. Questo evita errori "Undefined index: genres" garantendo che  $actors e $genres siano sempre definiti come array, anche vuoti se non ci sono dati.
            $actors = $filmData['actors'] ?? [];
            $genres = $filmData['genres'] ?? [];

            // Rimuovo le chiavi "actors" e "genres" dall'array associativo passato dal file config('films') perchè questi devono essere associati alla tabella ponte "actor_film" e film_genre". Nella tabella "films" non esistono
            unset($filmData['actors'], $filmData['genres']);

            $film = Film::create($filmData);

            // Qui controllo se presenti per quel film e li assegno alle rispettive tabelle ponte:
            if (!empty($actors)) {
                $film->actors()->attach($actors);
            }
            if (!empty($genres)) {
                $film->genres()->attach($genres);
            }
        }
    }
}
