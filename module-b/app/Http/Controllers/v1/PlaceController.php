<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Services\PlaceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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


}
