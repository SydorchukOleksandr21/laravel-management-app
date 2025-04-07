<?php

namespace App\Http\Requests\Guest;

use Illuminate\Foundation\Http\FormRequest;

class GuestRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'phone_number' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ];
    }
}
