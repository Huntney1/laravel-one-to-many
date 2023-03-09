<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; //! Inserire Questa Classe

class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //! Cambiare valore da False a True per Autorizzare...
    }

    /**
     * Get the validation rules that apply to the request.
     ** Ottenere le regole di convalida applicabili alla richiesta.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //? la Classe [Rule] da la possibilita di modificare il progetto anche se esiste.
            'title' => ['required', Rule::unique('projects')->ignore($this->project), 'max:40'], // campo obbligatorio con una lunghezza massima di 255 caratteri
            'description' => ['nullable'], //* campo facoltativo di tipo stringa
            'category' => ['nullable'], // campo facoltativo di tipo stringa
            /* 'image' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048', 'dimensions:min_width=100,min_height=100,max_width=5000,max_height=5000'], */ //*  campo facoltativo di tipo immagine con i formati consentiti JPEG, PNG, JPG, GIF e SVG e dimensione massima di 2 MB
             'published' => ['filled'], //* campo facoltativo che deve essere una data valida
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     ** Ottenere i messaggi di errore per le regole di convalida definite.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Il titolo del progetto è obbligatorio',
            'title.unique' => 'Il titolo del progetto è già stato utilizzato',
            'title.max' => 'Il titolo del progetto non può superare i :max caratteri',
            'description.string' => 'La descrizione del progetto deve essere una stringa',
            /* 'image.image' => 'Il file caricato non è un\'immagine',
            'image.mimes' => 'Il file caricato deve essere in formato: :values',
            'image.max' => 'Il file caricato non può superare i :max Kb',
            'image.dimensions' => 'Le dimensioni dell\'immagine devono essere tra :min_widthx:min_height', */
        ];
    }
}
