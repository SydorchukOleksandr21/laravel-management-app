<?php

namespace App\Http\Controllers;

use App\Http\Controllers\base\ResourceController;
use App\Http\Requests\Guest\GuestRequest;
use App\Models\Guest;
use App\Services\Core\ModelSearch;
use App\Services\Guest\GuestService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Validation\ValidationException;

class GuestController extends ResourceController
{
    /**
     * @var GuestService
     */
    protected GuestService $guestService;

    /**
     * @param GuestService $guestService
     */
    public function __construct(GuestService $guestService)
    {
        $this->guestService = $guestService;
    }

    /**
     * @param Request $request
     * @return Factory|View|Application|object
     */
    public function index(Request $request): Factory|Application|View
    {
        $items = (new ModelSearch(Guest::class))->search($request);

        return view('guests.index', [
            'items' => $items,
            'className' => Guest::class,
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $modelSearch = new ModelSearch(Guest::class);
        $id = $request->get("id", '');

        if ($id) {
            $items = $modelSearch->getByID(intval($id));
        } else {
            $items = $modelSearch->search($request);
        }

        return response()->json($items);
    }

    /**
     * @return View|Application|Factory
     */
    public function create(): View|Application|Factory
    {
        return view('guests.create');
    }

    /**
     * @param Guest $model
     * @return View|Application|Factory
     */
    public function edit(Guest $model): View|Application|Factory
    {
        return view('guests.edit', compact('model'));
    }

    /**
     * @param GuestRequest $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(GuestRequest $request): RedirectResponse
    {
        $model = new Guest();
        $this->saveGuest($model, $request);

        return redirect()->route('guest.index');
    }

    /**
     * @param Guest $model
     * @param GuestRequest $request
     * @return Guest
     * @throws ValidationException
     */
    private function saveGuest(Guest $model, GuestRequest $request): Guest
    {
        $this->save($model, $request);

        return $model;
    }

    /**
     * Display the specified resource.
     */
    public function show(Guest $model): Factory|Application|View
    {
        return view('guests.show', compact('model'));
    }

    public function update(GuestRequest $request, Guest $model)
    {
        $validated = $request->validated();
        $guest = $this->saveGuest($model, $request);

        return redirect()->route('guest.show', compact('model'));
//
//        $guest = Guest::where('phone_number', $validated['phone_number'])->first();
//
//        if ($guest) {
//            $this->guestService->update(
//                $guest,
//                email: $validated['email'],
//                name: $validated['name'],
//            );
//
//            return response()->json([
//                'id' => $guest->id,
//                'existed' => true,
//            ]);
//
//        } else {
//            $guest = $this->guestService->create(
//                phone_number: $validated['phone_number'],
//                email: $validated['email'],
//                name: $validated['name'],
//            );
//
//            return response()->json([
//                'id' => $guest->id,
//                'existed' => false,
//            ]);
//        }
    }

    /**
     * @param Guest $model
     * @return RedirectResponse
     */
    public function destroy(Guest $model): RedirectResponse
    {
        $model->delete();

        return redirect()->route('guest.index');
    }
}
