<?php

namespace App\Http\Resources\Schedules;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetSchedulesResource extends JsonResource
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
            'line' => $this->line,
            'from_place_id' => $this->from_place_id,
            'to_place_id' => $this->to_place_id,
            'departure_time' => $this->departure_time,
            'arrival_time' => $this->arrival_time,
            'distance' => $this->distance,
            'speed' => $this->speed,
            'status' => $this->status
        ];
    }
}
