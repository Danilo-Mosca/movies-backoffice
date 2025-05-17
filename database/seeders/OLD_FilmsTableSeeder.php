<?php

namespace Database\Seeders;

use App\Models\Actor;
use App\Models\Film;
use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// importo i faker
use Faker\Generator as Faker;

class FilmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        /* -------- PER POPOLARE IN MODO CASUALE LA TABELLA "films" CON GLI ATTORI DISPONIBILI PRIMA RECUPERO QUESTE: -------- */
        $actors = Actor::all();
        /* -------- PER POPOLARE IN MODO CASUALE LA TABELLA "films" CON I GENERI DISPONIBILI PRIMA RECUPERO QUESTI: -------- */
        $genres = Genre::all();



        for ($i = 0; $i < 24; $i++) {
            $newFilm = new Film();

            $newFilm->title = $faker->sentence(rand(1, 5));   // Genera un titolo che contiene tra 1 e 5 parole scelte casualmente
            $newFilm->description = $faker->text(250);  // Genera una stringa di testo casuale con massimo 250 caratteri
            // $newFilm->release_year = $faker->date();     // Genera una data con il formato dd/mm/YYYY mentre di default è: 'Y-m-d'
            $newFilm->release_year = $faker->year;  // Genera una stringa contenente un anno casuale
            $newFilm->duration = rand(60, 255);     // rand() genera un numero casuale compreso tra 60 e 255
            $newFilm->rating = rand(1, 5);     // rand() genera un numero casuale compreso tra 1 e 5
            $newFilm->poster = 'https://loremflickr.com/640/480/movie?random=' . $faker->unique()->numberBetween(1, 10000);   // Genera un url ad una immagine in 640x480 pixel da loremflickr a sostituzione di placeholder.com che ha chiuso
            $newFilm->nationality = substr($faker->country(), 0, 30);  // Genera una nazione casuale che abbia un numero massimo di caratteri compreso tra 0 e 30
            $newFilm->director_id = rand(1, 24);    // rand() genera un numero casuale compreso tra 1 e 24 per associare ad ogni tabella un regista della tabella directors

            $newFilm->save();   //Salva il film appena creato





            /* -------- ASSOCIO GLI ATTORI AL PROGETTO INSERENDO CASUALMENTE IN MANIERA RANDOMICA ALLA VARIABILE $randomActors UN VALORE COMPRESO TRA 1 E 24 COME SONO IL NUMERO DI ATTORI CHE HO INSERITO NEL SEEDER DELLA TABELLA actors: -------- */
            $randomActors = $actors->random(rand(1, 24))->unique('id');     // IMPORTANTE: CON L'ISTRUZIONE unique('id'); INDICO A LARAVEL DI AGGIUNGERE SI UNO O PIU' ATTORI CASUALI ALLO STESSO FILM, MA DI NON RIPETERE LO STESSO ATTORE PIU' DI UNA VOLTA PER LO STESSO FILM.
            // Scrivo all'interno della tabella Ponte utilizzando il metodo attach() passandogli come argomento il valore generato casualmente in precedenza:
            $newFilm->actors()->attach($randomActors);
            /* -------- FINE ASSOCIAZIONE ATTORI AL SINGOLO FILM -------- */

            /* -------- COME SOPRA ASSOCIO I GENERI AL PROGETTO INSERENDO CASUALMENTE IN MANIERA RANDOMICA ALLA VARIABILE $randomGenres UN VALORE COMPRESO TRA 1 E 13 COME SONO IL NUMERO DI GENERI CHE HO INSERITO NEL SEEDER DELLA TABELLA genres: -------- */
            $randomGenres = $genres->random(rand(1, 13))->unique('id');     // IMPORTANTE: CON L'ISTRUZIONE unique('id'); INDICO A LARAVEL DI AGGIUNGERE SI UNO O PIU' GENERI CASUALI ALLO STESSO FILM, MA DI NON RIPETERE LO STESSO GENERE PIU' DI UNA VOLTA PER LO STESSO FILM.
            // Scrivo all'interno della tabella Ponte utilizzando il metodo attach() passandogli come argomento il valore generato casualmente in precedenza:
            $newFilm->genres()->attach($randomGenres);
            /* -------- FINE ASSOCIAZIONE GENERI AL SINGOLO FILM -------- */
        }
    }
}
