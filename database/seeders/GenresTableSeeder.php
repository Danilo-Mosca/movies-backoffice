<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// importo i faker
use Faker\Generator as Faker;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $genres = [
            'Azione',
            'Commedia',
            'Drammatico',
            'Horror',
            'Fantascienza',
            'Fantasy',
            'Thriller',
            'Avventura',
            'Romantico',
            'Animazione',
            'Documentario',
            'Musicale',
            'Western'
        ];
        /* SE VOLESSI GENERARE CONTENUTI AL CAMPO CASUALMENTE potrei utilizzare il metodo $faker->randomElement():
            Genero un array contenenti vari generi da me creati e li assegno al campo name casualmente col metodo randomElement().
            Il metodo randomElement() in PHP Faker serve a scegliere casualmente un elemento da un array fornito, come in questo caso:
            
                $newGenre->name = $faker->randomElement([
                'Azione',
                'Commedia',
                'Drammatico',
                'Horror',
                'Fantascienza',
                'Fantasy',
                'Thriller',
                'Avventura',
                'Romantico',
                'Animazione',
                'Documentario',
                'Musicale',
                'Western'
            ]);
            */

        for ($i = 0; $i < 13; $i++) {
            $newGenre = new Genre();

            $newGenre->name = $genres[$i];
            $newGenre->genre_description = $faker->text(250);  // Genera una stringa di testo casuale con massimo 250 caratteri

            $newGenre->save();   //Salva il genere appena creato
        }
    }
}
