<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public static function deleteRelations(string $id): void
    {
        self::where('from_place_id', $id)
            ->orWhere('to_place_id', $id)
            ->delete();
    }
}
