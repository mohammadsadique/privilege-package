<?php

namespace Sadique\Privilege;

use Illuminate\Support\ServiceProvider;

class PrivilegeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'privilege');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/privilege'),
        ]);
    }

    public function register()
    {
        
    }
}