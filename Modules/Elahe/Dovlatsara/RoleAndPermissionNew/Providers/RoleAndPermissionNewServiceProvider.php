<?php

namespace Modules\RoleAndPermissionNew\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\RoleAndPermissionNew\Console\PermissionRecord;

class RoleAndPermissionNewServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'RoleAndPermissionNew');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
        $this->commands([
            PermissionRecord::class,
        ]);
    }

    public function boot()
    {

    }
}
