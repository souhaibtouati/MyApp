<?php

namespace App\Users\Facades;

use Illuminate\Support\Facades\Facade;

class Sentinel_exFacade extends Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'Sentinel_ex';
    }
}
