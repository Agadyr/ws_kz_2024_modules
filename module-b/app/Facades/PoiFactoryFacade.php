<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class PoiFactoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'PoiFactory';
    }
}
