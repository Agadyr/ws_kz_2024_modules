<?php

namespace App\Services;

use App\Http\Requests\Place\CreatePlaceRequest;
use App\Http\Requests\Place\UpdatePlaceRequest;
use App\Http\Resources\Place\GetPlacesResource;
use App\Models\Place;
use Illuminate\Support\Facades\Storage;

class PlaceService
{
    public function allPlaces(): array
    {
        $places = Place::all();
        return GetPlacesResource::collection($places)->toArray(request());
    }

    public function find(string $id): array
    {
        $place = Place::find($id);

        if (!$place) {
            return response()->json(['message' => 'This place does not exist'], 404)->getData(true);
        }

        return (new GetPlacesResource($place))->toArray(request());
    }

    public function createPlace(CreatePlaceRequest $request): array
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

            return response()->json([
                'message' => 'Create success',
            ], 200)->getData(true);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Data cannot be processed: ' . $e->getMessage(),
                'status' => 422
            ], 200)->getData(true);
        }
    }

    public function updatePlace(UpdatePlaceRequest $request, string $id)
    {
        try {
            $place = Place::findOrFail($id);

            $this->updatePlaceData($place, $request);


            if ($request->hasFile('image')) {
                $this->updatePlaceImage($place, $request->file('image'));
            }

            if ($request->filled(['latitude', 'longitude'])) {
                $this->updatePlaceCoordinates($place, $request->only(['latitude', 'longitude']));
            }

            $place->save();

            return response()->json([
                'data' => (new GetPlacesResource($place))->toArray(request()),
                'message' => 'Updated Success',
            ], 200)->getData(true);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Data cannot be updated: ' . $e->getMessage(),
                'status' => 422
            ], 200)->getData(true);
        }
    }

    private function updatePlaceData(Place $place, UpdatePlaceRequest $request): void
    {
        $data = $request->only([
            'name',
            'type',
            'latitude',
            'longitude',
            'open_time',
            'close_time',
            'description'
        ]);
        $place->fill($data);
    }

    private function updatePlaceImage(Place $place, $image): void
    {
        if ($place->image_path && Storage::disk('public')->exists($place->image_path)) {
            Storage::disk('public')->delete($place->image_path);
        }

        $place->image_path = $image->store('places', 'public');
    }

    private function updatePlaceCoordinates(Place $place, array $coordinates): void
    {
        $calculatedCoordinates = (new Poi\PoiFactory())->calculate($coordinates);

        $place->x = $calculatedCoordinates['x'];
        $place->y = $calculatedCoordinates['y'];
    }



}
