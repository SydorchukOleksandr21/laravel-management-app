<?php

namespace App\Http\Controllers;

use App\Http\Controllers\base\ResourceController;
use App\Models\Room;
use App\Services\Core\ModelSearch;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Validation\ValidationException;

class RoomController extends ResourceController
{
    /**
     * @param Request $request
     * @return Factory|Application|View
     */
    public function index(Request $request): Factory|Application|View
    {
        $items = (new ModelSearch(Room::class))->search($request);

        return view('rooms.index', [
            'items' => $items,
            'className' => Room::class,
        ]);
    }

    /**
     * @return View|Application|Factory
     */
    public function create(): View|Application|Factory
    {
        return view('rooms.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
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
            $first = $existing[0];

            // Додаємо помилку до поля 'number'
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'number' => __('error.room.number_range', [
                        'number' => $first,
                    ]),
                ]);
        }

        $this->createRooms($request);

        return redirect()->route('room.show');
    }

    /**
     * @param $id
     * @return Factory|Application|View
     */
    public function show($id): Factory|Application|View
    {
        $model = Room::findOrFail($id);

        return view('rooms.show', compact('model'));
    }

    /**
     * @param Room $model
     * @return View|Application|Factory
     */
    public function edit(Room $model): View|Application|Factory
    {
        return view('rooms.edit', compact('model'));
    }

    /**
     * @param Request $request
     * @param string $id
     * @return void
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
     * @throws ValidationException
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
                'room_sample_id' => 'required|integer',
                'note' => 'nullable|string',
            ], true);
        }

        //});

        return $rooms;
    }


    /**
     * @param Room $model
     * @return RedirectResponse
     */
    public function destroy(Room $model): RedirectResponse
    {
        $model->delete();

        return response()->redirectToRoute("room.index");
    }
}
