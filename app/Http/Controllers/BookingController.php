<?php

namespace App\Http\Controllers;

use App\Http\Controllers\base\Controller;
use App\Http\Requests\Booking\BookingRequest;
use App\Services\Booking\BookingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mockery\Exception;

class BookingController extends Controller
{
    protected BookingService $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bookings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookingRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();

            $booking = $this->bookingService->create(
                guestId: $validated['guest_id'],
                roomId: $validated['room_id'],
                dateStart: $validated['date_start'],
                dateEnd: $validated['date_end']
            );

            return response()->json([
                'id' => $booking->id,
            ], 201);

        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to create booking'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
