<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DestroyCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return []; // Nema validacija za brisanje.
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $category = $this->route('category'); // Dohvati kategoriju iz rute.

            if ($category && $category->ads()->count() > 0) {
                $validator->errors()->add('ads', 'Ne možete obrisati kategoriju jer ima povezane oglase.');
            }
        });
    }
}
