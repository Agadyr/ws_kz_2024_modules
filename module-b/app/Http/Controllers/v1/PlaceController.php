<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Place\CreatePlaceRequest;
use App\Models\Place;
use App\Services\PlaceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Js;

class PlaceController extends Controller
{
    protected $placeService;

    public function __construct(PlaceService $placeService)
    {
        $this->placeService = $placeService;
    }

    public function getPlaces(): JsonResponse
    {
        $data = $this->placeService->allPlaces();
        return response()->json($data, 200);
    }

    public function getCurrentPlace(string $id): JsonResponse
    {
        $data = $this->placeService->findById($id);

        return response()->json($data);
    }

    public function createPlace(CreatePlaceRequest $request): JsonResponse
    {
        $data = $this->placeService->create($request);

        return response()->json($data);
    }

}
