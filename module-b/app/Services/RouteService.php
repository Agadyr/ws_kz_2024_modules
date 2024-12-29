<?php

namespace App\Services;

use App\Http\Requests\Route\CreateSelectionRequest;
use App\Http\Resources\Route\SearchResource;
use App\Models\Routehistory;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class RouteService
{
    public function getEarliestPlaces($from_place_id, $to_place_id, Request $request): array
    {
        $departureTime = $request->query('departure_time', now()->format('H:i:s'));

        $allSchedules = Schedule::where('from_place_id', $from_place_id)
            ->where('to_place_id', $to_place_id)
            ->where('departure_time', '>=', $departureTime)
            ->with(['fromPlace', 'toPlace'])
            ->get();

        $routes = $allSchedules->map(function ($schedule) {
            $departure = new \DateTime($schedule->departure_time);
            $arrival = new \DateTime($schedule->arrival_time);
            $travelTime = $departure->diff($arrival);

            return new SearchResource($schedule, $travelTime);
        });

        $sortedRoutes = $routes->sortBy('arrival_time');

        $topFiveRoutes = $sortedRoutes->take(5);

        return response()->json($topFiveRoutes)->getData(true);
    }

    public function selectRoutesForUser(CreateSelectionRequest $request): array
    {
        $userSchedules = $request->get('schedule_ids');
        $from_place_id = $request->get('from_place_id');
        $to_place_id = $request->get('to_place_id');

        try {
            $allSchedules = Schedule::where('from_place_id', $from_place_id)
                ->where('to_place_id', $to_place_id)
                ->whereIn('id', $userSchedules)
                ->get();

            $scheduleIds = $allSchedules->pluck('id')->toArray();

            $history = Routehistory::create([
                'from_place_id' => $from_place_id,
                'to_place_id' => $to_place_id,
                'user_id' => auth()->id(),
                'schedule_ids' => json_encode($scheduleIds, JSON_THROW_ON_ERROR),
            ]);

            return response()->json(['Create success', $history], 200)->getData(true);
        } catch (\Exception $e) {
            return response()->json(['Data cannot be processed', $e->getMessage()], 422)->getData(true);
        }
    }

}
