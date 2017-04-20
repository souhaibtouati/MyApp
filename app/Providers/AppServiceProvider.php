<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Blade;
use Sentinel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.header', function($view) {
            $user = Sentinel::getUser();
            $view->with(['ConnectedUser' => $user]);
        });
        view()->composer('layouts.sidebar', function($view) {
            $user = Sentinel::getUser();
            $view->with(['ConnectedUser' => $user]);
        });
        view()->composer('Settings.svn', function($view) {
            $user = Sentinel::getUser();
            $view->with(['ConnectedUser' => $user]);
        });

        Blade::directive('Today', function(){
            return Carbon::today()->toDateString();
        });



    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
