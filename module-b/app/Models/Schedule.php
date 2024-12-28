<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{

    protected $fillable = [
        'line',
        'from_place_id',
        'to_place_id',
        'departure_time',
        'arrival_time',
        'distance',
        'speed',
        'status'
    ];
    public $timestamps = false;
    public static function deleteRelations(string $id): void
    {
        self::where('from_place_id', $id)
            ->orWhere('to_place_id', $id)
            ->delete();
    }

    public function fromPlace()
    {
        return $this->belongsTo(Place::class, 'from_place_id');
    }

    public function toPlace()
    {
        return $this->belongsTo(Place::class, 'to_place_id');
    }

}
