<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    // collego la tabella films con la tabella actors con una relazione many to many:
    public function films()
    {
        return $this->belongsToMany(Film::class);
    }




    // Accessor in Laravel, serve a creare un attributo virtuale per un modello Eloquent. 
    // Qui creo il metodo getFullNameAttribute() che mi restituirà nome e cognome dell'attore insieme
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
