<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Place\CreatePlaceRequest;
use App\Http\Requests\Place\UpdatePlaceRequest;
use App\Services\PlaceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class PlaceController extends Controller
{
    protected PlaceService $placeService;

    public function __construct(PlaceService $placeService)
    {
        $this->placeService = $placeService;
    }

    public function getPlaces(): JsonResponse
    {
        $data = $this->placeService->allPlaces();
        return response()->json($data, 200);
    }

    public function index(string $id): JsonResponse
    {
        $data = $this->placeService->find($id);

        return response()->json($data);
    }

    public function create(CreatePlaceRequest $request): JsonResponse
    {
        $data = $this->placeService->createPlace($request);

        return response()->json($data);
    }

    public function update(UpdatePlaceRequest $request, string $id): JsonResponse
    {
        Log::info('Request data:', $request->all());

        $data = $this->placeService->updatePlace($request, $id);

        return response()->json($data);
    }

    public function delete(string $id): JsonResponse
    {
        $data = $this->placeService->deletePlace($id);

        return response()->json($data);
    }

}
