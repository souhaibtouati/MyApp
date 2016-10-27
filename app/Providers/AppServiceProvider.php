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
        Blade::directive('displayError', function($expression)
        {
        $view = 'partials.error'; // Path to your view

        if (!$expression)
        {
            $expression = '([])';
        }

        return "<?php echo \$__env->make('{$view}', array_except(get_defined_vars(), ['__data', '__path']))->with{$expression}->render(); ?>";
    });

        Blade::directive('errorMessage', function ($error)
        {
            $view = view('partials.error');
            
            return str_replace('%errorMessage%', 'this error', $view);
        });


        Blade::directive('UserName', function ()
        {
            $user = Sentinel::getUser();
            return $user->first_name .' '. $user->last_name;
        });

        Blade::directive('Avatar', function(){
            return '/img/avatars/'. Sentinel::getUser()->avatar;
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
