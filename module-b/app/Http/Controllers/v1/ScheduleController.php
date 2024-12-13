<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Schedule\CreatePlaceRequest;
use App\Services\ScheduleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    protected $authService;

    public function __construct(ScheduleService $authService)
    {
        $this->authService = $authService;
    }

    public function getSchedules(): JsonResponse
    {
        $data = $this->authService->allSchedules();

        return response()->json($data);
    }

    public function create(CreatePlaceRequest $request): JsonResponse
    {
        $data = $this->authService->createSchedule($request);

        return response()->json($data);
    }
}
