<?php

namespace App\Http\Controllers;

use App\Enums\ValueType;
use App\Http\Controllers\base\ResourceController;
use App\Models\RoomSample;
use App\Services\Core\ImageModelService;
use App\Services\Core\ModelSearch;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomSampleController extends ResourceController
{
    /**
     * @param Request $request
     * @return Factory|Application|View
     */
    public function index(Request $request): Factory|Application|View
    {
        $items = (new ModelSearch(RoomSample::class))->search($request);

        return view('roomSamples.index', [
            'items' => $items,
            'className' => RoomSample::class,
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $modelSearch = new ModelSearch(RoomSample::class);
        $id = $request->get("id", '');

        if ($id) {
            $items = $modelSearch->getByID(intval($id));
        } else {
            $items = $modelSearch->search($request);
        }

        return response()->json($items);
    }

    /**
     * @param Request $request
     * @return Factory|View|Application
     */
    public function create(Request $request): Factory|View|Application
    {
        return view('roomSamples.create');
    }

    /**
     * @param $id
     * @return Factory|View|Application
     */
    public function show($id): Factory|View|Application
    {
        $model = RoomSample::findOrFail($id);

        return view('roomSamples.show', compact('model'));
    }

    /**
     * @param RoomSample $model
     * @return Factory|Application|View
     */
    public function edit(RoomSample $model): Factory|Application|View
    {
        return view('roomSamples.edit', ['model' => $model]);
    }


    /**
     * Store a new RoomSample record.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function store(Request $request): JsonResponse
    {
        $roomSample = new RoomSample();
        $roomSample = $this->saveRoomSample($roomSample, $request, true);

        return response()->json([
            'message' => 'Room sample created successfully',
            'id' => $roomSample->id
        ], 201);
    }

    /**
     * Update an existing RoomSample record.
     *
     * @param Request $request
     * @param RoomSample $model
     * @return JsonResponse
     * @throws Exception
     */
    public function update(Request $request, RoomSample $model): JsonResponse
    {
        $model = $this->saveRoomSample($model, $request, false);

        return response()->json([
            'message' => 'Room sample updated successfully',
            'id' => $model->id
        ], 200);
    }


    /**
     * Handle RoomSample creation or update.
     *
     * @param RoomSample $roomSample
     * @param Request $request
     * @param bool $isNew
     * @return RoomSample
     * @throws Exception
     */
    private function saveRoomSample(RoomSample $roomSample, Request $request, bool $isNew): RoomSample
    {
        $imageName = $roomSample->image_path;

        if ($request->filled('image')) {
            if (!$isNew && $imageName) {
                if (Storage::exists($roomSample->getImagePath())) {
                    Storage::delete($roomSample->getImagePath());
                }
            }

            $base64Image = $request->input('image');
            $imageModeService = new ImageModelService($roomSample);
            $imageName = $imageModeService->storeBase64Image("image_path", $base64Image);

            $roomSample->fill([
                'image_path' => $imageName,
            ]);
        }

        $this->save($roomSample, $request, [
            'name' => 'required|string|max:255',
            'person_count' => 'required|integer|min:1',
            'square_area' => 'required|numeric|min:0',
            'description' => 'string',
            'image' => 'string',
            'price' => 'nullable|numeric',
        ], false);


        $roomSample->save();

        // Update room parameters
        if ($request->filled('room_parameters')) {
            $roomSample->roomParameters()->delete();

            $parameters = array_map(function ($param) {
                return [
                    'name' => $param['name'] ?? '',
                    'value_type' => ValueType::from(intval($param['type'])) ?? ValueType::String->value,
                    'value' => $param['value'] ?? '',
                ];

            }, $request->input('room_parameters', []));

            $roomSample->roomParameters()->createMany($parameters);
        }

        return $roomSample;
    }

    /**
     * @param RoomSample $model
     * @return RedirectResponse
     */
    public function destroy(RoomSample $model): RedirectResponse
    {
        if (Storage::exists($model->getImagePath())) {
            Storage::delete($model->getImagePath());
        }

        $model->delete();

        return response()->redirectToRoute("room-sample.index");
    }
}
