<?php

namespace App\Altium\Facades;


use Illuminate\Support\Facades\Facade;

class AltiumFacade extends Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'Altium';
    }
}