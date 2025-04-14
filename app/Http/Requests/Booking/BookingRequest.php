<?php

namespace App\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'guest_id' => 'required|int|exists:guests,id',
            'room_id' => 'required|int|exists:rooms,id',
            'date_start' => 'required|date|after_or_equal:today',
            'date_end' => 'required|date|after:date_start',
        ];
    }
}
