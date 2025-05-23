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



    // Scope per il filtro di ricerca
    public function scopeFiltra($query, $filtri)
    {
        return $query
            ->when($filtri['title'] ?? null, fn($q, $val) => $q->where('title', 'like', "%$val%"));
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
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        // Cicla finchè non trova uno slug esistente:
        while (self::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
    /* --------------------------------------------- FINE INSERIMENTO SLUG --------------------------------------------- */
}
