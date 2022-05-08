<?php

namespace Modules\AdvertisingFee\Providers;

use Illuminate\Support\ServiceProvider;

class AdvertisingFee2ServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'AdvertisingFees');
//        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang/', 'Attributes');

    }

    public function boot()
    {

    }
}
