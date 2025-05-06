<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGenreRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:2', 'max:255', 'unique:genres,name'],
            'genre_description' => ['nullable', 'string', 'min:10'],
        ];
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
        ];
    }
}
