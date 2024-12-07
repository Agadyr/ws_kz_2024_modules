<?php

namespace App\Services;

use App\Http\Requests\Place\CreatePlaceRequest;
use App\Http\Resources\Place\GetPlacesResource;
use App\Models\Place;
use App\Services\Poi\PoiFactory;

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

    public function create(CreatePlaceRequest $request): array
    {
        try {
            $imagePath = $request->file('image')->store('places', 'public');

            $coordinates = (new Poi\PoiFactory)->calculate([
                'latitude' => $request->get('latitude'),
                'longitude' => $request->get('longitude'),
            ]);

            Place::create([
                'name' => $request['name'],
                'type' => $request['type'],
                'latitude' => $request->get('latitude'),
                'longitude' => $request->get('longitude'),
                'x' => $coordinates['x'],
                'y' => $coordinates['y'],
                'image_path' => $imagePath,
                'open_time' => $request['open_time'],
                'close_time' => $request['close_time'],
                'description' => $request['description'] ?? null,
            ]);

            return [
                'message' => 'Create success',
                'status' => 200
            ];

        } catch (\Exception $e) {
            return [
                'message' => 'Data cannot be processed: ' . $e->getMessage(),
                'status' => 422
            ];
        }
    }



}
