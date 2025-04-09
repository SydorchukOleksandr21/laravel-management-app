<?php

namespace App\Http\Controllers;

use App\Models\RoomSample;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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

    /**
     * Store a new RoomSample record.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $validated = $this->validateRequest($request);

        // Handle image upload if provided
        $imageName = null;
        if (!empty($validated['image'])) {
            $imageName = $this->storeBase64Image($validated['image']);
        }

        // Create RoomSample record
        $roomSample = RoomSample::create([
            'name' => $validated['name'],
            'person_count' => $validated['person_count'],
            'square_area' => $validated['square_area'],
            'image_path' => $imageName,
        ]);

        // Save room parameters if provided
        if (!empty($validated['room_parameters'])) {
            $roomSample->parameters()->createMany($validated['room_parameters']);
        }

        return response()->json(['message' => 'Room sample created successfully', 'data' => $roomSample], 201);
    }

    /**
     * Update an existing RoomSample record.
     *
     * @param Request $request
     * @param RoomSample $roomSample
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, RoomSample $roomSample): JsonResponse
    {
        $validated = $this->validateRequest($request, true);

        $imageName = $roomSample->image_path;
        if (!empty($validated['image'])) {

            if ($imageName) {
                Storage::delete($roomSample->getImagePath());
            }

            $imageName = $this->storeBase64Image($roomSample, $validated['image']);
        }

        // Update RoomSample record
        $roomSample->update([
            'name' => $validated['name'],
            'person_count' => $validated['person_count'],
            'square_area' => $validated['square_area'],
            'image_path' => $imageName,
        ]);

        // Update room parameters
        if (!empty($validated['room_parameters'])) {
            $roomSample->parameters()->delete();
            $roomSample->parameters()->createMany($validated['room_parameters']);
        }

        return response()->json(['message' => 'Room sample updated successfully', 'data' => $roomSample], 200);
    }

    /**
     * Validate the incoming request.
     *
     * @param Request $request
     * @param bool $isUpdate
     * @return array
     * @throws ValidationException
     */
    private function validateRequest(Request $request, bool $isUpdate = false): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'person_count' => 'required|integer|min:1',
            'square_area' => 'required|numeric|min:1',
            'image' => 'nullable|string|regex:/^data:image\/\w+;base64,/',
            'room_parameters' => 'nullable|array',
            'room_parameters.*.name' => 'required|string|max:255',
            'room_parameters.*.type' => 'required|string|in:text,number,boolean',
            'room_parameters.*.value' => 'required',
        ];

        $messages = [
            'name.required' => 'The name field is required.',
            'person_count.required' => 'The person count field is required.',
            'square_area.required' => 'The square area field is required.',
            'image.regex' => 'The image must be a valid base64-encoded image.',
            'room_parameters.*.name.required' => 'Each parameter must have a name.',
            'room_parameters.*.type.required' => 'Each parameter must have a type.',
            'room_parameters.*.type.in' => 'The parameter type must be text, number, or boolean.',
            'room_parameters.*.value.required' => 'Each parameter must have a value.',
        ];

        return Validator::make($request->all(), $rules, $messages)->validate();
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
