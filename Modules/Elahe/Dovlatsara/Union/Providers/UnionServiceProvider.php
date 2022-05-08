<?php


namespace Modules\Union\Providers;


use Illuminate\Support\ServiceProvider;

class UnionServiceProvider extends ServiceProvider
{
    /**
     * Register Unions Providers.
     *
     * @return void
     */
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'Unions');
    }

    public function boot()
    {

    }
}
