<?php

namespace App\Http\Controllers;

use App\Models\RoomSample;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        return view('roomSamples.create');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
