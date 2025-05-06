<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    // Accessor in Laravel, serve a creare un attributo virtuale per un modello Eloquent. 
    // Qui creo il metodo getFullNameAttribute() che mi restituirà nome e cognome del regista insieme
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
