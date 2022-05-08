<?php

namespace Modules\EnumType\Providers;

use Illuminate\Support\ServiceProvider;

class EnumTypeServiceProvider extends ServiceProvider
{
    /**
     * Register Attributes Providers.
     *
     * @return void
     */
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'EnumTypes');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');

    }

    public function boot()
    {

    }
}
