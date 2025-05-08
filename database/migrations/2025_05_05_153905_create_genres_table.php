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
        Schema::create('genres', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique();               // nome del genere unico, perchè non possiamo ripetere lo stesso genere
            $table->string('color', 7);     // colore esadecimale associato al genere (sei caratteri più il cancelletto)
            $table->longText('genre_description')->nullable();    // descrizione del genere che può essere anche vuota

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genres');
    }
};
