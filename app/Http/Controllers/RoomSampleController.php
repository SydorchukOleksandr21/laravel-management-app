<?php

namespace App\Http\Controllers;

use App\Enums\ValueType;
use App\Models\RoomSample;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomSampleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $query = RoomSample::query();

        // Apply search filter if name parameter is provided
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        // Paginate the results
        $roomTemplates = $query->paginate(10);

        return response()->json($roomTemplates);
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


    /**
     * Store a new RoomSample record.
     *
     * @param Request $request
     * @return JsonResponse
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
     */
    private function saveRoomSample(RoomSample $roomSample, Request $request, bool $isNew): RoomSample
    {
        $imageName = $roomSample->image_path;

        if ($request->filled('image')) {
            if (!$isNew && $imageName) {
                Storage::delete($roomSample->getImagePath());
            }

            $imageName = $this->storeBase64Image($roomSample, $request->input('image'));
        }

        // Convert values properly
        $roomSample->fill([
            'name' => $request->input('name', ''),
            'person_count' => abs(intval($request->input('person_count', 0))),
            'square_area' => abs(floatval($request->input('square_area', 0))),
            'image_path' => $imageName,
        ]);

        $roomSample->save();

        // Update room parameters
        if ($request->filled('room_parameters')) {
            $roomSample->roomParameters()->delete();

            $parameters = array_map(function ($param) {
                return [
                    'name' => $param['name'] ?? '',
                    'value_type' => ValueType::from(intval($param['type'])) ?? ValueType::String,
                    'value' => $param['value'] ?? '',
                ];

            }, $request->input('room_parameters', []));

            $roomSample->roomParameters()->createMany($parameters);
        }

        return $roomSample;
    }

    /**
     * Decode and store a base64-encoded image.
     *
     * @param RoomSample $roomSample
     * @param string $base64Image
     * @return string|null
     */
    private function storeBase64Image(RoomSample $roomSample, string $base64Image): ?string
    {
        try {
            // Extract the file extension
            preg_match('/^data:image\/(\w+);base64,/', $base64Image, $matches);

            if (!isset($matches[1])) {
                return null;
            }

            $extension = $matches[1];
            $imageData = substr($base64Image, strpos($base64Image, ',') + 1);
            $imageData = base64_decode($imageData);

            // Generate unique filename
            $fileName = uniqid('room_', true) . '.' . $extension;

            // Store the image
            Storage::put($roomSample->getDirectoryPath() . "/$fileName", $imageData);

            return $fileName;
        } catch (\Exception $e) {
            return null;
        }
    }
}
