<?php

namespace App\Http\Requests\Location;

use Illuminate\Foundation\Http\FormRequest;

class StoreLocationRequest extends FormRequest
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
            'name.required' => 'Ime lokacije je obavezno.',
            'name.max' => 'Ime lokacije ne sme imati više od 255 karaktera.',
        ];
    }
}
