<?php

namespace App\Services;

use App\Http\Requests\Schedule\CreatePlaceRequest;
use App\Http\Resources\Schedules\GetSchedulesResource;
use App\Models\Schedule;
use Cassandra\Time;

class ScheduleService
{
    public function allSchedules(): array
    {
        $schedules = Schedule::all();

        return GetSchedulesResource::collection($schedules)->toArray(request());
    }

    public function createSchedule(CreatePlaceRequest $request): array
    {
        $departureTime = strtotime($request->get('departure_time'));
        $arrivalTime = strtotime($request->get('arrival_time'));

        $timeZoneError = $this->checkTimeZone($departureTime, $arrivalTime);
        if ($timeZoneError) {
            return response()->json([
                'message' => 'Data cannot be processed: Times must be between 08:30 and 18:00'
            ], 422)->getData(true);
        }

        try {
            Schedule::create([
                'line' => $request->get('line'),
                'from_place_id' => $request->get('from_place_id'),
                'to_place_id' => $request->get('to_place_id'),
                'departure_time' => $request->get('departure_time'),
                'arrival_time' => $request->get('arrival_time'),
                'distance' => $request->get('distance'),
                'speed' => $request->get('speed'),
                'status' =>  $request->get('status'),
            ]);

            return response()->json([
                'message' => 'Create success',
            ], 200)->getData(true);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Data cannot be processed'. $e], 422)->getData(true);
        }
    }

    private function checkTimeZone(int $departureTime, int $arrivalTime): string
    {
        $startTime = strtotime('08:30:00');
        $endTime = strtotime("18:00:00");

        if ($departureTime < $startTime || $departureTime > $endTime || $arrivalTime < $startTime || $arrivalTime > $endTime) {
            return 'error';
        }

        return '';
    }
}
