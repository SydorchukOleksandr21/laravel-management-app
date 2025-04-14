<?php

namespace App\Http\Controllers;

use App\Http\Requests\Guest\GuestRequest;
use App\Models\Guest;
use App\Services\Guest\GuestService;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * @var GuestService
     */
    protected GuestService $guestService;

    /**
     * @param GuestService $guestService
     */
    public function __construct(GuestService $guestService)
    {
        $this->guestService = $guestService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * @param GuestRequest $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(GuestRequest $request, string $id)
    {
        $validated = $request->validated();

        $guest = Guest::where('phone_number', $validated['phone_number'])->first();

        if ($guest) {
            $this->guestService->update(
                $guest,
                email: $validated['email'],
                name: $validated['name'],
            );

            return response()->json([
                'id' => $guest->id,
                'existed' => true,
            ]);

        } else {
            $guest = $this->guestService->create(
                phone_number: $validated['phone_number'],
                email: $validated['email'],
                name: $validated['name'],
            );

            return response()->json([
                'id' => $guest->id,
                'existed' => false,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
