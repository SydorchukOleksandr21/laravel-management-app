<?php

namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int number
 * @property int floor
 * @property int room_sample_id
 * @property string note
 */
class RoomRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'number' => 'required|integer|min:1',
            'floor' => 'required|integer|min:1',
            'room_sample_id' => 'required',
            'notes' => 'nullable|string',
        ];
    }
}
