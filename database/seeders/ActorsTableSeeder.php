<?php

namespace Database\Seeders;

use App\Models\Actor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// importo i faker
use Faker\Generator as Faker;

class ActorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 24; $i++) {
            $newActor = new Actor();

            $newActor->first_name = $faker->firstName();
            $newActor->last_name = $faker->lastName();
            $newActor->birth_date = $faker->date('Y-m-d', '2015-01-01');   // questo genera una data casuale prima del 1/01/2015
            $newActor->nationality = substr($faker->country(), 0, 30);  // Genera una nazione casuale che abbia un numero massimo di caratteri compreso tra 0 e 30

            $newActor->save();   //Salva il regista appena creato
        }
    }
}
