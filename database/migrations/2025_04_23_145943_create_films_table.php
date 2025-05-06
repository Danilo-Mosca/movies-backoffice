<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->longText('description');
            // $table->string('release_year', 4);      //creo una colonna di tipo varchar che può contenere massimo 4 caratteri. Ottima per il formato YYYY dell'anno
            $table->year('release_year');       // creo una colonna di tipo year
            $table->tinyInteger('duration')->unsigned();    //creo una colonna di tipo tinyInteger senza segno che conterrò un numero compreso tra 0 e 255
            $table->tinyInteger('rating')->unsigned()->nullable();
            $table->string('poster')->nullable();
            $table->string('nationality', 30)->nullable();      // campo con massimo 30 caratteri
            $table->integer('director_id')->unsigned()->nullable();
            $table->string('slug')->unique(); // slug unico

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
