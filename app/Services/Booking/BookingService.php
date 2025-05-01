<?php

namespace App\Services\Booking;

use App\Http\Requests\Booking\BookingRequest;
use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomSample;
use Random\RandomException;
use Illuminate\Support\Collection;

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
        $room = Room::query()->findOrFail($roomId);
        $roomSample = $room->roomSample;

        return Booking::create([
            'guest_id' => $guestId,
            'room_id' => $roomId,
            'date_start' => $dateStart,
            'date_end' => $dateEnd,
            'is_paid' => false,
            'price' => $roomSample->price,
            'pin_code' => random_int(1000, 9999),
        ]);
    }

    /**
     * @param \DateTimeInterface $startDate
     * @param \DateTimeInterface $endDate
     * @param int|null $roomSampleId
     * @return Collection
     */
    public function getAvailableRooms(\DateTimeInterface $startDate, \DateTimeInterface $endDate, ?int $roomSampleId = null): Collection
    {
        $query = Room::query()
            ->whereDoesntHave('bookings', function ($query) use ($startDate, $endDate) {
                $query->where(function ($q) use ($startDate, $endDate) {
                    $q->where('date_start', '<', $endDate)
                        ->where('date_end', '>', $startDate);
                });
            });

        if ($roomSampleId !== null) {
            $query->where('room_sample_id', $roomSampleId);
        }

        return $query->get();
    }
}
