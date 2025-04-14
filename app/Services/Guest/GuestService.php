<?php

namespace App\Services\Guest;

use App\Models\Guest;
use App\Services\Booking\BookingService;

class GuestService
{
    /**
     * @param string $phone_number
     * @param string $email
     * @param string $name
     * @return Guest
     */
    public function create(string $phone_number, string $email, string $name): Guest
    {
        return Guest::create([
            'name' => $name,
            'email' => $email,
            'phone_number' => $phone_number,
        ]);
    }

    /**
     * @param Guest $guest
     * @param string $email
     * @param string $name
     * @return Guest
     */
    public function update(Guest $guest, string $email, string $name): Guest
    {
        $guest->update([
            'name' => $name,
            'email' => $email,
        ]);

        return $guest;
    }
}
