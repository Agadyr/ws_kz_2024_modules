<?php

namespace App\Services;

use App\Http\Resources\Place\GetPlacesResource;
use App\Models\Place;
use Illuminate\Support\Collection;

class PlaceService
{
    public function allPlaces(): array
    {
        $places = Place::all();
        return GetPlacesResource::collection($places)->toArray(request());
    }



}
