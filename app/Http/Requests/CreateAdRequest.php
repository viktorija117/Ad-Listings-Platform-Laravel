<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Proveri da li korisnik može kreirati oglas
        return auth()->user()->can('create', \App\Models\Ad::class);
    }

    public function rules(): array
    {
        return []; // Nema dodatnih pravila validacije
    }
}
