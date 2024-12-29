<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Route\CreateSelectionRequest;
use App\Services\RouteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    protected RouteService $routeService;
    public function __construct(RouteService $routeService)
    {
        $this->routeService = $routeService;
    }

    public function getRoutesByPlaces($from_place_id, $to_place_id, Request $request): JsonResponse
    {
        $data = $this->routeService->getEarliestPlaces($from_place_id, $to_place_id, $request);

        return response()->json($data);
    }

    public function selectionRoutes(CreateSelectionRequest $request): JsonResponse
    {
        $data = $this->routeService->selectRoutesForUser($request);

        return response()->json($data);
    }
}
