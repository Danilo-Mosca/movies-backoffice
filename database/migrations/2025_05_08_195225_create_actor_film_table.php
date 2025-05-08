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
        Schema::create('actor_film', function (Blueprint $table) {
            $table->id();

            $table->foreignId('film_id')->constrained()->onDelete('cascade');   // ->onDelete('cascade'); <----- Per evitare problemi futuri e mantenere il database pulito senza record orfani.
            $table->foreignId('actor_id')->constrained()->onDelete('cascade');  // ->onDelete('cascade'); <----- Per evitare problemi futuri e mantenere il database pulito senza record orfani.
            $table->unique(['film_id', 'actor_id']);    // questa istruzione impedisce che la stessa combinazione attore + film venga inserita più di una volta nella tabella actor_film (che è la tabella pivot della relazione many-to-many tra attori e film).
            // INFATTI DEVO EVITARE DI INSERIRE LO STESSO ATTORE PIU' DI UNA VOLTA NELLO STESSO FILM. QUESTO SERVE AD EVITARE CIO'

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actor_film');
    }
};
