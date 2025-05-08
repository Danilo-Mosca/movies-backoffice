<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGenreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    // Metodo che controlla la validazione dei campi del form:
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:255', Rule::unique('genres', 'name')->ignore($this->genre)],
            'genre_description' => ['nullable', 'string', 'min:10'],
            'color' => ['required'],
        ];

        /* -------------------------------------------------------------------------------
        IMPORTANTE: La riga di codice Rule::unique('genres', 'name')->ignore($this->genre)
        serve a dire a Laravel:
        "Controlla che il campo name sia unico nella tabella genres, ma ignora il record che sto modificando."
        Nello specifico l'istruzione:
        Rule::unique('genres', 'name')      // serve a dire che il valore deve essere unico nella colonna "name" della tabella "genres".
        È l'equivalente della stringa:  'unique:genres,name'   Ma usando Rule::unique() puoi aggiungere eccezioni, cosa che serve proprio nell'update.

        Mentre l'istruzione:
        ->ignore($this->genre)      // serve a dire: quando controlli l'unicità, ignora il record corrente, cioè quello che sto modificando.

        Laravel capisce $this->genre grazie al Route Model Binding (cioè il fatto che tu passi Genre $genre come parametro nella route e nel controller).
        Laravel trasforma $this->genre nel valore dell'id del record attuale.
        Esempio concreto:
        Supponiamo che nel DB hai questo record:
        id	    name
        1	    Horror
        Ora stai modificando proprio il genere con id = 1.
        Se non metti ->ignore($this->genre), Laravel ti bloccherà dicendo che "Horror" esiste già, anche se è lo stesso valore del record che stai aggiornando.
        Con ignore(), Laravel dice:
        “OK, esiste ‘Horror’, ma è nel record con ID 1, quindi va bene.”

        Quindi RIEPILOGO:
        Rule::unique('genres', 'name')->ignore($this->genre)
        Significa:
        “Il campo name deve essere unico nella tabella genres, escludendo il record corrente che sto modificando (quello identificato da $this->genre).”
        ------------------------------------------------------------------------------- */
    }

    // Metodo per ottenere i messaggi di errore personalizzati per la validazione:
    public function messages()
    {
        return [
            'name.required' => 'Il nome del genere è obbligatorio.',
            'name.string' => 'Il genere deve essere del testo.',
            'name.min' => 'Il nome del genere deve contenere almeno :min caratteri.',
            'name.max' => 'Il nome del genere può contenere al massimo :max caratteri.',
            'name.unique' => 'Questo nome di genere è già stato utilizzato! Devi inserirne uno univoco.',

            'genre_description.min' => 'La descrizione del genere deve contenere almeno :min caratteri.',

            'color.required' => 'Colore del genere richiesto',
        ];
    }
}
