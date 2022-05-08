<?php

namespace Modules\Enum\Providers;

use Illuminate\Support\ServiceProvider;

class EnumServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'Enums');
//        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang/', 'Attributes');

    }

    public function boot()
    {

    }
}
