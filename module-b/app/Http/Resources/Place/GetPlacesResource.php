<?php

namespace App\Http\Resources\Place;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetPlacesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'x' => $this->x,
            'y' => $this->y,
            'type' => $this->type,
            'image_path' => $this->image_path,
            'open_time' => $this->open_time,
            'close_time' => $this->close_time,
            'description' => $this->description,
        ];
    }
}
