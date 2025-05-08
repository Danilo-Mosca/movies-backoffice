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
        Schema::table('films', function (Blueprint $table) {
            $table->dropColumn('director_id');

            /* Mi creo la foreign key (chiave esterna) nella colonna 'director_id', con il comando:
            $table->foreignId('director_id')
            con il comando: after('nationality') specifico semplicemente di aggiungere questa colonna nella tabella dopo la colonna "nationality"
            la rendo nullabile, e aggiungo il metodo constrained():
            Con ->constrained(), Laravel capisce a quale tabella riferirsi automaticamente (director_id) grazie al nome della colonna
            e crea automaticamente la chiave esterna (foreign key).
            Inoltre il metodo: onDelete('set null');
            setta autamaticamente a "null" questo campo per la tabella films qualora il director (regista) specifico venga cancellato
            nella tabella directors. 
            A differenza di:
            onDelete('cascade')
            che avrebbe aggiunto una regola di eliminazione automatica: "se il record padre viene cancellato, cancella anche i figli".
            */
            $table->foreignId('director_id')->after('nationality')->nullable()->constrained()->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('films', function (Blueprint $table) {
            // Prima di tutto eliminiamo la constrain
            // Prima bisogna droppare (cancellare) il vincolo applicato dalla chiave esterna:
            $table->dropForeign('films_director_id_foreign');   //nome tabella_nomeColonna_foreign
            // Successivamente droppiamo la colonna:
            $table->dropColumn('director_id');

            // Successivamente ricreiamo la colonna "director_id"
            $table->integer('director_id')->unsigned()->nullable();
        });
    }
};
