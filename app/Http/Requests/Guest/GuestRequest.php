<?php

namespace App\Http\Requests\Guest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GuestRequest extends FormRequest
{
    public function rules(): array
    {
        $id = $this->route('model')?->id;

        return [
            'phone_number' => [
                'required',
                'string',
                Rule::unique('guests', 'phone_number')->ignore($id),
            ],
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ];
    }
}
