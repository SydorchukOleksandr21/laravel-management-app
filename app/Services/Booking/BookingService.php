<?php

namespace App\Services\Booking;

use App\Http\Requests\Booking\BookingRequest;
use App\Models\Booking;
use Random\RandomException;

class BookingService
{
    /**
     * @param int $guestId
     * @param int $roomId
     * @param string $dateStart
     * @param string $dateEnd
     * @return Booking
     * @throws RandomException
     */
    public function create(int $guestId, int $roomId, string $dateStart, string $dateEnd): Booking
    {
        return Booking::create([
            'guest_id' => $guestId,
            'room_id' => $roomId,
            'date_start' => $dateStart,
            'date_end' => $dateEnd,
            'is_paid' => false,
            'pin_code' => random_int(1000, 9999),
        ]);
    }
}
