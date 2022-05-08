<?php


namespace Modules\City\Providers;


use Illuminate\Support\ServiceProvider;

class CityServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'Cities');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');

    }

    public function boot()
    {

    }
}
