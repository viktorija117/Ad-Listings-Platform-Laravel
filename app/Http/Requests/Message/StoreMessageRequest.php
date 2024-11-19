<?php

namespace App\Http\Requests\Message;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
{
    public function authorize()
    {
        // Proveri da li je korisnik prijavljen
        return auth()->check();
    }

    public function rules()
    {
        return [
            'message' => 'required|string|max:1000',
            'receiver_id' => 'required|exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'message.required' => 'Poruka je obavezna.',
            'message.string' => 'Poruka mora biti tekstualna.',
            'receiver_id.required' => 'Primalac poruke je obavezan.',
            'receiver_id.exists' => 'Odabrani primalac ne postoji.',
        ];
    }
}
