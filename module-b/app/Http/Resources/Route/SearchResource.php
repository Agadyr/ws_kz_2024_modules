<?php

namespace App\Http\Resources\Route;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    protected $travelTime;

    public function __construct($resource, $travelTime)
    {
        parent::__construct($resource);
        $this->travelTime = $travelTime;
    }

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'line' => $this->line,
            'departure_time' => $this->departure_time,
            'arrival_time' => $this->arrival_time,
            'travel_time' => $this->travelTime->h * 60 + $this->travelTime->i,
            'from_place' => $this->fromPlace,
            'to_place' => $this->toPlace,
        ];
    }
}
