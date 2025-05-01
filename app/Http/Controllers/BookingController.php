<?php

namespace App\Http\Controllers;

use App\Http\Controllers\base\Controller;
use App\Http\Requests\Booking\BookingRequest;
use App\Models\Booking;
use App\Services\Booking\BookingService;
use App\Services\Core\ModelSearch;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Mockery\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Random\RandomException;

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
    public function index(Request $request): Factory|Application|View
    {
        $items = (new ModelSearch(Booking::class))->search($request);

        return view('rooms.index', [
            'items' => $items,
            'className' => Booking::class,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bookings.create');
    }

    /**
     * @param BookingRequest $request
     * @return RedirectResponse
     * @throws RandomException
     */
    public function store(BookingRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $booking = $this->bookingService->create(
            guestId: $validated['guest_id'],
            roomId: $validated['room_id'],
            dateStart: $validated['date_start'],
            dateEnd: $validated['date_end']
        );

        return redirect()->route('booking.show', ["model" => $booking]);
    }

    /**
     * @param Booking $model
     * @return Factory|View|Application
     */
    public function show(Booking $model): Factory|View|Application
    {
        return view('bookings.show', compact('model'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
