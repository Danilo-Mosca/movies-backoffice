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
            'nationality' => ['nullable', 'string', 'max:90'],
        ];
    }

    // Metodo che personalizza i messaggi di errore:
    public function messages()
    {
        return [
            'title.required' => 'Il titolo è obbligatorio.',
            'title.string' => 'Il titolo deve essere una stringa.',
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
            'nationality.max' => 'La nazionalità può contenere al massimo 90 caratteri.',
        ];
    }
}
