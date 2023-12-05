<?php

namespace App\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use App\Service\UserService;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class UserServiceProvider extends ServiceProvider implements DeferrableProvider
{

    /**
     * Register services.
     * @return void
     */

    
    public function register()
    {
        $this->app->singleton(UserService::class, function($app){
            return new UserService();
        });
    }

    /**
     * Bootstrap services.
     * @return void
     */
    public function boot(): void
    {
       
    }
}
