<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Schedule\CreateScheduleRequest;
use App\Http\Requests\Schedule\UpdateScheduleRequest;
use App\Services\ScheduleService;
use Illuminate\Http\JsonResponse;

class ScheduleController extends Controller
{
    protected $scheduleService;

    public function __construct(ScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    public function getSchedules(): JsonResponse
    {
        $data = $this->scheduleService->allSchedules();

        return response()->json($data);
    }

    public function create(CreateScheduleRequest $request): JsonResponse
    {
        $data = $this->scheduleService->createSchedule($request);

        return response()->json($data);
    }

    public function update(UpdateScheduleRequest $request, string $id): JsonResponse
    {
        $data = $this->scheduleService->updateSchedule($request, $id);

        return response()->json($data);
    }

    public function delete(string $id): JsonResponse
    {
        $data = $this->scheduleService->deleteSchedule($id);

        return response()->json($data);
    }
}
