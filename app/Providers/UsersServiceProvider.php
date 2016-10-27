<?php

namespace App\Providers;

use Cartalyst\Sentinel\Laravel\SentinelServiceProvider;
use App\Users\PermissionRepository;
use App\Users\Sentinel_ex;
/**
* 
*/
class UsersServiceProvider extends SentinelServiceProvider
{
	

	public function register()
    {
        $this->prepareResources();
        $this->registerPersistences();
        $this->registerUsers();
        $this->registerRoles();
        $this->registerCheckpoints();
        $this->registerReminders();
        $this->registerSentinel();
        $this->RegisterPermissions();
        $this->registerSentinel_ex();
        $this->setUserResolver();
        
    }


	public function RegisterPermissions()
	{
		
		$this->app->singleton('Sentinel_ex.permissions', function ($app) {
          
            $Permission = 'App\Users\EloquentPermission';
            
            return new PermissionRepository($Permission);
        });
        
	}

	public function registerSentinel_ex()
	{
		
		$this->app->singleton('Sentinel_ex', function ($app) {
		$Sentinel_ex = new Sentinel_ex(app('Sentinel_ex.permissions'));

		return $Sentinel_ex;
		});
		$this->app->alias('sentinel_ex', 'App\Users\Sentinel_ex');
	}


	    public function provides()
    {


    	return [

            'Sentinel_ex.permissions',
            'Sentinel_ex',
           
        ];

    }

	   
}