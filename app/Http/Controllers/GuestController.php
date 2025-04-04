<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'phone_number' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $guest = Guest::where('phone_number', $validated['phone_number'])->first();

        if ($guest) {
            $guest->name = $validated['name'];
            $guest->email = $validated['email'];
            $guest->save();

            return response()->json([
                'id' => $guest->id,
                'existed' => true,
            ]);

        } else {
            $newGuest = Guest::create([
                'phone_number' => $validated['phone_number'],
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            return response()->json([
                'id' => $newGuest->id,
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
