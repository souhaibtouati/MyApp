<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Altium\Altium;
use App\Altium\PartRepository;

class AltiumServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerPartsRepository();
        $this->registerAltium();
    }


    public function registerPartsRepository()
    {
        $this->app->bind('Altium.PartRepository', function($app){
            return new PartRepository(null);
        });
    }


    public function registerAltium()
    {
        $this->app->singleton('Altium', function($app){
            $altium = new Altium(app('Altium.PartRepository'));
            return $altium;
        });
        $this->app->alias('Altium', 'App\Altium\Altium');
    }

    public function provides()
    {
        return [
            'Altium'
            ];
    }

}
