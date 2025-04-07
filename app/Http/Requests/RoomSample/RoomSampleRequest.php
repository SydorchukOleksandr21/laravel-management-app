<?php

namespace App\Http\Requests\RoomSample;

use Illuminate\Foundation\Http\FormRequest;

class RoomSampleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'person_count' => 'required|integer|min:1|max:100',
            'square_area' => 'required|integer|min:1|max:1000',
            'description' => 'required|string',
            'image_path' => 'nullable|string'
        ];
    }
}
