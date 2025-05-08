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
        Schema::create('film_genre', function (Blueprint $table) {
            $table->id();

            $table->foreignId('film_id')->constrained()->onDelete('cascade');   // ->onDelete('cascade'); <----- Per evitare problemi futuri e mantenere il database pulito senza record orfani.
            $table->foreignId('genre_id')->constrained()->onDelete('cascade');  // ->onDelete('cascade'); <----- Per evitare problemi futuri e mantenere il database pulito senza record orfani.
            $table->unique(['film_id', 'genre_id']);    // questa istruzione impedisce che la stessa combinazione film + genere venga inserita più di una volta nella tabella film_genre (che è la tabella pivot della relazione many-to-many tra film e genere).
            // INFATTI DEVO EVITARE DI INSERIRE LO STESSO GENERE PIU' DI UNA VOLTA NELLO STESSO FILM. QUESTO SERVE AD EVITARE CIO'

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('film_genre');
    }
};
