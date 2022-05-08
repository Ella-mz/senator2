<?php


namespace Modules\GroupAttribute\Providers;


use Illuminate\Support\ServiceProvider;

class GroupAttributeServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'GroupAttributes');
//        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang/', 'Attributes');

    }

    public function boot()
    {

    }
}
