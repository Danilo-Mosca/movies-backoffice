<?php

namespace Database\Seeders;

use App\Models\Director;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// importo i faker
use Faker\Generator as Faker;

class DirectorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i=0; $i < 24; $i++) {
            $newDirector = new Director();

            $newDirector->first_name = $faker->firstName();
            $newDirector->last_name = $faker->lastName();
            $newDirector->birth_date = $faker->date('Y-m-d', '2015-01-01');   // questo genera una data casuale prima del 1/01/2015
            $newDirector->nationality = substr($faker->country(), 0, 30);  // Genera una nazione casuale che abbia un numero massimo di caratteri compreso tra 0 e 30

            $newDirector->save();   //Salva il regista appena creato
        }
    }
}
