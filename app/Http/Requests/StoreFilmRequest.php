<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFilmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    // Metodo che controlla la validazione dei campi del form:
    public function rules(): array
    {
        $currentYear = now()->year; // Definisco la variabile $currentYear

        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'release_year' => ['required', 'integer', 'min:1901', 'max:' . $currentYear],
            'duration' => ['required', 'integer', 'min:1', 'max:255'],
            'rating' => ['nullable', 'integer', 'min:1', 'max:5'],
            'nationality' => ['nullable', 'string', 'max:30'],
            'director_id' => ['nullable'],
            'poster' => ['nullable', 'image', 'max:10240'], // max:10240 significa 10MB

            // Generi opzionali
            'genres' => ['nullable', 'array'],  // il campo 'array' specifica che se il campo genres è presente, deve essere necessariamente un array e non altro (es. stringa, oggetto o altro), altrimenti restituirà errore
            'genres.*' => ['exists:genres,id'], // regola applicata a ciascun elemento dell’array genres[] (il simbolo * è un wildcard): Controlla che ogni elemento dell’array genres sia un valore che esiste nella colonna id della tabella genres. (Se l'id non esiste es. 'genres' => [1, 2, 99] se l’ID 99 non esiste nella tabella genres, Laravel lancerà un errore di validazione specifico per il genres con indice 2)

            // Attori opzionali
            'actors' => ['nullable', 'array'],  // come sopra
            'actors.*' => ['exists:actors,id'], // come sopra
        ];
    }

    // Metodo che personalizza i messaggi di errore:
    public function messages()
    {
        return [
            'title.required' => 'Il titolo è obbligatorio.',
            'title.string' => 'Il titolo deve essere del testo.',
            'title.max' => 'Il titolo non può superare i 255 caratteri.',

            'description.required' => 'La descrizione è obbligatoria.',

            'release_year.required' => 'L\'anno di uscita è obbligatorio.',
            'release_year.integer' => 'L\'anno di uscita deve essere un numero.',
            'release_year.min' => 'L\'anno di uscita non può essere inferiore al 1901.',
            'release_year.max' => 'L\'anno di uscita non può essere successivo all\'anno corrente.',

            'duration.required' => 'La durata è obbligatoria.',
            'duration.integer' => 'La durata deve essere un numero.',
            'duration.min' => 'La durata deve essere almeno di 1 minuto.',
            'duration.max' => 'La durata non può superare i 255 minuti.',

            'rating.integer' => 'Il voto deve essere un numero.',
            'rating.min' => 'Il voto minimo è 1.',
            'rating.max' => 'Il voto massimo è 5.',

            'nationality.string' => 'La nazionalità deve essere una stringa.',
            'nationality.max' => 'La nazionalità può contenere al massimo un valore di 30 caratteri.',

            'director_id.nullable' => 'Il regista non è stato selezionato.',

            'poster.image' => 'Il file caricato deve essere un\'immagine.',
            'poster.max' => 'L\'immagine non può superare i 2MB.',

            'genres.array' => 'Il formato dei generi non è valido.',
            'genres.*.exists' => 'Uno dei generi selezionati non è valido.',

            'actors.array' => 'Il formato degli attori non è valido.',
            'actors.*.exists' => 'Uno degli attori selezionati non è valido.',
        ];
    }
}
