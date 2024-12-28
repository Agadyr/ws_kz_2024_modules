<?php

namespace App\Services;

use App\Models\Place;
use App\Models\Schedule;
use DeepCopy\TypeFilter\ShallowCopyFilter;
use Illuminate\Http\Request;

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

            return [
                'id' => $schedule->id,
                'line' => $schedule->line,
                'departure_time' => $schedule->departure_time,
                'arrival_time' => $schedule->arrival_time,
                'travel_time' => $travelTime->h * 60 + $travelTime->i,
                'from_place' => $schedule->fromPlace,
                'to_place' => $schedule->toPlace,
            ];
        });

        $sortedRoutes = $routes->sortBy('arrival_time');

        $topFiveRoutes = $sortedRoutes->take(5);

        return response()->json($topFiveRoutes)->getData(true);
    }

}
