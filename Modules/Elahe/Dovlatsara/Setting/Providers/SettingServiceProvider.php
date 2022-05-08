<?php

namespace Modules\Setting\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Setting\Console\SettingRecord;

class SettingServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'Settings');
        $this->commands([
           SettingRecord::class,
        ]);

    }

    public function boot()
    {

    }
}
