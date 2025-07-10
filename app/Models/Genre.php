<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    // collego la tabella films con la tabella genres con una relazione many to many:
    public function films()
    {
        return $this->belongsToMany(Film::class);
    }
}
