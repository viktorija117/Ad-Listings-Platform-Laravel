<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DestroyAdRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Proveri da li korisnik može obrisati oglas
        return auth()->user()->can('delete', $this->route('ad'));
    }

    public function rules(): array
    {
        return []; // Nema dodatnih pravila validacije
    }
}
