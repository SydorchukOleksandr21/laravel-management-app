<?php

namespace App\Http\Controllers;

use App\Enums\ValueType;
use App\Http\Controllers\base\Controller;
use App\Http\Controllers\base\ResourceController;
use App\Models\RoomSample;
use App\Services\Core\ImageModelService;
use App\Services\Core\ModelSearch;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class RoomSampleController extends ResourceController
{
    /**
     * @param Request $request
     */
    public function index(Request $request)
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
        $items = (new ModelSearch(RoomSample::class))->search($request);

        return response()->json($items);
    }

    public function create(Request $request)
    {
        return view('roomSamples.create');
    }

    public function show(int $id)
    {
        $roomSample = RoomSample::findOrFail($id);

        return view('roomSamples.show', compact('roomSample'));
    }

    public function edit(RoomSample $roomSample)
    {
        return view('roomSamples.edit', compact('roomSample'));
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
     * @param RoomSample $roomSample
     * @return JsonResponse
     * @throws Exception
     */
    public function update(Request $request, RoomSample $roomSample): JsonResponse
    {
        $roomSample = $this->saveRoomSample($roomSample, $request, false);

        return response()->json([
            'message' => 'Room sample updated successfully',
            'id' => $roomSample->id
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
     * @param RoomSample $roomSample
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(RoomSample $roomSample): \Illuminate\Http\RedirectResponse
    {
        if (Storage::exists($roomSample->getImagePath())) {
            Storage::delete($roomSample->getImagePath());
        }

        $roomSample->delete();

        return response()->redirectToRoute("room-sample.index");
    }
}
