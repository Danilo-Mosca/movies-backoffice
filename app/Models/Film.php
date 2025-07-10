<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;     // Importo la classe "Str" perchè la richiamo nel metodo booted()

class Film extends Model
{
    // collego il regista (se presente nella sua tabella) al film:
    public function director()
    {
        return $this->belongsTo(Director::class);
    }

    // collego la tabella genres con la tabella films con una relazione many to many:
    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    // collego la tabella actors con la tabella films con una relazione many to many:
    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }





    /* --------------------------------------------- INSERIMENTO SLUG --------------------------------------------- */
    // Metodo specifico di Laravel che usa lo slug al posto dell'id nelle rotte
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Metodo booted() specifico di Laravel genera automaticamente lo slug dal titolo, quindi non devo preoccuparmi di aggiungerlo al seeder, 
    protected static function booted()
    {
        // Quando creo un nuovo film dico di intercettare l'evento "creating" con eloquent e prima di salvare il nuovo film nel DB eseguo questa funzione anonima:
        static::creating(function ($film) {
            // $film->slug = Str::slug($film->title);      // Vecchia soluzione che non controlla se esistono slug univoci

            // Nuova istruzione che richiama il metodo privato generateUniqueSlug() che controlla se già esistono slug con quel nome:
            $film->slug = $film->generateUniqueSlug($film->title);
        });
    }

    /* Funzione privata personalizzata del model che evita di generare automaticamente slug univoci dal titolo. Esempio:
    se ho lo slug "matrix", creerà automaticamente lo slug "matrix-1", "matrix-2" ecc */
    private function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);  // creo uno slug dal titolo
        $originalSlug = $slug;
        $counter = 1;

        // Cicla se trova uno slug esistente: restituisce true ogni volta che ne trova uno, al termine restituirà false ed uscirà dal ciclo
        while (self::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
    /* --------------------------------------------- FINE INSERIMENTO SLUG --------------------------------------------- */
}
