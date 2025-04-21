<?php

namespace App\Http\Controllers;

use App\Http\Controllers\base\ResourceController;
use App\Models\Room;
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
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $amount = intval($request->get('rooms_count'));
        $startNumber = intval($request->get('number'));

        $sequence = $this->generateSequence($startNumber, $amount);

        // Перевіряємо наявність номерів у базі
        $existing = DB::table(Room::tableName())
            ->whereIn('number', $sequence)
            ->pluck('number')
            ->toArray();

        if (!empty($existing)) {
            $min = min($existing);
            $max = max($existing);

            // Додаємо помилку до поля 'number'
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'number' => __('error.room.number_range', [
                        'from' => $min,
                        'to' => $max,
                    ]),
                ]);
        }

        $this->createRooms($request);

        return redirect()->route('rooms.index')->with('success', __('Кімнати успішно створено.'));
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

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
     * Generate a sequence of numbers starting from a given value.
     *
     * @param int $start
     * @param int $count
     * @return array
     */
    private function generateSequence(int $start, int $count): array
    {
        return range($start, $start + $count - 1);
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    private function createRooms(Request $request): array
    {
        $amount = intval($request->get('rooms_count'));
        $rooms = [];
        $startNumber = intval($request->get('number'));

        //DB::transaction(function () use (&$rooms, $amount, $request, $startNumber) {
            for ($i = 0; $i < $amount; $i++) {
                $room = new Room();

                $request->merge(['number' => $startNumber + $i]);

                $rooms[] = $this->save($room, $request, [
                    'number' => 'required|integer|min:1|unique:rooms,number',
                    'floor' => 'required|integer|min:1',
                    'note' => 'nullable|string',
                ]);
            }
        //});

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
