<?php

namespace App\Http\Controllers;

use App\Http\Controllers\base\ResourceController;
use App\Http\Requests\Room\RoomRequest;
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
     * @param RoomRequest $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(RoomRequest $request): RedirectResponse
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

        $rooms = $this->createRooms($request);

        return redirect()->route('room.index');
    }

    /**
     * @param Room $model
     * @return Factory|Application|View
     */
    public function show(Room $model): Factory|Application|View
    {
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
     * @param RoomRequest $request
     * @param Room $model
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(RoomRequest $request, Room $model)
    {
        $number = $request->number;

        $isNumberExists = DB::table(Room::tableName())
            ->where('number', $number)
            ->exists();

        if ($isNumberExists) {
            $isBelongsToSameModel = DB::table(Room::tableName())
                ->where('number', $number)
                ->where('id', $model->id)
                ->exists();

            if (!$isBelongsToSameModel) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors([
                        'number' => __('error.room.number_range', [
                            'number' => $number,
                        ]),
                    ]);
            }
        }

        $this->save($model, $request);

        return redirect()->route('room.show', $model->id);

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
     * @param RoomRequest $request
     * @return array
     * @throws ValidationException
     */
    private function createRooms(RoomRequest $request): array
    {
        $amount = intval($request->get('rooms_count'));
        $startNumber = intval($request->number);

        $rooms = [];

        for ($i = 0; $i < $amount; $i++) {
            $room = new Room();
            $this->save($room, $request, isSave: false);

            $room->number = $startNumber + $i;
            $room->save();

            $rooms[] = $room;
        }

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
