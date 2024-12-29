<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Routehistory extends Model
{
    protected $fillable = ['from_place_id', 'to_place_id', 'user_id', 'schedule_ids'];
    public $timestamps = false;
}
