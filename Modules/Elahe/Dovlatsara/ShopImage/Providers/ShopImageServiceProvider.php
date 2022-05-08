<?php


namespace Modules\ShopImage\Providers;


use Illuminate\Support\ServiceProvider;

class ShopImageServiceProvider extends ServiceProvider
{
    /**
     * Register Shops Providers.
     *
     * @return void
     */
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
//        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'ShopImages');
    }

    public function boot()
    {

    }
}
