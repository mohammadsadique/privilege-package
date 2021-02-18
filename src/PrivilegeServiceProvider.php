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

        $this->mergeConfigFrom(
            __DIR__.'/config/privilege.php', 'privilege'
        );
        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/privilege'),
            __DIR__.'/config/privilege.php' => config_path('privilege.php'),
        ]);
    }

    public function register()
    {
        
    }
}