<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Omogućava svim korisnicima sa pravima pristup.
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ime kategorije je obavezno.',
            'name.max' => 'Ime kategorije ne sme imati više od 255 karaktera.',
        ];
    }
}
