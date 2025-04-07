<?php

namespace App\Http\Requests\Auth;

class SignupRequest extends LoginRequest
{
    public function rules(): array
    {
        $previousFields = parent::rules();

        return array_merge($previousFields,
            ["name" => ["required", "string", "max:255"]]
        );
    }
}
