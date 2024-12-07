<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        'name',
        'type',
        'latitude',
        'longitude',
        'image_path',
        'open_time',
        'close_time',
        'x',
        'y'
    ];
    public $timestamps = false;
}
