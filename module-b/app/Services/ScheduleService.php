<?php

namespace App\Services;

use App\Http\Requests\Schedule\CreateScheduleRequest;
use App\Http\Requests\Schedule\UpdateScheduleRequest;
use App\Http\Resources\Schedules\GetSchedulesResource;
use App\Models\Schedule;

class ScheduleService
{
    public function allSchedules(): array
    {
        $schedules = Schedule::all();

        return GetSchedulesResource::collection($schedules)->toArray(request());
    }

    public function createSchedule(CreateScheduleRequest $request): array
    {

        $timeZoneError = $this->checkTimeZone($request);

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
                'status' => $request->get('status'),
            ]);

            return response()->json([
                'message' => 'Create success',
            ], 200)->getData(true);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Data cannot be processed' . $e], 422)->getData(true);
        }
    }

    public function updateSchedule(UpdateScheduleRequest $request, string $id)
    {
        $schedule = Schedule::findOrFail($id);

        $timeZoneError = $this->checkTimeZone($request);

        if ($timeZoneError) {
            return response()->json([
                'message' => 'Data cannot be processed: Times must be between 08:30 and 18:00'
            ], 422)->getData(true);
        }

        try {
            $this->updateScheduleData($schedule, $request);
            $schedule->save();

            return response()->json([
                'message' => 'Update success',
            ], 200)->getData(true);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Data cannot be updated' . $e], 400)->getData(true);
        }
    }


    public function deleteSchedule($id): array
    {
        $schedule = Schedule::findOrFail($id);

        try {
            $schedule->delete();

            return response()->json([
                'message' => 'delete success',
            ], 200)->getData(true);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Data cannot be deleted'
            ], 400)->getData(true);
        }
    }

    private function updateScheduleData(Schedule $schedule, UpdateScheduleRequest $request): void
    {
        $data = $request->only([
            'line',
            'from_place_id',
            'to_place_id',
            'departure_time',
            'arrival_time',
            'distance',
            'speed',
            'status'
        ]);
        $schedule->fill($data);
    }

    private function checkTimeZone($request): string
    {
        $departureTime = strtotime($request->get('departure_time'));
        $arrivalTime = strtotime($request->get('arrival_time'));

        $startTime = strtotime('08:30:00');
        $endTime = strtotime("18:00:00");

        if (!$departureTime || !$arrivalTime) {
            return '';
        }

        if ($departureTime < $startTime || $departureTime > $endTime || $arrivalTime < $startTime || $arrivalTime > $endTime) {
            return 'error';
        }

        return '';
    }
}
