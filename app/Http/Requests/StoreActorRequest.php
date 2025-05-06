<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreActorRequest extends FormRequest
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
        return [
            'first_name' => ['required', 'string', 'min:2', 'max:255'],
            'last_name' => ['required', 'string', 'min:2', 'max:255'],
            'birth_date' => ['nullable', 'date', 'before_or_equal:' . now()->subYears(9)->format('Y-m-d'), 'after:1900-01-01'],
            'actor_nationality' => ['nullable', 'string', 'min:2', 'max:30'],
        ];
    }

    // Metodo per ottenere i messaggi di errore personalizzati per la validazione.
    public function messages()
    {
        return [
            'first_name.required' => 'Il nome dell\'attore è obbligatorio.',
            'first_name.min' => 'Il nome dell\'attore deve contenere almeno :min caratteri.',
            'first_name.max' => 'Il nome dell\'attore può contenere al massimo :max caratteri.',

            'last_name.required' => 'Il cognome del regista è obbligatorio.',
            'last_name.min' => 'Il cognome dell\'attore deve contenere almeno :min caratteri.',
            'last_name.max' => 'Il cognome dell\'attore può contenere al massimo :max caratteri.',

            'birth_date.date' => 'La data di nascita dell\'attore deve essere una data valida.',
            'birth_date.before_or_equal' => 'L\'attore deve avere almeno 9 anni.',
            'birth_date.after' => 'La data di nascita dell\'attore non può essere precedente al 1901.',

            'actor_nationality.min' => 'La nazionalità dell\'attore deve contenere almeno :min caratteri.',
            'actor_nationality.max' => 'La nazionalità dell\'attore può contenere al massimo :max caratteri.',
        ];
    }
}
