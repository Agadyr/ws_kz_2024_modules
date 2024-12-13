<?php

namespace App\Services;

use App\Http\Resources\Schedules\GetSchedulesResource;
use App\Models\Schedule;

class ScheduleService
{
    public function allSchedules(): array
    {
        $schedules = Schedule::all();

        return GetSchedulesResource::collection($schedules)->toArray(request());
    }
}
