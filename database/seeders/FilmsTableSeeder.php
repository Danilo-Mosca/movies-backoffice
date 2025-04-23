<?php

namespace Database\Seeders;

use App\Models\Film;
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
        for ($i = 0; $i < 10; $i++) {
            $newFilm = new Film();

            $newFilm->title = $faker->word();   // Genera una parola che verrà utilizzata come nome del film
            $newFilm->description = $faker->text(250);  // Genera una stringa di testo casuale con massimo 150 caratteri
            // $newFilm->release_year = $faker->date();     // Genera una data con il formato dd/mm/YYYY mentre di default è: 'Y-m-d'
            $newFilm->release_year = $faker->year;  // Genera una stringa contenente un anno casuale
            $newFilm->duration = rand(60, 255);     // rand() genera un numero casuale compreso tra 60 e 255
            $newFilm->rating = rand(1, 5);     // rand() genera un numero casuale compreso tra 1 e 5
            $newFilm->poster = $faker->imageUrl(640, 480, 'movie', true);   // Genera un url ad una immagine in 640x480 pixel a sostituzione di placeholder.com che ha chiuso
            $newFilm->nationality = $faker->country();  // Genera una nazione casuale
            $newFilm->director_id = rand(1,100);    // rand() genera un numero casuale compreso tra 1 e 100

            $newFilm->save();   //Salva il film appena creato
        }
    }
}
