<?php

namespace App\Services;

use App\Http\Resources\Place\GetPlacesResource;
use App\Models\Place;
use Illuminate\Support\Collection;
use phpseclib3\Math\PrimeField\Integer;

class PlaceService
{
    public function allPlaces(): array
    {
        $places = Place::all();
        return GetPlacesResource::collection($places)->toArray(request());
    }

    public function findById(int $id): array
    {
        $place = Place::find($id);
        if (!$place) {
            return response()->json([
                'success' => false,
                'message' => 'Place not found'
            ], 404)->getData(true);
        }
        return (new GetPlacesResource($place))->toArray(request());
    }

}
