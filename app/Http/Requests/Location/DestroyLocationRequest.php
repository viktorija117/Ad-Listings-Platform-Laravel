<?php

namespace App\Http\Requests\Location;

use Illuminate\Foundation\Http\FormRequest;

class DestroyLocationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return []; // Nema posebnih pravila za validaciju.
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $location = $this->route('location'); // Dohvati lokaciju iz rute.

            if ($location && $location->ads()->count() > 0) {
                $validator->errors()->add('ads', 'Ne možete obrisati lokaciju jer ima povezane oglase.');
            }
        });
    }
}
