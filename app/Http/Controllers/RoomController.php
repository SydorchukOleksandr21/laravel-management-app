<?php

namespace App\Http\Controllers;

use App\Http\Controllers\base\Controller;
use App\Http\Controllers\base\ResourceController;
use App\Models\Room;
use App\Models\RoomSample;
use App\Services\Core\ModelSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class RoomController extends ResourceController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $items = (new ModelSearch(Room::class))->search($request);

        return view('rooms.index', [
            'items' => $items,
            'className' => Room::class,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rooms.create');
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

    private function createRoom(RoomSample $roomSample, Request $request, bool $isNew)
    {
        $amount = intval($request->get('rooms_count'));
        $rooms = [];

        DB::transaction(function () use (&$rooms, $amount, $request, $roomSample) {
            for ($i = 0; $i < $amount; $i++) {
                $request->merge(['number' => 5]); // приклад — можна адаптувати

                $rooms[] = $this->save($roomSample->replicate(), $request, [
                    'number' => 'required|integer|min:1',
                    'floor' => 'required|integer|min:1',
                    'note' => 'nullable|string',
                ], false);
            }
        });

        return $rooms;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
